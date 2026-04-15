<?php

/**
 * @property CI_Session $session
 * @property Department_model $department_model
 * @property Ticket_type_model $ticket_type_model
 * @property Ticket_model $ticket_model
 * @property Priority_model $priority_model
 * @property CI_Form_validation $form_validation
 */

class Tickets extends CI_Controller {
    public function index() {
        $data['title'] = 'My Ticket';
        $this->load->view('templates/header', $data);
        $this->load->view('tickets/ticket_index');
        $this->load->view('templates/footer');
    }

    public function createTicket() {
        if (!$this->session->userdata('logged_in')) {
            redirect('users');
        }

        $data['departments'] = $this->department_model->get_departments();
        $data['ticket_types'] = $this->ticket_type_model->get_ticket_types();
        $data['priorities'] = $this->priority_model->get_priorities();

        $data['title'] = 'Create Ticket';

        $this->form_validation->set_rules('ticketSubject', 'Subject', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('tickets/create_ticket', $data);
            $this->load->view('templates/footer');
            echo "<script>alert('There is an error')</script>";
        } else {
            $this->ticket_model->create_ticket();
            redirect('tickets');
        }
    }
}
