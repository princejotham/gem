<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Prescription extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('prescription_model');
        $this->load->model('medicine/medicine_model');
        $this->load->model('patient/patient_model');
        $this->load->model('case_manager/case_manager_model');
        if (!$this->ion_auth->in_group(array('admin', 'Pharmacist', 'Case_manager', 'Patient', 'Health_worker'))) {
            redirect('home/permission');
        }
    }

    public function index() {

        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }

        $data['patients'] = $this->patient_model->getPatient();
        $data['case_managers'] = $this->case_manager_model->getCase_manager();
        if ($this->ion_auth->in_group(array('Case_manager'))) {
            $current_user = $this->ion_auth->get_user_id();
            $case_manager_id = $this->db->get_where('case_manager', array('ion_user_id' => $current_user))->row()->id;
        }
        $data['prescriptions'] = $this->prescription_model->getPrescriptionByCase_managerId($case_manager_id);
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('prescription', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function all() {

        if (!$this->ion_auth->in_group(array('admin', 'Case_manager', 'Pharmacist'))) {
            redirect('home/permission');
        }

        $data['medicines'] = $this->medicine_model->getMedicine();
        $data['patients'] = $this->patient_model->getPatient();
        $data['case_managers'] = $this->case_manager_model->getCase_manager();
        $data['prescriptions'] = $this->prescription_model->getPrescription();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('all_prescription', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addPrescriptionView() {

        if (!$this->ion_auth->in_group(array('admin', 'Case_manager'))) {
            redirect('home/permission');
        }

        $data = array();
        $data['medicines'] = $this->medicine_model->getMedicine();
        $data['patients'] = $this->patient_model->getPatient();
        $data['case_managers'] = $this->case_manager_model->getCase_manager();

        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new_prescription_view', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewPrescription() {

        if (!$this->ion_auth->in_group(array('admin', 'Case_manager'))) {
            redirect('home/permission');
        }

        $id = $this->input->post('id');
        $tab = $this->input->post('tab');
        $date = $this->input->post('date');
        if (!empty($date)) {
            $date = strtotime($date);
        }

        $patient = $this->input->post('patient');
        $case_manager = $this->input->post('case_manager');
        $symptom = $this->input->post('symptom');
        $medicine = $this->input->post('medicine');
        $dosage = $this->input->post('dosage');
        $frequency = $this->input->post('frequency');
        $days = $this->input->post('days');
        $instruction = $this->input->post('instruction');
        $note = $this->input->post('note');
        $admin = $this->input->post('admin');

        $report = array();

        if (!empty($medicine)) {
            foreach ($medicine as $key => $value) {
                $report[$value] = array(
                    'dosage' => $dosage[$key],
                    'frequency' => $frequency[$key],
                    'days' => $days[$key],
                    'instruction' => $instruction[$key],
                );

                // }
            }

            foreach ($report as $key1 => $value1) {
                $final[] = $key1 . '***' . implode('***', $value1);
            }

            $final_report = implode('###', $final);
        } else {
            $final_report = '';
        }





        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Date Field
        $this->form_validation->set_rules('date', 'Date', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Patient Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Case_manager Field
        $this->form_validation->set_rules('case_manager', 'Case_manager', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Advice Field
        $this->form_validation->set_rules('symptom', 'History', 'trim|min_length[1]|max_length[1000]|xss_clean');
        // Validating Do And Dont Name Field
        $this->form_validation->set_rules('note', 'Note', 'trim|min_length[1]|max_length[1000]|xss_clean');
        // Validating Validity Field
        $this->form_validation->set_rules('validity', 'Validity', 'trim|min_length[1]|max_length[100]|xss_clean');



        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect('prescription/editPrescription?id=' . $id);
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $data['medicines'] = $this->medicine_model->getMedicine();
                $data['patients'] = $this->patient_model->getPatient();
                $data['case_managers'] = $this->case_manager_model->getCase_manager();
                $data['settings'] = $this->settings_model->getSettings();
                $this->load->view('home/dashboard', $data); // just the header file
                $this->load->view('add_new_prescription_view', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            $data = array();
            $data = array('date' => $date,
                'patient' => $patient,
                'case_manager' => $case_manager,
                'symptom' => $symptom,
                'medicine' => $final_report,
                'note' => $note,
            );
            if (empty($id)) {
                $this->prescription_model->insertPrescription($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->prescription_model->updatePrescription($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }

            if (!empty($admin)) {
                redirect('prescription/all');
            } else {
                redirect('prescription');
            }
        }
    }

    function viewPrescription() {
        $id = $this->input->get('id');
        $data['prescription'] = $this->prescription_model->getPrescriptionById($id);

        if (!empty($data['prescription']->account__id)) {
            if ($data['prescription']->account__id != $this->session->userdata('account__id')) {
                $this->load->view('home/permission');
            } else {
                $data['settings'] = $this->settings_model->getSettings();
                $this->load->view('home/dashboard', $data); // just the header file
                $this->load->view('prescription_view_1', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            $this->load->view('home/permission');
        }
    }

    function editPrescription() {
        $data = array();
        $id = $this->input->get('id');
        $data['patients'] = $this->patient_model->getPatient();
        $data['case_managers'] = $this->case_manager_model->getCase_manager();
        $data['medicines'] = $this->medicine_model->getMedicine();
        $data['prescription'] = $this->prescription_model->getPrescriptionById($id);


        if (!empty($data['prescription']->account__id)) {
            if ($data['prescription']->account__id != $this->session->userdata('account__id')) {
                $this->load->view('home/permission');
            } else {
                $data['settings'] = $this->settings_model->getSettings();
                $this->load->view('home/dashboard', $data); // just the header file
                $this->load->view('add_new_prescription_view', $data);
                $this->load->view('home/footer'); // just the footer file 
            }
        } else {
            $this->load->view('home/permission');
        }
    }

    function editPrescriptionByJason() {
        $id = $this->input->get('id');
        $data['prescription'] = $this->prescription_model->getPrescriptionById($id);
        echo json_encode($data);
    }

    function getPrescriptionByPatientIdByJason() {
        $id = $this->input->get('id');
        $prescriptions = $this->prescription_model->getPrescriptionByPatientId($id);
        foreach ($prescriptions as $prescription) {
            $lists[] = ' <div class="pull-left prescription_box" style = "padding: 10px; background: #fff;"><div class="prescription_box_title">Prescription Date</div> <div>' . date('d-m-Y', $prescription->date) . '</div> <div class="prescription_box_title">Medicine</div> <div>' . $prescription->medicine . '</div> </div> ';
        }
        $data['prescription'] = $lists;
        $lists = NULL;
        echo json_encode($data);
    }

    function delete() {
        $id = $this->input->get('id');
        $admin = $this->input->get('admin');
        $patient = $this->input->get('patient');
        $this->prescription_model->deletePrescription($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        if (!empty($patient)) {
            redirect('patient/caseHistory?patient_id=' . $patient);
        } elseif (!empty($admin)) {
            redirect('prescription/all');
        } else {
            redirect('prescription');
        }
    }

    public function prescriptionCategory() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['categories'] = $this->prescription_model->getPrescriptionCategory();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('prescription_category', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addCategoryView() {
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new_category_view');
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewCategory() {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $description = $this->input->post('description');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Description Field
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $data['settings'] = $this->settings_model->getSettings();
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('add_new_category_view');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array('category' => $category,
                'description' => $description
            );
            if (empty($id)) {
                $this->prescription_model->insertPrescriptionCategory($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->prescription_model->updatePrescriptionCategory($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            redirect('prescription/prescriptionCategory');
        }
    }

    function edit_category() {
        $data = array();
        $id = $this->input->get('id');
        $data['prescription'] = $this->prescription_model->getPrescriptionCategoryById($id);
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new_category_view', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editPrescriptionCategoryByJason() {
        $id = $this->input->get('id');
        $data['prescriptioncategory'] = $this->prescription_model->getPrescriptionCategoryById($id);
        echo json_encode($data);
    }

    function deletePrescriptionCategory() {
        $id = $this->input->get('id');
        $this->prescription_model->deletePrescriptionCategory($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('prescription/prescriptionCategory');
    }

}

/* End of file prescription.php */
/* Location: ./application/modules/prescription/controllers/prescription.php */
