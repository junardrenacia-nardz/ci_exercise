<?php

/**
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property Comment_model $comment_model
 * @property CI_Upload $upload
 */

class Comments extends CI_Controller {
    public function addComments($ticket_id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('users');
        }

        $user_id = $this->session->userdata('user_id');

        $this->form_validation->set_rules("comment", "Comment", "required");

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('showModal', 'add_comment');
            $this->session->set_flashdata('message', [
                'type' => 'error', // or 'success'
                'text' => 'Cannot add the comment'
            ]);
            return redirect('tickets/view_ticket/' . $ticket_id); // ✅ IMPORTANT
        } else {
            $this->session->set_flashdata('message', [
                'type' => 'success', // or 'success'
                'text' => 'The comment was added successfully'
            ]);

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

                $config['upload_path'] = './assets/images/comment_attachments';
                $config['max_size'] = 5000; // 2MB
                $config['encrypt_name']  = TRUE;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('file')) {
                    $uploadData = $this->upload->data();
                    $fileNames[] = [
                        'encryptedName' => $uploadData['file_name'],
                        'origName'      => $uploadData['orig_name']
                    ];
                } else {
                    if (!empty($_FILES['file']['name'])) {
                        if ($_FILES['file']['size'] > (5000 * 1024)) {
                            $this->session->set_flashdata('showModal', 'add_comment');
                            $this->session->set_flashdata('message', [
                                'type' => 'error', // or 'success'
                                'text' => 'Attachment(s) is/are not valid'
                            ]);
                            return redirect('tickets/view_ticket/' . $ticket_id); // ✅ IMPORTANT
                        }
                    }
                }
            }

            $this->comment_model->add_comment($fileNames, $ticket_id, $user_id);
            return redirect('tickets/view_ticket/' . $ticket_id);
        }
    }
}
