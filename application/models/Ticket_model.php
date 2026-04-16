<?php

class Ticket_model extends CI_Model {
    public function get_tickets($id = FALSE) {
        $this->db->order_by('td.ticket_id', 'DESC');
        $this->db->select('
                td.ticket_id,
                td.ticket_name,
                td.ticket_description,

                tt.type_name,
                tp.level_of_priority,
                td.ticket_status,

                d.department_name,

                td.ticket_created,
                td.expected_start_date,
                td.expected_resolved_date,
                td.actual_start_date,
                td.resolved_date,
                td.days_since_resolved,
                td.root_cause,
                td.step_taken,
                td.solution_applied,
                td.ticket_updated,

                p.employee_id AS requester_employee_id,
                e.first_name  AS requester_first_name,
                e.last_name AS requester_last_name
            ');

        // ta.ticket_assigned_id,

        //     u.user_id,
        //     emp.first_name AS assigned_first_name,
        //     emp.last_name AS assigned_last_name

        $this->db->from('ticket_details td');
        $this->db->join('ticket_type tt', 'tt.ticket_type_id = td.ticket_type_id', 'left');
        $this->db->join('priorities tp', 'tp.priority_id = td.priority_id', 'left');
        $this->db->join('departments d', 'd.department_id = td.department_id');
        $this->db->join('permitted_requester p', 'p.permission_id = td.requester_id');
        $this->db->join('employees e', 'e.employee_id = p.employee_id', 'left');

        // if ($id) {
        //     $this->db->where('d.user_id', $id);
        // }

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_ticket_assigned() {
        $this->db->select('
                ta.ticket_id, ta.user_id, u.employee_id, e.first_name, e.last_name,
                d.department_name
                ');
        $this->db->from('ticket_assigned ta');
        $this->db->join('users u', 'u.user_id = ta.user_id');
        $this->db->join('employees e', 'e.employee_id = u.employee_id');
        $this->db->join('departments d', 'd.department_id = e.department_id');
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
            'priority_id' => $this->input->post('priority'),
            'department_id' => $this->input->post('selectDepartment'),
            'requester_id' => $this->session->userdata('user_id'),
            'ticket_status' => 'Open'
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

        $this->db->trans_complete();

        // CHECK IF SUCCESS
        if ($this->db->trans_status() === FALSE) {
            return false;
        }
    }
}
