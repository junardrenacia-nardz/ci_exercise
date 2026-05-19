<?php

class Ticket_model extends CI_Model {
    public function get_tickets($id = FALSE, $status = "all", $user = []) {
        $this->db->order_by('td.ticket_id', 'DESC');
        $this->db->select('
            td.ticket_id,
            td.ticket_name,
            td.ticket_description,
            td.requester_id,

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

        if (!empty($user) && $user['role_id'] !== "4") {
            $this->db->group_start();
            $this->db->where('td.department_id', $user['department_id']);
            $this->db->or_where('ed.department_id', $user['department_id']);
            $this->db->group_end();

        }

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_my_tickets() {
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

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_tickets_count($user = []) {
        $this->db->select('
                e.department_id, td.department_id, td.ticket_status, td.ticket_id, td.requester_id, td.priority
                ');
        $this->db->from('ticket_details td');
        $this->db->join('users u', 'u.user_id = td.requester_id', 'left');
        $this->db->join('employees e', 'e.employee_id = u.employee_id', 'left');

        if (!empty($user) && $user['role_id'] !== "4") {
            $this->db->group_start();
            $this->db->where('td.department_id', $user['department_id']);
            $this->db->or_where('e.department_id', $user['department_id']);
            $this->db->group_end();

        }
        $query = $this->db->get();
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
        $user_name = $this->user_model->get_employee_name($current_user);
        $full_name = $user_name['first_name'] . " " . $user_name['last_name'];

        $description = "<b>$full_name</b> created ticket <b>$ticketID</b>";
        $this->audit_model->ticket_audit($ticketID, $current_user, $description, "create");

        $history_description = "<b>$full_name</b> created the Ticket";
        $this->history_model->ticket_history($ticketID, $current_user, $history_description, "Ticket Created");


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
            "expected_resolved_date" => $this->input->post("expectedEnd"),
            "actual_start_date" => null
        ];

        $this->db->where("ticket_id", $ticket_id);
        $this->db->update("ticket_details", $ticketUpdate);
        $old = [];
        $new = [];
        if (!empty($users)) {
            foreach ($users as $user) {
                $idExplode = explode('-', $user)[1];
                $user_name = $this->user_model->get_employee_name($idExplode);
                $full_name = $user_name['first_name'] . " " . $user_name['last_name'];
                $old[] = $full_name;
            }
        }

        foreach ($names as $name) {
            $idExplode = explode('-', $name)[1];
            $user_name = $this->user_model->get_employee_name($idExplode);
            $full_name = $user_name['first_name'] . " " . $user_name['last_name'];
            $new[] = $full_name;
        }

        $oldUsers = $this->formatNames($old);
        $newUsers = $this->formatNames($new);

        $current_user = $this->session->userdata('user_id');
        $user_name = $this->user_model->get_employee_name($current_user);

        if ($count_existing >= 1) {
            $description = "Reassigned ticket $ticket_id from <b>$oldUsers</b> to <b>$newUsers</b>";
            $action = "update";
            $history_description = "Reassigned from <b>$oldUsers</b> to <b>$newUsers</b>";
            $history_action = "Re-assigned User";
        } else {
            $description = "Ticket $ticket_id assigned to <b>$newUsers</b>";
            $action = "insert";
            $history_description = "Ticket assigned to <b>$newUsers</b>";
            $history_action = "Assigned User";
        }

        $this->audit_model->ticket_audit($ticket_id, $current_user, $description, $action);
        $this->history_model->ticket_history($ticket_id, $current_user, $history_description, $history_action);


        $this->db->trans_complete();

        // CHECK IF SUCCESS
        if ($this->db->trans_status() === FALSE) {
            return false;
        }
    }

    public function change_department($ticket_id) {
        $this->db->trans_start();
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
        $description = "Changed the department from <b>{$old['department_name']}</b> to <b>{$new['department_name']}</b>";
        $this->audit_model->ticket_audit($ticket_id, $current_user, $description, "update");

        $history_description = "Department changed from <b>{$old['department_name']}</b> to <b>{$new['department_name']}</b>";
        $this->history_model->ticket_history($ticket_id, $current_user, $history_description, 'Re-assigned Department');

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
        $this->db->trans_start();
        $ticket_status = $this->input->post('ticket_status');

        if ($status == "open")
            $reopenStatus = "pending";
        if ($status == "closed")
            $reopenStatus = "closed";

        if (isset($ticket_status)) {
            $data = [
                'ticket_status' => strtolower($reopenStatus)
            ];
        } else {
            $data = [
                'ticket_status' => strtolower($status),
                'priority' => $this->input->post('priority')
            ];
        }

        $this->db->where('ticket_id', $ticket_id);
        $this->db->update('ticket_details', $data);

        $current_user = $this->session->userdata('user_id');
        $user_name = $this->user_model->get_employee_name($current_user);
        $full_name = $user_name['first_name'] . " " . $user_name['last_name'];

        if (isset($ticket_status)) {
            if ($status == "closed") {
                $description = "<b>$full_name</b> rejected re-opening Ticket $ticket_id";
                $history_description = "Rejected to re-open the Ticket";
            } else {
                $description = "<b>$full_name</b> approved Ticket $ticket_id";
                $history_description = "Approved to re-open the Ticket";
            }
        } else {
            if ($status == "closed") {
                $description = "<b>$full_name</b> rejected Ticket $ticket_id";
                $history_description = "Rejected the Ticket";
            } else {
                $description = "<b>$full_name</b> approved Ticket $ticket_id";
                $history_description = "Approved the Ticket";
            }
        }

        $this->audit_model->ticket_audit($ticket_id, $current_user, $description, "update");
        $this->history_model->ticket_history($ticket_id, $current_user, $history_description, 'Ticket Status');
        $this->db->trans_complete();
        return true;
    }

    public function update_ticket_progress($ticket_id, $status, $old) {
        $this->db->trans_start();
        date_default_timezone_set('Asia/Manila');

        $ticket = $this->db
            ->get_where('ticket_details', array('ticket_id' => $ticket_id))
            ->row_array();

        $ticket_start_date = $ticket['actual_start_date'];

        $resolved_date = date('Y-m-d h:i a');

        $start = new DateTime($ticket_start_date);
        $resolved = new DateTime($resolved_date);

        $interval = $start->diff($resolved);

        if ($ticket_start_date !== null) {
            $days_since_resolved = $interval->days;
        } else {
            $days_since_resolved = null;
        }

        if ($old == "pending")
            $data['actual_start_date'] = date('Y-m-d h:i a');

        if ($status == "closed")
            $data = [
                'resolved_date' => $resolved_date,
                'is_complete' => '1',
                'days_since_resolved' => $days_since_resolved
            ];

        if ($status == 'for approval') {
            $data = [
                'resolved_date' => null,
                'is_complete' => '0',
                'days_since_resolved' => null
            ];
        }

        $data['ticket_status'] = strtolower($status);
        $this->db->where('ticket_id', $ticket_id);
        $this->db->update('ticket_details', $data);

        $current_user = $this->session->userdata('user_id');
        $id = 'UID-' . str_pad($current_user, 5, '0', STR_PAD_LEFT);
        $oldStatus = ucwords($old);
        $newStatus = ucwords($status);

        $description = "Updated the status from <b>$oldStatus</b> to <b>$newStatus</b>";

        $this->audit_model->ticket_audit($ticket_id, $current_user, $description, "update");

        $history_description = "Status Updated from <b>$oldStatus</b> to <b>$newStatus</b>";
        $this->history_model->ticket_history($ticket_id, $current_user, $history_description, 'Ticket Status');
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }
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