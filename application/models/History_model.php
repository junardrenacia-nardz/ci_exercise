<?php
class History_model extends CI_Model {
    public function get_history_tickets($id = FALSE) {
        $this->db->select('
        h.action,
        h.history_ticket_id,
        h.ticket_id,
        h.user_id,
        h.description,
        h.history_date,
        e.first_name,
        e.last_name
    ');

        $this->db->from('history_tickets h');
        $this->db->join('users u', 'u.user_id = h.user_id');
        $this->db->join('employees e', 'e.employee_id = u.employee_id');
        $this->db->where('h.ticket_id', $id);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function ticket_history($ticket_id, $user_id, $description, $action) {
        $data = [
            'ticket_id' => $ticket_id,
            'user_id' => $user_id,
            'description' => $description,
            'action' => $action
        ];

        return $this->db->insert('history_tickets', $data);
    }
}