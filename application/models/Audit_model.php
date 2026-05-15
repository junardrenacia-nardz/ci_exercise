<?php

class Audit_model extends CI_Model {
    public function ticket_audit($ticket_id, $user_id, $description, $action) {
        $data = [
            'ticket_id' => $ticket_id,
            'user_id' => $user_id,
            'description' => $description,
            'action' => $action
        ];

        return $this->db->insert('audit_tickets', $data);
    }


}