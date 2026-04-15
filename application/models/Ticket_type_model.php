<?php
class Ticket_type_model extends CI_Model {
    public function get_ticket_types($id = FALSE) {
        if ($id === FALSE) {
            $query = $this->db->get('ticket_type');
            return $query->result_array();
        }
        $query = $this->db->get_where('ticket_type', array('ticket_type_id' => $id));
        return $query->result_array();
    }

    public function get_ticket_types_by_department($dept_id) {
        $query = $this->db->get_where('ticket_type', array('department_id' => $dept_id));
        return $query->result_array();
    }
}
