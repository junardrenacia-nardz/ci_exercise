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

    public function get_escalations() {
        $query = $this->db->get('escalations');
        return $query->result_array();
    }


    public function get_users($id = FALSE) {
        $this->db->select('CONCAT("UID-", LPAD(u.user_id, 5, "0")) as user_id, u.employee_id, u.email, u.updated_at,, u.last_active, u.created_at, e.first_name, e.last_name, e.department_id, e.status,
                    e.gender, a.access_name, d.department_name, p.position_name, e.contact_number, e.department_id, e.position_id, e.escalation_id, u.access_id');
        $this->db->from('users u');
        $this->db->join('employees e', 'e.employee_id = u.employee_id', 'left');
        $this->db->join('access_types a', 'a.access_id = u.access_id', 'left');
        $this->db->join('departments d', 'd.department_id = e.department_id', 'left');
        $this->db->join('positions p', 'p.position_id = e.position_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function login($password) {
        $email = $this->input->post('email');

        $this->db->select('u.user_id, u.employee_id, u.password, e.status, e.gender');
        $this->db->from('users u');
        $this->db->join('employees e', 'e.employee_id = u.employee_id', 'left');
        $this->db->where('u.email', $email);
        $result = $this->db->get();
        $row = $result->row();
        $password_stored = $row->password;

        if (password_verify($password, $password_stored)) {
            if ($result->num_rows() == 1) {
                date_default_timezone_set('Asia/Manila');
                $data['last_active'] = date("Y-m-d H:i:s", time());
                $this->db->where('email', $email);
                $this->db->update('users', $data);
                return $result->row_array();
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
            'gender' => $this->input->post('gender'),
            'contact_number' => $this->input->post('contact'),
            'department_id' => $this->input->post('department'),
            'position_id' => $this->input->post('position'),
            'status' => 'Active',
            'escalation_id' => $this->input->post('tier')
        ];

        $this->db->insert('employees', $employeeData);
        $employeeID = $this->db->insert_id();

        $userData = [
            'employee_id' => $employeeID,
            'email' => $this->input->post('email'),
            'password' => $hashed_password,
            'access_id' => $this->input->post('role')
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

    public function get_roles() {

        $query = $this->db->get('access_types');
        return $query->result_array();
    }

    public function update_employee_status($employee_id, $status) {
        $employeeStatus['status'] = ucfirst($status);
        $this->db->where('employee_id', $employee_id);
        $this->db->update('employees', $employeeStatus);
        return true;
    }

    public function delete_pending_user($user_id, $employee_id) {
        $this->db->trans_start();
        $this->db->where('user_id', $user_id);
        $this->db->delete('users');

        $this->db->where('employee_id', $employee_id);
        $this->db->delete('employees');
        $this->db->trans_complete();
        return true;
    }

    public function update_user($user_id, $employee_id) {
        $this->db->trans_start();
        $userData = [
            'email' => $this->input->post('email'),
            'access_id' => $this->input->post('role')
        ];

        $employeeData = [
            'first_name' => $this->input->post('firstName'),
            'last_name' => $this->input->post('lastName'),
            'gender' => $this->input->post('gender'),
            'contact_number' => $this->input->post('contact'),
            'department_id' => $this->input->post('department'),
            'position_id' => $this->input->post('position'),
            'escalation_id' => $this->input->post('tier')
        ];

        $this->db->where("user_id", $user_id);
        $this->db->update("users", $userData);

        $this->db->where("employee_id", $employee_id);
        $this->db->update("employees", $employeeData);

        $this->db->trans_complete();
        return true;
    }

    // public function update_time() {
    //     date_default_timezone_set('Asia/Manila');
    //     $this->db->where('id', $this->session->userdata('user_id'));
    //     $this->db->update('users', [
    //         'last_active' => date('Y-m-d H:i:s', time())
    //     ]);
    // }
}