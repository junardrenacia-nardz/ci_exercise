<?php

/**
 * @property CI_Session $session
 * @property Department_model $department_model
 * @property Ticket_type_model $ticket_type_model
 * @property Ticket_model $ticket_model
 * @property Priority_model $priority_model
 * @property CI_Form_validation $form_validation
 * @property User_model $user_model
 * @property CI_Upload $upload
 */

class Tickets extends CI_Controller {
    public function index() {
        if (!$this->session->userdata('logged_in')) {
            redirect('users');
        }
        $employee_id = $this->session->userdata('employee_id');
        $data['logged_user'] = $this->user_model->get_employee_details($employee_id);
        $data['title'] = 'My Ticket';

        $data['ticket_details'] = $this->ticket_model->get_tickets();
        $data['ticket_assigned'] = $this->ticket_model->get_ticket_assigned();
        $this->load->view('templates/header', $data);
        $this->load->view('tickets/ticket_index', $data);
        $this->load->view('templates/footer');
    }

    public function view_ticket($ticket_id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('users');
        }
        $employee_id = $this->session->userdata('employee_id');
        $data['logged_user'] = $this->user_model->get_employee_details($employee_id);
        $data['title'] = 'Ticket Detail';

        $data['ticket'] = $this->ticket_model->get_tickets($ticket_id);
        $data['ticket_assigned'] = $this->ticket_model->get_ticket_assigned();
        $this->load->view('templates/header', $data);
        $this->load->view('tickets/view_ticket', $data);
        $this->load->view('templates/footer');
    }

    public function createTicket() {
        if (!$this->session->userdata('logged_in')) {
            redirect('users');
        }

        $data['departments'] = $this->department_model->get_departments();
        $data['ticket_types'] = $this->ticket_type_model->get_ticket_types();
        $data['priorities'] = $this->priority_model->get_priorities();

        $employee_id = $this->session->userdata('employee_id');
        $data['logged_user'] = $this->user_model->get_employee_details($employee_id);

        $data['title'] = 'Create Ticket';

        $this->form_validation->set_rules('ticketSubject', 'Subject', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('tickets/create_ticket', $data);
            $this->load->view('templates/footer');
        } else {
            $files_uploaded = $_FILES['fileUploads'];

            $count = count($_FILES['fileUploads']['name']);

            $fileNames = [];

            $this->load->library('upload');

            for ($i = 0; $i < $count; $i++) {
                $_FILES['file']['name'] = $files_uploaded['name'][$i];
                $_FILES['file']['type'] = $files_uploaded['type'][$i];
                $_FILES['file']['tmp_name'] = $files_uploaded['tmp_name'][$i];
                $_FILES['file']['error'] = $files_uploaded['error'][$i];
                $_FILES['file']['size'] = $files_uploaded['size'][$i];

                $config['upload_path'] = './assets/images/ticket_attachments';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|docx|ppt|pptx|zip|rar|pdf';
                $config['encrypt_name']  = TRUE;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('file')) {
                    $uploadData = $this->upload->data();
                    $fileNames[] = [
                        'encryptedName' => $uploadData['file_name'],
                        'origName'      => $uploadData['orig_name']
                    ];
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->ticket_model->create_ticket($fileNames);
            redirect('tickets');
        }
    }
}
