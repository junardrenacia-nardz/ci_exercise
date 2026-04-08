<?php

class Tasks extends CI_Controller {
    public function index() {
        $data['title'] = 'Tasks';


        $this->load->view('templates/header', $data);
        $this->load->view('templates/footer');
    }
}
