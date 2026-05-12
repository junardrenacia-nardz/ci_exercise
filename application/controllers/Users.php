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
                if (strtolower($user_id['status']) === strtolower("pending")) {
                    $this->session->set_flashdata('login_failed', 'The account is not approved yet. Contact the admin regarding the issue');
                    $this->load->view('users/login', $data);
                    return;
                } else if (strtolower($user_id['status']) === strtolower("deactivated")) {
                    $this->session->set_flashdata('login_failed', 'The account is deactivated. Contact the admin regarding the issue');
                    $this->load->view('users/login', $data);
                    return;
                }
                $user_data = [
                    'user_id' => $user_id['user_id'],
                    'employee_id' => $user_id['employee_id'],
                    'email' => $email,
                    'logged_in' => true,
                    'gender' => $user_id['gender']
                ];

                $this->session->set_userdata($user_data);
                $this->session->set_flashdata('user_loggedin', 'You are now logged in');
                redirect('tickets/all');
            } else {
                $this->session->set_flashdata('login_failed', 'Password is incorrect. Login is invalid');
                $this->load->view('users/login', $data);
                return;
            }
        }
    }

    public function register() {
        $this->form_validation->set_rules('firstName', 'First Name', 'required');
        $this->form_validation->set_rules('lastName', 'Last Name', 'required');
        $this->form_validation->set_rules('contact', 'Contact', 'required|callback_validate_contact');
        $this->form_validation->set_rules('department', 'Department', 'required');
        $this->form_validation->set_rules('role', "Role", 'required');
        $this->form_validation->set_rules('gender', "Gender", 'required');
        $this->form_validation->set_rules('position', "Position", 'required');
        $this->form_validation->set_rules('tier', "Escalation", 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email_exists');

        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('showModal', 'add_user');
            $this->session->set_flashdata('message', [
                'type' => 'danger', // or 'success'
                'text' => 'The input(s) is/are invalid. Try Again'
            ]);

            $this->session->set_flashdata('old_input', $this->input->post());
            $this->session->set_flashdata('errors', $this->form_validation->error_array());
            return redirect('users/user_index'); // ✅ IMPORTANT
        } else {
            $this->session->set_flashdata('message', [
                'type' => 'success', // or 'success'
                'text' => 'New user is added successfully'
            ]);

            $first_name = ucfirst(explode(' ', trim($this->input->post('firstName')))[0]);
            $last_name = ucfirst(str_replace(' ', '', $this->input->post('lastName')));
            $last4Num = substr($this->input->post('contact'), -4);

            $pass = $last_name . "_" . $first_name . "@" . $last4Num;
            $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
            $this->user_model->register($hashed_pass);
            return redirect('users/user_index');
        }
    }
    public function logout() {
        date_default_timezone_set('Asia/Manila');
        $data['last_active'] = date("Y-m-d H:i:s", time());
        $this->db->where('user_id', $this->session->userdata['user_id']);
        $this->db->update('users', $data);
        $this->session->sess_destroy();
        redirect('users');
    }

    public function user_index() {
        if (!$this->session->userdata('logged_in')) {
            redirect('users');
        }
        $employee_id = $this->session->userdata('employee_id');
        $data['logged_user'] = $this->user_model->get_employee_details($employee_id);
        $data['title'] = 'Users Management';

        $data['users'] = $this->user_model->get_users();
        $data['roles'] = $this->user_model->get_roles();
        $data['departments'] = $this->department_model->get_departments();
        $data['positions'] = $this->position_model->get_positions();
        $data['escalations'] = $this->user_model->get_escalations();

        $this->load->view('templates/header', $data);
        $this->load->view('users/user-management/user_index', $data);
        $this->load->view('templates/footer');
    }

    // public function edit_user($user_id) {
    //     $this->form_validation->set_rules('firstName', 'First Name', 'required');
    //     $this->form_validation->set_rules('lastName', 'Last Name', 'required');
    //     $this->form_validation->set_rules('contact', 'Contact', 'required|callback_validate_contact');
    //     $this->form_validation->set_rules('department', 'Department', 'required');
    //     $this->form_validation->set_rules('role', "Role", 'required');
    //     $this->form_validation->set_rules('gender', "Gender", 'required');
    //     $this->form_validation->set_rules('position', "Position", 'required');
    //     $this->form_validation->set_rules('tier', "Escalation", 'required');
    //     $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    //     $data['user'] = $this->user_model->get_users($user_id);
    //     $data['roles'] = $this->user_model->get_roles();
    //     $data['departments'] = $this->department_model->get_departments();
    //     $data['positions'] = $this->position_model->get_positions();
    //     $data['escalations'] = $this->user_model->get_escalations();

    //     if ($this->form_validation->run() == FALSE) {
    //         $this->session->set_flashdata('message', [
    //             'type' => 'danger', // or 'success'
    //             'text' => 'The input(s) is/are invalid. Try Again'
    //         ]);

    //         $this->session->set_flashdata('old_input', $this->input->post());
    //         $this->session->set_flashdata('errors', $this->form_validation->error_array());

    //         return json_encode($data);
    //     } else {
    //         $this->session->set_flashdata('message', [
    //             'type' => 'success', // or 'success'
    //             'text' => "User $user_id is updated successfully"
    //         ]);

    //         $this->user_model->update_user($user_id, $data['user']['employee_id']);

    //         return redirect('users/user_index');
    //     }
    // }

    public function edit_user() {

        $user_id = $this->input->post('id');

        $data['user'] = $this->user_model->get_users($user_id);

        echo json_encode($data);
    }

    public function update_user() {
        $user_id = $this->input->post('user_id');

        $this->form_validation->set_rules('firstName', 'First Name', 'required');
        $this->form_validation->set_rules('lastName', 'Last Name', 'required');
        $this->form_validation->set_rules('contact', 'Contact', 'required|callback_validate_contact');
        $this->form_validation->set_rules('department', 'Department', 'required');
        $this->form_validation->set_rules('role', "Role", 'required');
        $this->form_validation->set_rules('gender', "Gender", 'required');
        $this->form_validation->set_rules('position', "Position", 'required');
        $this->form_validation->set_rules('tier', "Escalation", 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            // $this->session->set_flashdata('showModal', "edit_user");
            $this->session->set_flashdata('message', [
                'type' => 'danger', // or 'success'
                'text' => 'The input(s) is/are invalid. Try Again'
            ]);
            $data['inputs'] = $this->input->post();
            $data['errors'] = $this->form_validation->error_array();
            $data['status'] = 'error';
            echo json_encode($data);
            return;
        }


        $this->session->set_flashdata('message', [
            'type' => 'success', // or 'success'
            'text' => "User $user_id is updated successfully"
        ]);

        $id = explode('-', $user_id)[1];

        $this->user_model->update_user($id, $this->input->post('employee_id'));

        $data['status'] = 'success';
        echo json_encode($data);

    }


    public function update_employee_status($employee_id, $status, $user_id, $modal = FALSE) {
        if (strtolower($status) == strtolower("active") && $modal) {
            $this->session->set_flashdata('showModal', $modal);
        }

        $this->session->set_flashdata('message', [
            'type' => 'success', // or 'success'
            'text' => "User $user_id is now $status"
        ]);
        $this->user_model->update_employee_status($employee_id, $status);
        return redirect('users/user_index');
    }

    public function delete_pending_user($user_id, $employee_id) {
        $this->session->set_flashdata('showModal', 'approve_user');
        $this->session->set_flashdata('message', [
            'type' => 'success', // or 'success'
            'text' => "User $user_id is deleted successfully"
        ]);
        $this->user_model->delete_pending_user($user_id, $employee_id);
        return redirect('users/user_index');
    }



    public function change_password() {
        $this->form_validation->set_rules('oldPassword', "Old Password", "required");
        $this->form_validation->set_rules('newPassword', 'Password', 'required|callback_validate_password');
        $this->form_validation->set_rules('confirmPassword', 'Confirm Password', 'matches[password]');

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

    function check_email_exists($email) {
        $this->form_validation->set_message(['check_email_exists' => 'That email is taken. Please choose a different one']);
        if ($this->user_model->check_email_exists($email)) {
            return true;
        } else {
            return false;
        }
    }


    function find_email($email) {
        $this->form_validation->set_message(['find_email' => 'That email does not exist']);
        if (!$this->user_model->check_email_exists($email)) {
            return true;
        } else {
            return false;
        }
    }

    public function update_last_active() {
        $user_id = $this->session->userdata('user_id');

        if (!$user_id)
            return;
        date_default_timezone_set('Asia/Manila');
        $this->db->where('user_id', $user_id);
        $this->db->update('users', [
            'last_active' => date('Y-m-d H:i:s'),
            'is_online' => 1
        ]);

        echo json_encode(['status' => 'ok']);
    }

}