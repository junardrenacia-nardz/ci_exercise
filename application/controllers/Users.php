<?php

/**
 * @property CI_Form_validation $form_validation
 */

class Users extends CI_Controller {
    public function login() {

        $this->load->view('templates/header');
        $this->load->view('templates/footer');
    }

    public function register() {
        $data['title'] = "Registration";

        // $this->form_validation->set_rules('firstName', 'First Name', 'required');
        // $this->form_validation->set_rules('lastName', 'Last Name', 'required');


        $this->load->view('templates/header');
        $this->load->view('templates/footer');
    }
}
