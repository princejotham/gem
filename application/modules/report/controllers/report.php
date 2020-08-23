<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('report_model');
        $this->load->model('case_manager/case_manager_model');
        $this->load->model('patient/patient_model');
        if (!$this->ion_auth->in_group(array('admin', 'Health_worker', 'Case_manager', 'Laboratorist', 'Patient'))) {
            redirect('home/permission');
        }
    }

    public function index() {
        if ($this->ion_auth->in_group('Patient')) {
            redirect('home/permission');
        }
        $data['reports'] = $this->report_model->getReport();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('c19_report', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function birth() {
        if ($this->ion_auth->in_group('Patient')) {
            redirect('home/permission');
        }
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $type = 'birth';
        $data['patients'] = $this->patient_model->getPatient();
        $data['case_managers'] = $this->case_manager_model->getCase_manager();
        $data['reports'] = $this->report_model->getReportByType($type);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('c19_report', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function operation() {
        if ($this->ion_auth->in_group('Patient')) {
            redirect('home/permission');
        }
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $type = 'operation';
        $data['patients'] = $this->patient_model->getPatient();
        $data['case_managers'] = $this->case_manager_model->getCase_manager();
        $data['reports'] = $this->report_model->getReportByType($type);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('request_report', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function expire() {
        if ($this->ion_auth->in_group('Patient')) {
            redirect('home/permission');
        }
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $type = 'expire';
        $data['patients'] = $this->patient_model->getPatient();
        $data['case_managers'] = $this->case_manager_model->getCase_manager();
        $data['reports'] = $this->report_model->getReportByType($type);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('decease_report', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addReportView() {
        if ($this->ion_auth->in_group('Patient')) {
            redirect('home/permission');
        }
        $data = array();
        $data['case_managers'] = $this->case_manager_model->getCase_manager();
        $data['patients'] = $this->patient_model->getPatient();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_report', $data);
        $this->load->view('home/footer'); // just the header file
    }



//this is for birth
    public function addReport1() {
        if ($this->ion_auth->in_group('Patient')) {
            redirect('home/permission');
        }
        $id = $this->input->post('id');
        $select_type = $this->input->post('select_type');
        $type = 'birth';
        $description = $this->input->post('description');
        $patient = $this->input->post('patient');
        $case_manager = $this->input->post('case_manager');
        $date = $this->input->post('date');
        if ((empty($id))) {
            $add_date = date('m/d/y');
        } else {
            $add_date = $this->db->get_where('report', array('id' => $id))->row()->add_date;
        }
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('select_type', 'Select_type', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Category Field
        $this->form_validation->set_rules('description', 'Name of Patient Contact', 'trim|required|min_length[1]|max_length[1000]|xss_clean');
        // Validating Price Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Generic Name Field
        $this->form_validation->set_rules('case_manager', 'Case_manager', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Company Name Field
        $this->form_validation->set_rules('date', 'Date', 'trim|required|min_length[1]|max_length[100]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            if(!empty($id)){
                $this->session->set_flashdata('feedback', lang('validation_error'));
                redirect('report/editReport1?id'.$id);
            }else{
            $data = array();
            $data['setval'] = 'setval';
            $data['case_managers'] = $this->case_manager_model->getCase_manager();
            $data['patients'] = $this->patient_model->getPatient();
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('add_report1', $data);
            $this->load->view('home/footer'); // just the header file
            }
        } else {
            $data = array();
            $data = array('report_type' => $type,
                'types' => $select_type,
                'description' => $description,
                'patient' => $patient,
                'case_manager' => $case_manager,
                'date' => $date,
                'add_date' => $add_date
            );
            if (empty($id)) {
                $this->report_model->insertReport($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->report_model->updateReport($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            if ($type == 'birth') {
                redirect('report/birth');
            } elseif ($type == 'operation') {
                redirect('report/operation');
            } else {
                redirect('report/expire');
            }
        }
    }





    ///This is for Operation

    public function addReport2() {
        if ($this->ion_auth->in_group('Patient')) {
            redirect('home/permission');
        }
        $id = $this->input->post('id');
        $select_type = $this->input->post('select_type');
        $type = 'operation';
        $description = $this->input->post('description');
        $patient = $this->input->post('patient');
        $case_manager = $this->input->post('case_manager');
        $date = $this->input->post('date');
        if ((empty($id))) {
            $add_date = date('m/d/y');
        } else {
            $add_date = $this->db->get_where('report', array('id' => $id))->row()->add_date;
        }
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('select_type', 'Select_type', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Category Field
        $this->form_validation->set_rules('description', 'Name of Patient Contact', 'trim|required|min_length[1]|max_length[1000]|xss_clean');
        // Validating Price Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Generic Name Field
        $this->form_validation->set_rules('case_manager', 'Case_manager', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Company Name Field
        $this->form_validation->set_rules('date', 'Date', 'trim|required|min_length[1]|max_length[100]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            if(!empty($id)){
                $this->session->set_flashdata('feedback', lang('validation_error'));
                redirect('report/editReport2?id'.$id);
            }else{
            $data = array();
            $data['setval'] = 'setval';
            $data['case_managers'] = $this->case_manager_model->getCase_manager();
            $data['patients'] = $this->patient_model->getPatient();
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('add_report2', $data);
            $this->load->view('home/footer'); // just the header file
            }
        } else {
            $data = array();
            $data = array('report_type' => $type,
                'types' => $select_type,
                'description' => $description,
                'patient' => $patient,
                'case_manager' => $case_manager,
                'date' => $date,
                'add_date' => $add_date
            );
            if (empty($id)) {
                $this->report_model->insertReport($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->report_model->updateReport($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            if ($type == 'birth') {
                redirect('report/birth');
            } elseif ($type == 'operation') {
                redirect('report/operation');
            } else {
                redirect('report/expire');
            }
        }
    }





    public function addReport() {
        if ($this->ion_auth->in_group('Patient')) {
            redirect('home/permission');
        }
        $id = $this->input->post('id');
        $type = $this->input->post('type');
        $description = $this->input->post('description');
        $patient = $this->input->post('patient');
        $case_manager = $this->input->post('case_manager');
        $date = $this->input->post('date');
        if ((empty($id))) {
            $add_date = date('m/d/y');
        } else {
            $add_date = $this->db->get_where('report', array('id' => $id))->row()->add_date;
        }
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('type', 'Type', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Category Field
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[1]|max_length[1000]|xss_clean');
        // Validating Price Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Generic Name Field
        $this->form_validation->set_rules('case_manager', 'Case_manager', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Company Name Field
        $this->form_validation->set_rules('date', 'Date', 'trim|required|min_length[1]|max_length[100]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            if(!empty($id)){
                $this->session->set_flashdata('feedback', lang('validation_error'));
                redirect('report/editReport?id'.$id);
            }else{
            $data = array();
            $data['setval'] = 'setval';
            $data['case_managers'] = $this->case_manager_model->getCase_manager();
            $data['patients'] = $this->patient_model->getPatient();
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('add_report', $data);
            $this->load->view('home/footer'); // just the header file
            }
        } else {
            $data = array();
            $data = array('report_type' => $type,
                'description' => $description,
                'patient' => $patient,
                'case_manager' => $case_manager,
                'date' => $date,
                'add_date' => $add_date
            );
            if (empty($id)) {
                $this->report_model->insertReport($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->report_model->updateReport($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            if ($type == 'birth') {
                redirect('report/birth');
            } elseif ($type == 'operation') {
                redirect('report/operation');
            } else {
                redirect('report/expire');
            }
        }
    }











    //////////////////




///This is for birth
      function editReport1() {
        if ($this->ion_auth->in_group('Patient')) {
            redirect('home/permission');
        }
        $data = array();
        $data['case_managers'] = $this->case_manager_model->getCase_manager();
        $data['patients'] = $this->patient_model->getPatient();
        $id = $this->input->get('id');
        $data['report'] = $this->report_model->getReportById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_report1', $data);
        $this->load->view('home/footer'); // just the footer file
    }



    ///This is for operation
      function editReport2() {
        if ($this->ion_auth->in_group('Patient')) {
            redirect('home/permission');
        }
        $data = array();
        $data['case_managers'] = $this->case_manager_model->getCase_manager();
        $data['patients'] = $this->patient_model->getPatient();
        $id = $this->input->get('id');
        $data['report'] = $this->report_model->getReportById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_report2', $data);
        $this->load->view('home/footer'); // just the footer file
    }













    ///////////////////

    function editReport() {
        if ($this->ion_auth->in_group('Patient')) {
            redirect('home/permission');
        }
        $data = array();
        $data['case_managers'] = $this->case_manager_model->getCase_manager();
        $data['patients'] = $this->patient_model->getPatient();
        $id = $this->input->get('id');
        $data['report'] = $this->report_model->getReportById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_report', $data);
        $this->load->view('home/footer'); // just the footer file
    }
    
    function editReportByJason(){
        $id = $this->input->get('id');
        $data['report'] = $this->report_model->getReportById($id);
        echo json_encode($data);
    }

    function myReport() {
        if ($this->ion_auth->in_group('Patient')) {
            $data = array();
            $id = $this->ion_auth->get_user_id();
            $data['report'] = $this->report_model->getReportById($id);
        }
    }

    function myreports() {
        $data['reports'] = $this->report_model->getReport();
        $data['user_id'] = $this->ion_auth->user()->row()->id;
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('myreports', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function delete() {
        if ($this->ion_auth->in_group('Patient')) {
            redirect('home/permission');
        }
        $id = $this->input->get('id');
        $type = $this->report_model->getReportById($id)->report_type;
        $this->report_model->deleteReport($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        if ($type == 'birth') {
            redirect('report/birth');
        } elseif ($type == 'operation') {
            redirect('report/operation');
        } else {
            redirect('report/expire');
        }
    }

}

/* End of file report.php */
/* Location: ./application/modules/report/controllers/re.phportp */
