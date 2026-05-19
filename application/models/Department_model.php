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

        $query = $this->db->get_where('departments', array('department_id' => $id));
        return $query->row_array();
    }

    public function add_department() {
        $data['department_name'] = $this->input->post('department_name');
        $this->db->insert('departments', $data);
        return true;
    }

    public function update_department() {
        $data['department_name'] = $this->input->post('department_name');
        $this->db->where('department_id', $this->input->post('department_id'));
        $this->db->update('departments', $data);
        return true;
    }

    public function update_department_status($status) {
        $data['status'] = $status;
        $this->db->where('department_id', $this->input->post('department_id'));
        $this->db->update('departments', $data);
        return true;
    }
}