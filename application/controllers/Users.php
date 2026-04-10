<?php

/**
 * @property CI_Form_validation $form_validation
 * @property User_model $user_model
 * @property CI_Input $input
 * @property CI_Session $session
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

            redirect('posts');
        }
    }

    public function register() {
        $data['title'] = "Registration";

        $step = $this->input->post('step') ?? 1;
        $direction = $this->input->post('direction');

        $sessionData = $this->session->userdata('register') ?? [];

        // MERGE NEW DATA FROM FORM
        $postData = $this->input->post();
        unset($postData['step'], $postData['direction']);

        if (!empty($postData)) {
            $sessionData = array_merge($sessionData, $postData);
            $this->session->set_userdata('register', $sessionData);
        }

        // HANDLE BACK
        if ($direction === 'back') {
            $step--;
        }

        // STEP ROUTING
        if ($step == 1) {
            $data['form'] = $sessionData;
            $this->load->view('users/create', $data);
        } elseif ($step == 2) {
            $data['form'] = $sessionData;
            $this->load->view('users/register_step2', $data);
        } elseif ($step == 3) {

            // FINAL VALIDATION
            $this->form_validation->set_rules('firstName', 'First Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');

            if ($this->form_validation->run() == TRUE) {

                // SAVE TO DATABASE HERE
                // $this->user_model->insert($sessionData);

                // CLEAR EVERYTHING
                $this->session->unset_userdata('register');
                echo "<script>localStorage.removeItem('registerDraft');</script>";

                redirect('success');
            } else {
                $this->load->view('users/register_step1', $data);
            }
        }
        // $this->form_validation->set_rules('firstName', 'First Name', 'required');
        // $this->form_validation->set_rules('lastName', 'Last Name', 'required');


        $this->load->view('users/create', $data);
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
