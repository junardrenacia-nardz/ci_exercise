<?php

class User_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function login($password) {
        $email = $this->input->post('email');

        $this->db->where('email', $email);
        $result = $this->db->get('users');
        $row = $result->row();
        $password_stored = $row->password;

        if (password_verify($password, $password_stored)) {
            if ($result->num_rows() == 1) {
                return $result->row(0)->user_id;
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
