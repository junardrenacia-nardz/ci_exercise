<?php

use Dom\Comment;

/**
 * @property CI_Session $session
 * @property Department_model $department_model
 * @property Ticket_type_model $ticket_type_model
 * @property Ticket_model $ticket_model
 * @property Priority_model $priority_model
 * @property CI_Form_validation $form_validation
 * @property User_model $user_model
 * @property CI_Upload $upload
 * @property CI_Input $input
 * @property Comment_model $comment_model
 */

class Tickets extends CI_Controller {
    public function index($status = "") {
        if (!$this->session->userdata('logged_in')) {
            redirect('users');
        }
        $employee_id = $this->session->userdata('employee_id');
        $data['logged_user'] = $this->user_model->get_employee_details($employee_id);
        $data['title'] = 'Tickets';

        $data['ticket_details'] = $this->ticket_model->get_tickets() ?? [];
        $data['ticket_assigned'] = $this->ticket_model->get_ticket_assigned();
        $data['departments'] = $this->department_model->get_departments();
        if ($status == "all") {
            $data['activeAll'] = true;
            $this->load->view('templates/header', $data);
            $this->load->view('templates/process_header', $data);
            $this->load->view('tickets/ticket_index', $data);
            $this->load->view('templates/footer');
        } else if ($status == "approval") {
            $data['activeApproval'] = true;
            $this->load->view('templates/header', $data);
            $this->load->view('templates/process_header', $data);
            $this->load->view('tickets/process-tickets/ticket_approval', $data);
            $this->load->view('templates/footer');
        } else if ($status == "open") {
            $data['activeOpen'] = true;
            $this->load->view('templates/header', $data);
            $this->load->view('templates/process_header', $data);
            $this->load->view('tickets/process-tickets/ticket_open', $data);
            $this->load->view('templates/footer');
        } else if ($status == "pending") {
            $data['activePending'] = true;
            $this->load->view('templates/header', $data);
            $this->load->view('templates/process_header', $data);
            $this->load->view('tickets/process-tickets/ticket_pending', $data);
            $this->load->view('templates/footer');
        } else if ($status == "ongoing") {
            $data['activeOnGoing'] = true;
            $this->load->view('templates/header', $data);
            $this->load->view('templates/process_header', $data);
            $this->load->view('tickets/process-tickets/ticket_ongoing', $data);
            $this->load->view('templates/footer');
        } else if ($status == "testing") {
            $data['activeTesting'] = true;
            $this->load->view('templates/header', $data);
            $this->load->view('templates/process_header', $data);
            $this->load->view('tickets/process-tickets/ticket_testing', $data);
            $this->load->view('templates/footer');
        } else if ($status == "closed") {
            $data['activeClosed'] = true;
            $this->load->view('templates/header', $data);
            $this->load->view('templates/process_header', $data);
            $this->load->view('tickets/process-tickets/ticket_closed', $data);
            $this->load->view('templates/footer');
        }
    }

    public function view_ticket($ticket_id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('users');
        }
        $employee_id = $this->session->userdata('employee_id');
        $data['logged_user'] = $this->user_model->get_employee_details($employee_id);
        $data['title'] = 'Ticket Details';
        $data['departments'] = $this->department_model->get_departments();
        $data['ticket'] = $this->ticket_model->get_tickets($ticket_id);
        $data['ticket_assigned'] = $this->ticket_model->get_ticket_assigned();
        $data['all_assigned'] = $this->user_model->get_users();
        $data['comments'] = $this->comment_model->get_comments($ticket_id);
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
        $this->form_validation->set_rules('ticketDescription', "Ticket Description", "required");
        $this->form_validation->set_rules("selectDepartment", "Department", "required");
        $this->form_validation->set_rules("requestType", "Request Type", "required");

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
            $this->session->unset_userdata('temp_files');
            redirect('tickets/all');
        }
    }

    public function reassign_department($ticket_id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('users');
        }
        $this->form_validation->set_rules('selectDepartment', "Department", "required");

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('showModal', 'edit_department');
            $this->session->set_flashdata('message', [
                'type' => 'error', // or 'success'
                'text' => 'Re-assigning failed'
            ]);
            return redirect('tickets/view_ticket/' . $ticket_id); // ✅ IMPORTANT
        } else {
            $this->session->set_flashdata('showModal', 'modal_department');
            $this->session->set_flashdata('message', [
                'type' => 'success', // or 'success'
                'text' => 'Re-assigning of department is successful'
            ]);
            $this->ticket_model->change_department($ticket_id);
            return redirect('tickets/view_ticket/' . $ticket_id); // ✅ IMPORTANT
        }
    }

    public function assign_ticket($ticket_id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('users');
        }
        $user_id = $this->session->userdata('user_id');

        $names = $this->input->post('employeeName') ?? []; // This is an array
        if (empty($names)) {
            // force validation failure
            $this->form_validation->set_rules('employeeName', 'Assignees', 'required');
        } else {
            foreach ($names as $key => $name) {
                $this->form_validation->set_rules(
                    "employeeName[$key]",
                    "Assignee #" . ($key + 1),
                    "required"
                );
            }
        }

        $this->form_validation->set_rules("expectedStart", "Expected Start", "required");
        $this->form_validation->set_rules("expectedEnd", "Expected End", "required");

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('showModal', 'edit_assign_person');
            $this->session->set_flashdata('message', [
                'type' => 'danger', // or 'success'
                'text' => "Assigning to $ticket_id failed"
            ]);

            $this->session->set_flashdata('old_input', $this->input->post());
            return redirect('tickets/view_ticket/' . $ticket_id);
        } else {
            $this->session->set_flashdata('showModal', 'modal_assign_person');
            $this->session->set_flashdata('message', [
                'type' => 'success', // or 'success'
                'text' => "New individual(s) assigned to $ticket_id"
            ]);

            if ($this->input->post('prev_id')) {
                $prevId = $this->input->post('prev_id');
                $this->ticket_model->assign_person($names, $ticket_id, $prevId);
                return redirect('tickets/view_ticket/' . $ticket_id);
            }

            $this->ticket_model->assign_person($names, $ticket_id);
            return redirect('tickets/view_ticket/' . $ticket_id);
        }
    }

    public function clear_assign_modal_state() {
        $this->session->unset_userdata('old_input');
        $this->session->unset_userdata('showModal');
    }

    public function uploadTemp() {
        $files_uploaded = $_FILES['files'];
        $count = count($_FILES['fileUploads']['name']);
        $uploaded = [];

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
                $uploaded[] = [
                    'encryptedName' => $uploadData['file_name'],
                    'origName'      => $uploadData['orig_name']
                ];
            } else {
                echo $this->upload->display_errors();
            }
        }

        // store in session
        $this->session->set_userdata('temp_files', $uploaded);

        echo json_encode(['files' => $uploaded]);
    }

    public function dashboard() {
        if (!$this->session->userdata('logged_in')) {
            redirect('users');
        }

        $data['ticket_details'] = $this->ticket_model->get_tickets();
        $data['ticket_assigned'] = $this->ticket_model->get_ticket_assigned();
        $data['departments'] = $this->department_model->get_departments();
        $data['ticket_types'] = $this->ticket_type_model->get_ticket_types();
        $data['priorities'] = $this->priority_model->get_priorities();

        $employee_id = $this->session->userdata('employee_id');
        $data['logged_user'] = $this->user_model->get_employee_details($employee_id);

        $data['title'] = "Dashboard";
        $this->load->view("templates/header", $data);
        $this->load->view("dashboards/dashboard");
        $this->load->view("templates/footer");
    }
}
