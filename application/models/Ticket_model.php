<?php

class Ticket_model extends CI_Model {
    public function create_ticket() {
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

        $data = [
            'ticket_id' => $ticketID,
            'ticket_name' => $this->input->post('ticketSubject'),
            'ticket_description' => $this->input->post('ticketDescription'),
            'ticket_type_id' => $this->input->post('requestType'),
            'priority_id' => $this->input->post('priority'),
            'department_id' => $this->input->post('selectDepartment'),
            'requester_id' => $this->session->userdata('user_id'),
            'ticket_status' => 'Open'
        ];

        $this->db->insert('ticket_details', $data);

        $this->db->trans_complete();

        // CHECK IF SUCCESS
        if ($this->db->trans_status() === FALSE) {
            return false;
        }
    }
}
