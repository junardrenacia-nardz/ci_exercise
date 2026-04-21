<?php

class User_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_employee_details($employee_id) {
        $query = $this->db->get_where('employees', array('employee_id' => $employee_id));
        return $query->row_array();
    }


    public function get_users($id = FALSE) {
        $this->db->select('u.user_id, e.first_name, e.last_name, e.department_id, e.status');
        $this->db->from('users u');
        $this->db->join('employees e', 'e.employee_id = u.employee_id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function login($password) {
        $email = $this->input->post('email');

        $this->db->where('email', $email);
        $result = $this->db->get('users');
        $row = $result->row();
        $password_stored = $row->password;

        if (password_verify($password, $password_stored)) {
            if ($result->num_rows() == 1) {
                return [
                    'user_id' => $result->row(0)->user_id,
                    'employee_id' => $result->row(0)->employee_id
                ];
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function register($hashed_password) {
        // Start of Transaction
        $this->db->trans_start();

        $employeeData = [
            'first_name' => $this->input->post('firstName'),
            'last_name' => $this->input->post('lastName'),
            'contact_number' => $this->input->post('contact'),
            'department_id' => $this->input->post('department'),
            'position_id' => $this->input->post('role'),
            'status' => 'Active',
            'escalation_level' => $this->input->post('tier'),
        ];

        $this->db->insert('employees', $employeeData);
        $employeeID = $this->db->insert_id();

        $userData = [
            'employee_id' => $employeeID,
            'email' => $this->input->post('email'),
            'password' => $hashed_password
        ];

        $this->db->insert('users', $userData);

        // End of Transaction
        $this->db->trans_complete();

        // CHECK IF SUCCESS
        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return $employeeID;
    }
    public function check_email_exists($email) {
        $query = $this->db->get_where('users', array('email' => $email));
        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }
}
