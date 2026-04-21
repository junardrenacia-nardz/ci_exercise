<?php

/**
 * @property CI_Form_validation $form_validation
 * @property User_model $user_model
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_Output $output
 * @property CI_DB $db
 * @property Department_model $department_model
 * @property Position_model $position_model
 */

class Users extends CI_Controller {

    public function login() {
        $data['title'] = "Login";

        $this->form_validation->set_rules('email', 'Email', 'required|callback_find_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('users/login', $data);
        } else {
            $user_id = $this->user_model->login($this->input->post('password'));
            $email = $this->input->post('email');

            if ($user_id) {
                $user_data = [
                    'user_id' => $user_id['user_id'],
                    'employee_id' => $user_id['employee_id'],
                    'email' => $email,
                    'logged_in' => true
                ];

                $this->session->set_userdata($user_data);
                $this->session->set_flashdata('user_loggedin', 'You are now logged in');
                redirect('tickets');
            } else {
                $this->session->set_flashdata('login_failed', 'Password is incorrect. Login is invalid');
                $this->load->view('users/login', $data);
            }
        }
    }

    public function register() {
        $data = $this->input->post();

        $data['departments'] = $this->department_model->get_departments();

        // ✅ LOAD ALL POSITIONS (important for JS filtering)
        $data['positions'] = $this->position_model->get_positions();


        $data['title'] = 'Registration';

        $this->form_validation->set_rules('firstName', 'First Name', 'required');
        $this->form_validation->set_rules('lastName', 'Last Name', 'required');
        $this->form_validation->set_rules('contact', 'Contact', 'required|callback_validate_contact');
        $this->form_validation->set_rules('department', 'Department', 'required');
        $this->form_validation->set_rules('role', "Role", 'required');
        $this->form_validation->set_rules('tier', "Tier", 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|callback_validate_password');
        $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('users/create', $data);
        } else {
            $hashed_pass = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $this->user_model->register($hashed_pass);

            redirect('users');
        }
    }


    public function logout() {
        $this->session->sess_destroy();

        redirect('users');
    }



    function validate_password($password) {
        if (strlen($password) < 8) {
            $this->form_validation->set_message([
                'validate_password' =>
                "Password must have at least 8 character"
            ]);
            return false;
        } else if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&-])[A-Za-z\d@$!%*?&-]{8,}$/', $password)) {
            $this->form_validation->set_message([
                'validate_password' =>
                "Password must be the combination of Letters, Numbers, and Special Characters"
            ]);
            return false;
        }

        return true;
    }

    function validate_contact($contact) {
        if (!preg_match('/^09/', $contact)) {
            $this->form_validation->set_message([
                'validate_contact' =>
                'Must start with "09"'
            ]);
            return false;
        } else if (!preg_match('/^09\d{9}$/', $contact)) {
            $this->form_validation->set_message([
                'validate_contact' =>
                "Must have the length of 11 digits"
            ]);
            return false;
        }
        return true;
    }


    function find_email($email) {
        $this->form_validation->set_message(['find_email' => 'That email does not exist']);
        if (!$this->user_model->check_email_exists($email)) {
            return true;
        } else {
            return false;
        }
    }
}
