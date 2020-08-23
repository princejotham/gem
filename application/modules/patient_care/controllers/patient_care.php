<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Patient_care extends MX_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('patient_care_model');
        $this->load->model('case_manager/case_manager_model');
        $this->load->model('patient/patient_model');
        $this->load->model('sms/sms_model');
        $this->load->module('sms');

        if (!$this->ion_auth->in_group(array('admin', 'Health_worker', 'Case_manager', 'Patient', 'Admin_comm'))) {
            redirect('home/permission');
        }
    }

    public function index() {

        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }

        if ($this->ion_auth->in_group(array('Case_manager'))) {
            $case_manager_ion_id = $this->ion_auth->get_user_id();
            $case_manager = $this->db->get_where('case_manager', array('ion_user_id' => $case_manager_ion_id))->row()->id;
            $data['patient_cares'] = $this->patient_care_model->getPatient_careByCase_manager($case_manager);
            $data['patient_care_pendings'] = $this->patient_care_model->getPatient_careByStatusByCase_manager('Pending Confirmation', $case_manager);
            $data['patient_care_confirmeds'] = $this->patient_care_model->getPatient_careByStatusByCase_manager('Confirmed', $case_manager);
            $data['patient_care_treateds'] = $this->patient_care_model->getPatient_careByStatusByCase_manager('Treated', $case_manager);
            $data['patient_care_cancelleds'] = $this->patient_care_model->getPatient_careByStatusByCase_manager('Cancelled', $case_manager);
            $data['patient_care_requesteds'] = $this->patient_care_model->getPatient_careByStatusByCase_manager('Requested', $case_manager);
        } else {
            $data['patient_care_requesteds'] = $this->patient_care_model->getPatient_careByStatus('Requested');
            $data['patient_care_pendings'] = $this->patient_care_model->getPatient_careByStatus('Pending Confirmation');
            $data['patient_care_confirmeds'] = $this->patient_care_model->getPatient_careByStatus('Confirmed');
            $data['patient_care_treateds'] = $this->patient_care_model->getPatient_careByStatus('Treated');
            $data['patient_care_cancelleds'] = $this->patient_care_model->getPatient_careByStatus('Cancelled');
            $data['patient_cares'] = $this->patient_care_model->getPatient_care();
        }

        $data['patients'] = $this->patient_model->getPatient();
        $data['case_managers'] = $this->case_manager_model->getCase_manager();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('patient_care', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function request() {
        if ($this->ion_auth->in_group(array('Case_manager'))) {
            $case_manager_ion_id = $this->ion_auth->get_user_id();
            $case_manager = $this->db->get_where('case_manager', array('ion_user_id' => $case_manager_ion_id))->row()->id;
            $data['patient_cares'] = $this->patient_care_model->getPatient_careRequestByCase_manager($case_manager);
        } else {
            $data['patient_cares'] = $this->patient_care_model->getPatient_careRequest();
        }

        $data['patients'] = $this->patient_model->getPatient();
        $data['case_managers'] = $this->case_manager_model->getCase_manager();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('patient_care_request', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function todays() {
        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }
        if ($this->ion_auth->in_group(array('Case_manager'))) {
            $case_manager_ion_id = $this->ion_auth->get_user_id();
            $case_manager = $this->db->get_where('case_manager', array('ion_user_id' => $case_manager_ion_id))->row()->id;
            $data['patient_cares'] = $this->patient_care_model->getPatient_careByCase_manager($case_manager);
        } else {
            $data['patient_cares'] = $this->patient_care_model->getPatient_care();
        }

        $data['patients'] = $this->patient_model->getPatient();
        $data['case_managers'] = $this->case_manager_model->getCase_manager();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('todays', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function upcoming() {

        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }

        if ($this->ion_auth->in_group(array('Case_manager'))) {
            $case_manager_ion_id = $this->ion_auth->get_user_id();
            $case_manager = $this->db->get_where('case_manager', array('ion_user_id' => $case_manager_ion_id))->row()->id;
            $data['patient_cares'] = $this->patient_care_model->getPatient_careByCase_manager($case_manager);
        } else {
            $data['patient_cares'] = $this->patient_care_model->getPatient_care();
        }

        $data['patients'] = $this->patient_model->getPatient();
        $data['case_managers'] = $this->case_manager_model->getCase_manager();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('upcoming', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function calendar() {

        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }

        if ($this->ion_auth->in_group(array('Case_manager'))) {
            $case_manager_ion_id = $this->ion_auth->get_user_id();
            $case_manager = $this->db->get_where('case_manager', array('ion_user_id' => $case_manager_ion_id))->row()->id;
            $data['patient_cares'] = $this->patient_care_model->getPatient_careByCase_manager($case_manager);
        } else {
            $data['patient_cares'] = $this->patient_care_model->getPatient_care();
        }

        $data['patients'] = $this->patient_model->getPatient();
        $data['case_managers'] = $this->case_manager_model->getCase_manager();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('calendar', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView() {

        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }

        $data['patients'] = $this->patient_model->getPatient();
        $data['case_managers'] = $this->case_manager_model->getCase_manager();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew() {
        $id = $this->input->post('id');
        $patient = $this->input->post('patient');
        $case_manager = $this->input->post('case_manager');
        $date = $this->input->post('date');
        if (!empty($date)) {
            $date = strtotime($date);
        }


        $time_slot = $this->input->post('time_slot');

        $time_slot_explode = explode('To', $time_slot);

        $s_time = trim($time_slot_explode[0]);
        $e_time = trim($time_slot_explode[1]);


        $remarks = $this->input->post('remarks');

        $sms = $this->input->post('sms');

        $status = $this->input->post('status');

        $redirect = $this->input->post('redirect');

        $request = $this->input->post('request');

        if (empty($request)) {
            $request = '';
        }


        $user = $this->ion_auth->get_user_id();

        if ($this->ion_auth->in_group(array('Patient'))) {
            $user = '';
        }



        if ((empty($id))) {
            $add_date = date('m/d/y');
            $registration_time = time();
            $patient_add_date = $add_date;
            $patient_registration_time = $registration_time;
        } else {
            $add_date = $this->patient_care_model->getPatient_careById($id)->add_date;
            $registration_time = $this->patient_care_model->getPatient_careById($id)->registration_time;
        }

        $s_time_key = $this->getArrayKey($s_time);


        $p_name = $this->input->post('p_name');
        $p_email = $this->input->post('p_email');
        if (empty($p_email)) {
            $p_email = $p_name . '-' . rand(1, 1000) . '-' . $p_name . '-' . rand(1, 1000) . '@example.com';
        }
        if (!empty($p_name)) {
            $password = $p_name . '-' . rand(1, 100000000);
        }
        $p_phone = $this->input->post('p_phone');
        $p_age = $this->input->post('p_age');
        $p_gender = $this->input->post('p_gender');
        $patient_id = rand(10000, 1000000);

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        if ($patient == 'add_new') {
            $this->form_validation->set_rules('p_name', 'Patient Name', 'trim|required|min_length[1]|max_length[100]|xss_clean');
            $this->form_validation->set_rules('p_phone', 'Patient Phone', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        }

        // Validating Name Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Password Field
        $this->form_validation->set_rules('case_manager', 'Case_manager', 'trim|required|min_length[1]|max_length[100]|xss_clean');

        // Validating Email Field
        $this->form_validation->set_rules('date', 'Date', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Email Field
        $this->form_validation->set_rules('s_time', 'Start Time', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Email Field
        $this->form_validation->set_rules('e_time', 'End Time', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|min_length[1]|max_length[1000]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("patient_care/editPatient_care?id=$id");
            } else {
                $data['patients'] = $this->patient_model->getPatient();
                $data['case_managers'] = $this->case_manager_model->getCase_manager();
                $data['settings'] = $this->settings_model->getSettings();
                $this->load->view('home/dashboard', $data); // just the header file
                $this->load->view('add_new', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {

            if ($patient == 'add_new') {


                $limit = $this->patient_model->getLimit();
                if ($limit <= 0) {
                    $this->session->set_flashdata('feedback', lang('patient_limit_exceed'));
                    redirect('patient_care');
                }

                $data_p = array(
                    'patient_id' => $patient_id,
                    'name' => $p_name,
                    'email' => $p_email,
                    'phone' => $p_phone,
                    'sex' => $p_gender,
                    'age' => $p_age,
                    'add_date' => $patient_add_date,
                    'registration_time' => $patient_registration_time,
                    'how_added' => 'from_patient_care'
                );
                $username = $this->input->post('p_name');
                // Adding New Patient
                if ($this->ion_auth->email_check($p_email)) {
                    $this->session->set_flashdata('feedback', lang('this_email_address_is_already_registered'));
                } else {
                    $dfg = 5;
                    $this->ion_auth->register($username, $password, $p_email, $dfg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $p_email))->row()->id;
                    $this->patient_model->insertPatient($data_p);
                    $patient_user_id = $this->db->get_where('patient', array('email' => $p_email))->row()->id;
                    $id_info = array('ion_user_id' => $ion_user_id);
                    $this->patient_model->updatePatient($patient_user_id, $id_info);
                    $this->account__model->addAccount_IdToIonUser($ion_user_id, $this->account__id);
                }

                $patient = $patient_user_id;
                //    }
            }
            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'patient' => $patient,
                'case_manager' => $case_manager,
                'date' => $date,
                's_time' => $s_time,
                'e_time' => $e_time,
                'time_slot' => $time_slot,
                'remarks' => $remarks,
                'add_date' => $add_date,
                'registration_time' => $registration_time,
                'status' => $status,
                's_time_key' => $s_time_key,
                'user' => $user,
                'request' => $request
            );
            $username = $this->input->post('name');
            if (empty($id)) {     // Adding New department
                $this->patient_care_model->insertPatient_care($data);

                if (!empty($sms)) {
                    $this->sms->sendSmsDuringPatient_care($patient, $case_manager, $date, $s_time, $e_time);
                }

                $patient_case_manager = $this->patient_model->getPatientById($patient)->case_manager;

                $patient_case_managers = explode(',', $patient_case_manager);



                if (!in_array($case_manager, $patient_case_managers)) {
                    $patient_case_managers[] = $case_manager;
                    $case_managerss = implode(',', $patient_case_managers);
                    $data_d = array();
                    $data_d = array('case_manager' => $case_managerss);
                    $this->patient_model->updatePatient($patient, $data_d);
                }
                $this->session->set_flashdata('feedback', lang('added'));
            } else { // Updating department
                $previous_status = $this->patient_care_model->getPatient_careById($id)->status;
                if ($previous_status != "Approved") {
                    if ($status == "Approved") {
                        $this->sms->patient_careApproved($id);
                    }
                }
                $this->patient_care_model->updatePatient_care($id, $data);

                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View

            if (!empty($redirect)) {
                redirect($redirect);
            } else {
                redirect('patient_care');
            }
        }
    }

    function getArrayKey($s_time) {
        $all_slot = array(
            0 => '12:00 AM',
            1 => '12:05 AM',
            2 => '12:10 AM',
            3 => '12:15 AM',
            4 => '12:20 AM',
            5 => '12:25 AM',
            6 => '12:30 AM',
            7 => '12:35 AM',
            8 => '12:40 PM',
            9 => '12:45 AM',
            10 => '12:50 AM',
            11 => '12:55 AM',
            12 => '01:00 AM',
            13 => '01:05 AM',
            14 => '01:10 AM',
            15 => '01:15 AM',
            16 => '01:20 AM',
            17 => '01:25 AM',
            18 => '01:30 AM',
            19 => '01:35 AM',
            20 => '01:40 AM',
            21 => '01:45 AM',
            22 => '01:50 AM',
            23 => '01:55 AM',
            24 => '02:00 AM',
            25 => '02:05 AM',
            26 => '02:10 AM',
            27 => '02:15 AM',
            28 => '02:20 AM',
            29 => '02:25 AM',
            30 => '02:30 AM',
            31 => '02:35 AM',
            32 => '02:40 AM',
            33 => '02:45 AM',
            34 => '02:50 AM',
            35 => '02:55 AM',
            36 => '03:00 AM',
            37 => '03:05 AM',
            38 => '03:10 AM',
            39 => '03:15 AM',
            40 => '03:20 AM',
            41 => '03:25 AM',
            42 => '03:30 AM',
            43 => '03:35 AM',
            44 => '03:40 AM',
            45 => '03:45 AM',
            46 => '03:50 AM',
            47 => '03:55 AM',
            48 => '04:00 AM',
            49 => '04:05 AM',
            50 => '04:10 AM',
            51 => '04:15 AM',
            52 => '04:20 AM',
            53 => '04:25 AM',
            54 => '04:30 AM',
            55 => '04:35 AM',
            56 => '04:40 AM',
            57 => '04:45 AM',
            58 => '04:50 AM',
            59 => '04:55 AM',
            60 => '05:00 AM',
            61 => '05:05 AM',
            62 => '05:10 AM',
            63 => '05:15 AM',
            64 => '05:20 AM',
            65 => '05:25 AM',
            66 => '05:30 AM',
            67 => '05:35 AM',
            68 => '05:40 AM',
            69 => '05:45 AM',
            70 => '05:50 AM',
            71 => '05:55 AM',
            72 => '06:00 AM',
            73 => '06:05 AM',
            74 => '06:10 AM',
            75 => '06:15 AM',
            76 => '06:20 AM',
            77 => '06:25 AM',
            78 => '06:30 AM',
            79 => '06:35 AM',
            80 => '06:40 AM',
            81 => '06:45 AM',
            82 => '06:50 AM',
            83 => '06:55 AM',
            84 => '07:00 AM',
            85 => '07:05 AM',
            86 => '07:10 AM',
            87 => '07:15 AM',
            88 => '07:20 AM',
            89 => '07:25 AM',
            90 => '07:30 AM',
            91 => '07:35 AM',
            92 => '07:40 AM',
            93 => '07:45 AM',
            94 => '07:50 AM',
            95 => '07:55 AM',
            96 => '08:00 AM',
            97 => '08:05 AM',
            98 => '08:10 AM',
            99 => '08:15 AM',
            100 => '08:20 AM',
            101 => '08:25 AM',
            102 => '08:30 AM',
            103 => '08:35 AM',
            104 => '08:40 AM',
            105 => '08:45 AM',
            106 => '08:50 AM',
            107 => '08:55 AM',
            108 => '09:00 AM',
            109 => '09:05 AM',
            110 => '09:10 AM',
            111 => '09:15 AM',
            112 => '09:20 AM',
            113 => '09:25 AM',
            114 => '09:30 AM',
            115 => '09:35 AM',
            116 => '09:40 AM',
            117 => '09:45 AM',
            118 => '09:50 AM',
            119 => '09:55 AM',
            120 => '10:00 AM',
            121 => '10:05 AM',
            122 => '10:10 AM',
            123 => '10:15 AM',
            124 => '10:20 AM',
            125 => '10:25 AM',
            126 => '10:30 AM',
            127 => '10:35 AM',
            128 => '10:40 AM',
            129 => '10:45 AM',
            130 => '10:50 AM',
            131 => '10:55 AM',
            132 => '11:00 AM',
            133 => '11:05 AM',
            134 => '11:10 AM',
            135 => '11:15 AM',
            136 => '11:20 AM',
            137 => '11:25 AM',
            138 => '11:30 AM',
            139 => '11:35 AM',
            140 => '11:40 AM',
            141 => '11:45 AM',
            142 => '11:50 AM',
            143 => '11:55 AM',
            144 => '12:00 PM',
            145 => '12:05 PM',
            146 => '12:10 PM',
            147 => '12:15 PM',
            148 => '12:20 PM',
            149 => '12:25 PM',
            150 => '12:30 PM',
            151 => '12:35 PM',
            152 => '12:40 PM',
            153 => '12:45 PM',
            154 => '12:50 PM',
            155 => '12:55 PM',
            156 => '01:00 PM',
            157 => '01:05 PM',
            158 => '01:10 PM',
            159 => '01:15 PM',
            160 => '01:20 PM',
            161 => '01:25 PM',
            162 => '01:30 PM',
            163 => '01:35 PM',
            164 => '01:40 PM',
            165 => '01:45 PM',
            166 => '01:50 PM',
            167 => '01:55 PM',
            168 => '02:00 PM',
            169 => '02:05 PM',
            170 => '02:10 PM',
            171 => '02:15 PM',
            172 => '02:20 PM',
            173 => '02:25 PM',
            174 => '02:30 PM',
            175 => '02:35 PM',
            176 => '02:40 PM',
            177 => '02:45 PM',
            178 => '02:50 PM',
            179 => '02:55 PM',
            180 => '03:00 PM',
            181 => '03:05 PM',
            182 => '03:10 PM',
            183 => '03:15 PM',
            184 => '03:20 PM',
            185 => '03:25 PM',
            186 => '03:30 PM',
            187 => '03:35 PM',
            188 => '03:40 PM',
            189 => '03:45 PM',
            190 => '03:50 PM',
            191 => '03:55 PM',
            192 => '04:00 PM',
            193 => '04:05 PM',
            194 => '04:10 PM',
            195 => '04:15 PM',
            196 => '04:20 PM',
            197 => '04:25 PM',
            198 => '04:30 PM',
            199 => '04:35 PM',
            200 => '04:40 PM',
            201 => '04:45 PM',
            202 => '04:50 PM',
            203 => '04:55 PM',
            204 => '05:00 PM',
            205 => '05:05 PM',
            206 => '05:10 PM',
            207 => '05:15 PM',
            208 => '05:20 PM',
            209 => '05:25 PM',
            210 => '05:30 PM',
            211 => '05:35 PM',
            212 => '05:40 PM',
            213 => '05:45 PM',
            214 => '05:50 PM',
            215 => '05:55 PM',
            216 => '06:00 PM',
            217 => '06:05 PM',
            218 => '06:10 PM',
            219 => '06:15 PM',
            220 => '06:20 PM',
            221 => '06:25 PM',
            222 => '06:30 PM',
            223 => '06:35 PM',
            224 => '06:40 PM',
            225 => '06:45 PM',
            226 => '06:50 PM',
            227 => '06:55 PM',
            228 => '07:00 PM',
            229 => '07:05 PM',
            230 => '07:10 PM',
            231 => '07:15 PM',
            232 => '07:20 PM',
            233 => '07:25 PM',
            234 => '07:30 PM',
            235 => '07:35 PM',
            236 => '07:40 PM',
            237 => '07:45 PM',
            238 => '07:50 PM',
            239 => '07:55 PM',
            240 => '08:00 PM',
            241 => '08:05 PM',
            242 => '08:10 PM',
            243 => '08:15 PM',
            244 => '08:20 PM',
            245 => '08:25 PM',
            246 => '08:30 PM',
            247 => '08:35 PM',
            248 => '08:40 PM',
            249 => '08:45 PM',
            250 => '08:50 PM',
            251 => '08:55 PM',
            252 => '09:00 PM',
            253 => '09:05 PM',
            254 => '09:10 PM',
            255 => '09:15 PM',
            256 => '09:20 PM',
            257 => '09:25 PM',
            258 => '09:30 PM',
            259 => '09:35 PM',
            260 => '09:40 PM',
            261 => '09:45 PM',
            262 => '09:50 PM',
            263 => '09:55 PM',
            264 => '10:00 PM',
            265 => '10:05 PM',
            266 => '10:10 PM',
            267 => '10:15 PM',
            268 => '10:20 PM',
            269 => '10:25 PM',
            270 => '10:30 PM',
            271 => '10:35 PM',
            272 => '10:40 PM',
            273 => '10:45 PM',
            274 => '10:50 PM',
            275 => '10:55 PM',
            276 => '11:00 PM',
            277 => '11:05 PM',
            278 => '11:10 PM',
            279 => '11:15 PM',
            280 => '11:20 PM',
            281 => '11:25 PM',
            282 => '11:30 PM',
            283 => '11:35 PM',
            284 => '11:40 PM',
            285 => '11:45 PM',
            286 => '11:50 PM',
            287 => '11:55 PM',
        );

        $key = array_search($s_time, $all_slot);
        return $key;
    }

    function getPatient_careByJason() {



        if ($this->ion_auth->in_group(array('Case_manager'))) {
            $case_manager_ion_id = $this->ion_auth->get_user_id();
            $case_manager = $this->db->get_where('case_manager', array('ion_user_id' => $case_manager_ion_id))->row()->id;
            $query = $this->patient_care_model->getPatient_careByCase_manager($case_manager);
        } elseif ($this->ion_auth->in_group(array('Patient'))) {
            $patient_ion_id = $this->ion_auth->get_user_id();
            $patient = $this->db->get_where('patient', array('ion_user_id' => $patient_ion_id))->row()->id;
            $query = $this->patient_care_model->getPatient_careByPatient($patient);
        } else {
            $query = $this->patient_care_model->getPatient_careForCalendar();
        }
        $jsonevents = array();

        foreach ($query as $entry) {

            $case_manager = $this->case_manager_model->getCase_managerById($entry->case_manager);
            if (!empty($case_manager)) {
                $case_manager = $case_manager->name;
            } else {
                $case_manager = '';
            }
            $time_slot = $entry->time_slot;
            $time_slot_new = explode(' To ', $time_slot);
            $start_time = explode(' ', $time_slot_new[0]);
            $end_time = explode(' ', $time_slot_new[1]);

            if ($start_time[1] == 'AM') {
                $start_time_second = explode(':', $start_time[0]);
                $day_start_time_second = $start_time_second[0] * 60 * 60 + $start_time_second[1] * 60;
            } else {
                $start_time_second = explode(':', $start_time[0]);
                $day_start_time_second = 12 * 60 * 60 + $start_time_second[0] * 60 * 60 + $start_time_second[1] * 60;
            }

            if ($end_time[1] == 'AM') {
                $end_time_second = explode(':', $end_time[0]);
                $day_end_time_second = $end_time_second[0] * 60 * 60 + $end_time_second[1] * 60;
            } else {
                $end_time_second = explode(':', $end_time[0]);
                $day_end_time_second = 12 * 60 * 60 + $end_time_second[0] * 60 * 60 + $end_time_second[1] * 60;
            }

            $patient_details = $this->patient_model->getPatientById($entry->patient);

            if (!empty($patient_details)) {
                $patient_mobile = $patient_details->phone;
                $patient_name = $patient_details->name;
            } else {
                $patient_mobile = '';
                $patient_name = '';
            }

            $info = '<br/>' . lang('status') . ': ' . $entry->status . '<br>' . lang('patient') . ': ' . $patient_name . '<br/>' . lang('phone') . ': ' . $patient_mobile . '<br/> Case_manager: ' . $case_manager . '<br/>' . lang('remarks') . ': ' . $entry->remarks;
            if ($entry->status == 'Pending Confirmation') {
                //  $color = '#098098';
                $color = 'yellowgreen';
            }
            if ($entry->status == 'Confirmed') {
                $color = '#009988';
            }
            if ($entry->status == 'Treated') {
                $color = '#112233';
            }
            if ($entry->status == 'Cancelled') {
                $color = 'red';
            }

            $jsonevents[] = array(
                'id' => $entry->id,
                'title' => $info,
                'start' => date('Y-m-d H:i:s', $entry->date + $day_start_time_second),
                'end' => date('Y-m-d H:i:s', $entry->date + $day_end_time_second),
                'color' => $color,
            );
        }

        echo json_encode($jsonevents);

        //  echo json_encode($data);
    }

    function getPatient_careByCase_managerId() {
        $id = $this->input->get('id');
        
        $case_manager_details = $this->case_manager_model->getCase_managerById($id);
        if($case_manager_details->account__id != $this->session->userdata('account__id')){
            redirect('home/permission');
        }
        
        $data['case_manager_id'] = $id;
        $data['patient_cares'] = $this->patient_care_model->getPatient_care();
        $data['patients'] = $this->patient_model->getPatient();
        $data['mmrcase_manager'] = $this->case_manager_model->getCase_managerById($id);
        $data['case_managers'] = $this->case_manager_model->getCase_manager();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('patient_care_by_case_manager', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function editPatient_care() {
        $data = array();
        $id = $this->input->get('id');
        $data['patients'] = $this->patient_model->getPatient();
        $data['case_managers'] = $this->case_manager_model->getCase_manager();
        $data['settings'] = $this->settings_model->getSettings();
        $data['patient_care'] = $this->patient_care_model->getPatient_careById($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file 
    }

    function editPatient_careByJason() {
        $id = $this->input->get('id');
        $data['patient_care'] = $this->patient_care_model->getPatient_careById($id);
        echo json_encode($data);
    }

    function treatmentReport() {
        $data['settings'] = $this->settings_model->getSettings();
        $data['case_managers'] = $this->case_manager_model->getCase_manager();

        $date_from = strtotime($this->input->post('date_from'));
        $date_to = strtotime($this->input->post('date_to'));
        if (!empty($date_to)) {
            $date_to = $date_to + 24 * 60 * 60;
        }

        if (empty($date_from) || empty($date_to)) {
            $data['patient_cares'] = $this->patient_care_model->getPatient_care();
        } else {
            $data['patient_cares'] = $this->patient_care_model->getPatient_careByDate($date_from, $date_to);
            $data['from'] = $this->input->post('date_from');
            $data['to'] = $this->input->post('date_to');
        }

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('treatment_history', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function myPatient_cares() {
        $data['patient_cares'] = $this->patient_care_model->getPatient_care();
        $data['settings'] = $this->settings_model->getSettings();
        $user_id = $this->ion_auth->user()->row()->id;
        $data['user_id'] = $this->db->get_where('patient', array('ion_user_id' => $user_id))->row()->id;
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('mypatient_cares', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function delete() {
        $data = array();
        $id = $this->input->get('id');
        $case_manager_id = $this->input->get('case_manager_id');
        $this->patient_care_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        if (!empty($case_manager_id)) {
            redirect('patient_care/getPatient_careByCase_managerId?id=' . $case_manager_id);
        } else {
            redirect('patient_care');
        }
    }

    function getPatient_care() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['patient_cares'] = $this->patient_care_model->getPatient_careBysearch($search);
            } else {
                $data['patient_cares'] = $this->patient_care_model->getPatient_care();
            }
        } else {
            if (!empty($search)) {
                $data['patient_cares'] = $this->patient_care_model->getPatient_careByLimitBySearch($limit, $start, $search);
            } else {
                $data['patient_cares'] = $this->patient_care_model->getPatient_careByLimit($limit, $start);
            }
        }
        //  $data['patient_cares'] = $this->patient_care_model->getPatient_care();

        foreach ($data['patient_cares'] as $patient_care) {

            if ($this->ion_auth->in_group(array('admin', 'Finance_', 'Admin_comm'))) {
                //   $options1 = '<a type="button" class="btn editbutton" title="Edit" data-toggle="modal" data-id="463"><i class="fa fa-edit"> </i> Edit</a>';
                $options1 = ' <a type="button" class="btn editbutton" title="' . lang('edit') . '" data-toggle = "modal" data-id="' . $patient_care->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
            }

            $options2 = '<a class="btn detailsbutton" title="' . lang('info') . '" style="color: #fff;" href="patient_care/patient_careDetails?id=' . $patient_care->id . '"><i class="fa fa-info"></i> ' . lang('info') . '</a>';

            $options3 = '<a class="btn green" title="' . lang('history') . '" style="color: #fff;" href="patient_care/medicalHistory?id=' . $patient_care->id . '"><i class="fa fa-stethoscope"></i> ' . lang('history') . '</a>';

            $options4 = '<a class="btn invoicebutton" title="' . lang('payment') . '" style="color: #fff;" href="finance/patient_carePaymentHistory?patient_care=' . $patient_care->id . '"><i class="fa fa-money"></i> ' . lang('payment') . '</a>';

            if ($this->ion_auth->in_group(array('admin', 'Finance_', 'Admin_comm'))) {
                $options5 = '<a class="btn delete_button" title="' . lang('delete') . '" href="patient_care/delete?id=' . $patient_care->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash-o"></i> ' . lang('delete') . '</a>';
            }

            $info[] = array(
                $patient_care->id,
                $patient_care->name,
                $patient_care->phone,
                $this->settings_model->getSettings()->currency . $this->patient_care_model->getDueBalanceByPatient_careId($patient_care->id),
                $options1 . ' ' . $options2 . ' ' . $options3 . ' ' . $options4 . ' ' . $options5,
                    //  $options2
            );
        }

        if (!empty($data['patient_cares'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('patient_care')->num_rows(),
                "recordsFiltered" => $this->db->get('patient_care')->num_rows(),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }

        echo json_encode($output);
    }

}

/* End of file patient_care.php */
    /* Location: ./application/modules/patient_care/controllers/patient_care.php */
    