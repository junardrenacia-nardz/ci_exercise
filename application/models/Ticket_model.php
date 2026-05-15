<?php

class Ticket_model extends CI_Model {
    public function get_tickets($id = FALSE, $status = "all") {
        $this->db->order_by('td.ticket_id', 'DESC');
        $this->db->select('
            td.ticket_id,
            td.ticket_name,
            td.ticket_description,

            tt.type_name,
            td.ticket_status,
            td.department_id,

            d.department_name,

            td.ticket_created,
            td.priority,
            td.expected_start_date,
            td.expected_resolved_date,
            td.actual_start_date,
            td.resolved_date,
            td.days_since_resolved,
            td.root_cause,
            td.step_taken,
            td.solution_applied,
            td.ticket_updated,

            u.employee_id AS requester_employee_id,
            e.first_name  AS requester_first_name,
            e.last_name AS requester_last_name,
            ed.department_id AS requester_department_id,
            ed.department_name AS requester_department_name
        ');

        $this->db->from('ticket_details td');
        $this->db->join('ticket_type tt', 'tt.ticket_type_id = td.ticket_type_id', 'left');
        $this->db->join('departments d', 'd.department_id = td.department_id');
        $this->db->join('users u', 'u.user_id = td.requester_id');
        $this->db->join('employees e', 'e.employee_id = u.employee_id', 'left');
        $this->db->join('departments ed', 'ed.department_id = e.department_id', 'left');

        if ($id) {
            $this->db->where('td.ticket_id', $id);
            $query = $this->db->get();
            return $query->row_array();
        }

        // Status filter
        if ($status !== "all") {

            $map = [
                'approval' => 'for approval',
                'ongoing' => 'on going'
            ];

            $status = $map[$status] ?? $status;

            $this->db->where('LOWER(td.ticket_status)', strtolower($status));
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_tickets_count() {
        $query = $this->db->get('ticket_details');
        return $query->result_array();

    }

    public function get_ticket_assigned() {
        $this->db->select('
                ta.ticket_id, CONCAT("UID-", LPAD(ta.user_id, 5, "0")) as user_id, u.employee_id, e.first_name, e.last_name,
                d.department_name
                ');
        $this->db->from('ticket_assigned ta');
        $this->db->join('users u', 'u.user_id = ta.user_id');
        $this->db->join('employees e', 'e.employee_id = u.employee_id');
        $this->db->join('departments d', 'd.department_id = e.department_id');
        $this->db->where('ta.person_status', 'Assigned');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function create_ticket($fileNames) {
        $query = $this->db->select('ticket_id')
            ->order_by('ticket_id', 'DESC')
            ->limit(1)
            ->get('ticket_details');

        $last = $query->row();

        if ($last) {
            $lastNumber = (int) substr($last->ticket_id, 4); // remove "TCK-"
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $ticketID = 'TCK-' . str_pad($newNumber, 6, '0', STR_PAD_LEFT);

        $this->db->trans_start();

        $ticketData = [
            'ticket_id' => $ticketID,
            'ticket_name' => $this->input->post('ticketSubject'),
            'ticket_description' => $this->input->post('ticketDescription'),
            'ticket_type_id' => $this->input->post('requestType'),
            'priority' => $this->input->post('priority'),
            'department_id' => $this->input->post('selectDepartment'),
            'requester_id' => $this->session->userdata('user_id'),
            'ticket_status' => 'For Approval'
        ];

        $this->db->insert('ticket_details', $ticketData);

        foreach ($fileNames as $file) {
            $attachmentData = [
                'attachment' => $file['encryptedName'],
                'orig_name' => $file['origName'],
                'ticket_id' => $ticketID
            ];

            $this->db->insert('ticket_attachments', $attachmentData);
        }

        $current_user = $this->session->userdata('user_id');
        $id = 'UID-' . str_pad($current_user, 5, '0', STR_PAD_LEFT);
        $description = "<b>$id</b> created ticket <b>$ticketID</b>";
        $this->audit_model->ticket_audit($ticketID, $current_user, $description, "create");

        $this->db->trans_complete();

        // CHECK IF SUCCESS
        if ($this->db->trans_status() === FALSE) {
            return false;
        }
    }

    public function assign_person($names, $ticket_id, $users = []) {
        $this->db->trans_start();
        if (!empty($users)) {
            foreach ($users as $user) {
                $editAssigned = [
                    "person_status" => "Reassigned"
                ];

                $user = explode("-", $user)[1];

                $this->db->where(['user_id' => $user, "ticket_id" => $ticket_id]);
                $this->db->update('ticket_assigned', $editAssigned);
            }
        }

        $count_existing = 0;

        foreach ($names as $name) {
            if (!$this->check_assigned(explode('-', $name)[1], $ticket_id)) {
                $assigndata = [
                    "ticket_id" => $ticket_id,
                    "user_id" => explode('-', $name)[1],
                    "person_status" => "Assigned"
                ];
                $this->db->insert('ticket_assigned', $assigndata);
            } else {
                $count_existing++;
                $assigndata = [
                    "person_status" => "Assigned"
                ];
                $this->db->where(['ticket_id' => $ticket_id, "user_id" => explode('-', $name)[1]]);
                $this->db->update('ticket_assigned', $assigndata);
            }
        }

        $ticketUpdate = [
            "ticket_status" => "pending",
            "expected_start_date" => $this->input->post("expectedStart"),
            "expected_resolved_date" => $this->input->post("expectedEnd")
        ];

        $this->db->where("ticket_id", $ticket_id);
        $this->db->update("ticket_details", $ticketUpdate);

        $oldUsers = $this->formatNames($users);
        $newUsers = $this->formatNames($names);

        $current_user = $this->session->userdata('user_id');
        $id = 'UID-' . str_pad($current_user, 5, '0', STR_PAD_LEFT);

        if ($count_existing >= 1) {
            $description = "<b>$id</b> reassigned ticket <b>$ticket_id</b> from $oldUsers to $newUsers";
            $action = "update";
        } else {
            $description = "Ticket <b>$ticket_id</b> assigned to $newUsers by user <b>$id</b>";
            $action = "insert";
        }

        $this->audit_model->ticket_audit($ticket_id, $current_user, $description, $action);

        $this->db->trans_complete();

        // CHECK IF SUCCESS
        if ($this->db->trans_status() === FALSE) {
            return false;
        }
    }

    public function change_department($ticket_id) {
        $ticketData = [
            "department_id" => $this->input->post('selectDepartment'),
            "ticket_status" => "For Approval",
            "priority" => NULL
        ];
        $assignedData = ["person_status" => "Reassigned"];

        $this->db->where('ticket_id', $ticket_id);
        $this->db->update('ticket_details', $ticketData);

        $this->db->where('ticket_id', $ticket_id);
        $this->db->update('ticket_assigned', $assignedData);

        $oldDepartment = $this->input->post('oldDepartment');
        $newDepartment = $this->input->post('selectDepartment');

        $old = $this->department_model->get_departments($oldDepartment);
        $new = $this->department_model->get_departments($newDepartment);

        $current_user = $this->session->userdata('user_id');
        $id = 'UID-' . str_pad($current_user, 5, '0', STR_PAD_LEFT);
        $description = "User <b>$id</b> changed the department from <b>{$old['department_name']}</b> to <b>{$new['department_name']}</b> for Ticket <b>$ticket_id</b>";
        $this->audit_model->ticket_audit($ticket_id, $current_user, $description, "update");

        $this->db->trans_complete();

        return true;
    }
    public function check_assigned($user, $ticket_id) {
        $this->db->where(['user_id' => $user, 'ticket_id' => $ticket_id]);
        return $this->db->count_all_results('ticket_assigned') > 0;
    }

    public function get_ticket_attachment($ticket_id) {
        $this->db->where(["ticket_id" => $ticket_id]);
        $query = $this->db->get('ticket_attachments');
        return $query->result_array();
    }

    public function update_ticket_status($ticket_id, $status) {
        $data['ticket_status'] = strtolower($status);
        $data['priority'] = $this->input->post('priority');
        $this->db->where('ticket_id', $ticket_id);
        $this->db->update('ticket_details', $data);
        return true;
    }

    protected function formatNames(array $users) {
        $names = $users;

        if (count($names) > 1) {
            $last = array_pop($names);

            $boldNames = array_map(function ($name) {
                return "<b>{$name}</b>";
            }, $names);

            return implode(', ', $boldNames) . ' and <b>' . $last . '</b>';
        }

        return isset($names[0]) ? "<b>{$names[0]}</b>" : '';
    }
}