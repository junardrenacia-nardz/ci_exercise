<?php

class Tickets extends CI_Controller {
    public function index() {
        $data['title'] = 'My Ticket';


        $this->load->view('templates/header', $data);
        $this->load->view('templates/footer');
    }
}
