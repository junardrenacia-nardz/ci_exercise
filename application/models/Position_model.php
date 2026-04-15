<?php
class Position_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get_positions($id = FALSE) {
        if ($id === FALSE) {
            $query = $this->db->get('positions');
            return $query->result_array();
        }

        $query = $this->db->get_where('positions', array('department_id' => $id));
        return $query->result_array();
    }
}
