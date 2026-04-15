<?php

class Priority_model extends CI_model {
    public function get_priorities($id = FALSE) {
        if ($id === FALSE) {
            $query = $this->db->get('priorities');
            return $query->result_array();
        }
    }
}
