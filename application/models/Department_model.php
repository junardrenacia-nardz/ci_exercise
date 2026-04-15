<?php
class Department_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get_departments($id = FALSE) {
        if ($id === FALSE) {
            $query = $this->db->get('departments');
            return $query->result_array();
        }
    }
}
