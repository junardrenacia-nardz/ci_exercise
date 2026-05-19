<?php

class Departments extends CI_Controller {
    public function get_departments() {
        if (!$this->session->userdata('logged_in')) {
            redirect('users');
        }
        $employee_id = $this->session->userdata('employee_id');
        $data['logged_user'] = $this->user_model->get_employee_details($employee_id);
        $data['title'] = 'Departments';
        $data['departments'] = $this->department_model->get_departments();

        $this->load->view('templates/header', $data);
        $this->load->view('departments/department');
        $this->load->view('templates/footer');
    }

    public function add_department() {
        if (!$this->session->userdata('logged_in')) {
            redirect('users');
        }
        $this->form_validation->set_rules('department_name', 'Department Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('errors', $this->form_validation->error_array());
            $this->session->set_flashdata('showModal', 'addDepartmentModal');
            $this->session->set_flashdata('message', [
                'type' => 'danger', // or 'success'
                'text' => 'Department creation failed'
            ]);
            return redirect('departments/get_departments'); // ✅ IMPORTANT
        } else {
            $this->session->set_flashdata('message', [
                'type' => 'success', // or 'success'
                'text' => 'New department is added successfully'
            ]);

            $this->department_model->add_department();
            return redirect('departments/get_departments'); // ✅ IMPORTANT
        }
    }

    public function update_department() {
        if (!$this->session->userdata('logged_in')) {
            redirect('users');
        }
        $this->form_validation->set_rules('department_name', 'Department Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('errors', $this->form_validation->error_array());
            $this->session->set_flashdata('showModal', 'renameDepartmentModal');
            $this->session->set_flashdata('message', [
                'type' => 'danger', // or 'success'
                'text' => 'Department update failed'
            ]);
            return redirect('departments/get_departments'); // ✅ IMPORTANT
        } else {
            $this->session->set_flashdata('message', [
                'type' => 'success', // or 'success'
                'text' => 'The department is updated successfully'
            ]);

            $this->department_model->update_department();
            return redirect('departments/get_departments'); // ✅ IMPORTANT
        }
    }

    public function update_department_status() {
        $status = $this->input->post('department_status');

        $this->department_model->update_department_status($status);

        $this->session->set_flashdata('message', [
            'type' => 'success', // or 'success'
            'text' => 'The department is updated successfully'
        ]);
        return redirect('departments/get_departments'); // ✅ IMPORTANT
    }
}