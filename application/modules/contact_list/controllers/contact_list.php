<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact_list extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('contact_list_model');
        if (!$this->ion_auth->in_group(array('admin', 'Health_worker', 'Laboratorist', 'Case_manager', 'Patient'))) {
            redirect('home/permission');
        }
    }

    public function index() {
        $data['contact_lists'] = $this->contact_list_model->getContact_list();
        $data['groups'] = $this->contact_list_model->getBloodBank();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('contact_list', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addContact_listView() {
        if ($this->ion_auth->in_group('Patient')) {
            redirect('home/permission');
        }
        $data = array();
        $data['groups'] = $this->contact_list_model->getBloodBank();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_contact_list', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addContact_list() {
        if ($this->ion_auth->in_group('Patient')) {
            redirect('home/permission');
        }
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $group = $this->input->post('group');
        $age = $this->input->post('age');
        $sex = $this->input->post('sex');
        $ldd = $this->input->post('ldd');
        $phone = $this->input->post('phone');
        $email = $this->input->post('email');
        if ((empty($id))) {
            $add_date = date('m/d/y');
        } else {
            $add_date = $this->db->get_where('contact_list', array('id' => $id))->row()->add_date;
        }

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Name Field
        $this->form_validation->set_rules('group', 'group', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Name Field
        $this->form_validation->set_rules('age', 'age', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Name Field
        $this->form_validation->set_rules('sex', 'sex', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Name Field
        $this->form_validation->set_rules('ldd', 'Updated on', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Name Field
        $this->form_validation->set_rules('phone', 'phone', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Name Field
        $this->form_validation->set_rules('email', 'email', 'trim|required|min_length[2]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $data = array();
                $data['groups'] = $this->contact_list_model->getBloodBank();
                $data['contact_list'] = $this->contact_list_model->getContact_listById($id);
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_contact_list', $data);
                $this->load->view('home/footer'); // just the footer file
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $data['groups'] = $this->contact_list_model->getBloodBank();
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_contact_list', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            $data = array();
            $data = array('name' => $name,
                'group' => $group,
                'age' => $age,
                'sex' => $sex,
                'ldd' => $ldd,
                'phone' => $phone,
                'email' => $email,
                'add_date' => $add_date
            );
            if (empty($id)) {
                $this->contact_list_model->insertContact_list($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->contact_list_model->updateContact_list($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            redirect('contact_list');
        }
    }

    function editContact_list() {
        $data = array();
        $data['groups'] = $this->contact_list_model->getBloodBank();
        $id = $this->input->get('id');
        $data['contact_list'] = $this->contact_list_model->getContact_listById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_contact_list', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editContact_listByJason() {
        $id = $this->input->get('id');
        $data['contact_list'] = $this->contact_list_model->getContact_listById($id);
        echo json_encode($data);
    }

    function delete() {
        $id = $this->input->get('id');
        $this->contact_list_model->deleteContact_list($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('contact_list');
    }

    public function contactSummary() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['groups'] = $this->contact_list_model->getBloodBank();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('contact_summary', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function updateView() {
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('update_contact_summary');
        $this->load->view('home/footer'); // just the header file
    }

    public function updateBloodBank() {
        $id = $this->input->post('id');
        $group = $this->input->post('group');
        $status = $this->input->post('status');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Description Field
        $this->form_validation->set_rules('status', 'Status', 'required|min_length[5]|max_length[100]');
        if ($this->form_validation->run() == FALSE) {
             $this->session->set_flashdata('feedback', 'Validation Error !');
            redirect('contact_list/contactSummary');
        } else {
            $data = array();
            $data = array(
                'status' => $status
            );

            $this->contact_list_model->updateBloodBank($id, $data);
            $this->session->set_flashdata('feedback', lang('updated'));
            redirect('contact_list/contactSummary');
        }
    }

    function updateBloodBankByJason() {
        $id = $this->input->get('id');
        $data['contactsummary'] = $this->contact_list_model->getBloodBankById($id);
        echo json_encode($data);
    }

    function editBloodBank() {
        $data = array();
        $id = $this->input->get('id');
        $data['contact_list'] = $this->contact_list_model->getBloodBankById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('update_contact_summary', $data);
        $this->load->view('home/footer'); // just the footer file
    }

}

/* End of file finance_.php */
/* Location: ./application/modules/finance_/controllers/finance_.php */
