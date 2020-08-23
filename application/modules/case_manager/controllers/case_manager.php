<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Case_manager extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('case_manager_model');
        $this->load->model('department/department_model');
        $this->load->model('patient_care/patient_care_model');
        $this->load->model('patient/patient_model');
        $this->load->model('prescription/prescription_model');
        $this->load->model('schedule/schedule_model');
        $this->load->module('patient');
        if (!$this->ion_auth->in_group(array('admin', 'Finance_', 'Case_manager'))) {
            redirect('home/permission');
        }
    }

    public function index() {

        $data['case_managers'] = $this->case_manager_model->getCase_manager();
        $data['departments'] = $this->department_model->getDepartment();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('case_manager', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView() {
        $data = array();
        $data['departments'] = $this->department_model->getDepartment();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew() {

        $id = $this->input->post('id');

        if (empty($id)) {
            $limit = $this->case_manager_model->getLimit();
            if ($limit <= 0) {
                $this->session->set_flashdata('feedback', lang('case_manager_limit_exceed'));
                redirect('case_manager');
            }
        }

        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $department = $this->input->post('department');
        $profile = $this->input->post('profile');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Password Field
        if (empty($id)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        }
        // Validating Email Field
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[1]|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[1]|max_length[50]|xss_clean');
        // Validating Department Field   
        $this->form_validation->set_rules('department', 'Department', 'trim|min_length[1]|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('profile', 'Profile', 'trim|required|min_length[1]|max_length[50]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $data = array();
                $data['departments'] = $this->department_model->getDepartment();
                $data['case_manager'] = $this->case_manager_model->getCase_managerById($id);
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new', $data);
                $this->load->view('home/footer'); // just the footer file
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $data['departments'] = $this->department_model->getDepartment();
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            $file_name = $_FILES['img_url']['name'];
            $file_name_pieces = explode('_', $file_name);
            $new_file_name = '';
            $count = 1;
            foreach ($file_name_pieces as $piece) {
                if ($count !== 1) {
                    $piece = ucfirst($piece);
                }

                $new_file_name .= $piece;
                $count++;
            }
            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./uploads/",
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'overwrite' => False,
                'max_size' => "20480000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "1768",
                'max_width' => "2024"
            );

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('img_url')) {
                $path = $this->upload->data();
                $img_url = "uploads/" . $path['file_name'];
                $data = array();
                $data = array(
                    'img_url' => $img_url,
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'phone' => $phone,
                    'department' => $department,
                    'profile' => $profile
                );
            } else {
                //$error = array('error' => $this->upload->display_errors());
                $data = array();
                $data = array(
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'phone' => $phone,
                    'department' => $department,
                    'profile' => $profile
                );
            }
            $username = $this->input->post('name');
            if (empty($id)) {     // Adding New Case_manager
                if ($this->ion_auth->email_check($email)) {
                    $this->session->set_flashdata('feedback', lang('this_email_address_is_already_registered'));
                    redirect('case_manager/addNewView');
                } else {
                    $dfg = 4;
                    $this->ion_auth->register($username, $password, $email, $dfg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
                    $this->case_manager_model->insertCase_manager($data);
                    $case_manager_user_id = $this->db->get_where('case_manager', array('email' => $email))->row()->id;
                    $id_info = array('ion_user_id' => $ion_user_id);
                    $this->case_manager_model->updateCase_manager($case_manager_user_id, $id_info);
                    $this->account__model->addAccount_IdToIonUser($ion_user_id, $this->account__id);
                    $this->session->set_flashdata('feedback', lang('added'));
                }
            } else { // Updating Case_manager
                $ion_user_id = $this->db->get_where('case_manager', array('id' => $id))->row()->ion_user_id;
                if (empty($password)) {
                    $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
                } else {
                    $password = $this->ion_auth_model->hash_password($password);
                }
                $this->case_manager_model->updateIonUser($username, $email, $password, $ion_user_id);
                $this->case_manager_model->updateCase_manager($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View
            redirect('case_manager');
        }
    }

    function editCase_manager() {
        $data = array();
        $data['departments'] = $this->department_model->getDepartment();
        $id = $this->input->get('id');
        $data['case_manager'] = $this->case_manager_model->getCase_managerById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function details() {

        $data = array();

        if ($this->ion_auth->in_group(array('Case_manager'))) {
            $case_manager_ion_id = $this->ion_auth->get_user_id();
            $id = $this->case_manager_model->getCase_managerByIonUserId($case_manager_ion_id)->id;
        } else {
            redirect('home');
        }


        $data['case_manager'] = $this->case_manager_model->getCase_managerById($id);
        $data['todays_patient_cares'] = $this->patient_care_model->getPatient_careByCase_managerByToday($id);
        $data['patient_cares'] = $this->patient_care_model->getPatient_careByCase_manager($id);
        $data['patients'] = $this->patient_model->getPatient();
        $data['patient_care_patients'] = $this->patient->getPatientByPatient_careByDctorId($id);
        $data['case_managers'] = $this->case_manager_model->getCase_manager();
        $data['prescriptions'] = $this->prescription_model->getPrescriptionByCase_managerId($id);
        $data['holidays'] = $this->schedule_model->getHolidaysByCase_manager($id);
        $data['schedules'] = $this->schedule_model->getScheduleByCase_manager($id);



        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('details', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editCase_managerByJason() {
        $id = $this->input->get('id');
        $data['case_manager'] = $this->case_manager_model->getCase_managerById($id);
        echo json_encode($data);
    }

    function delete() {
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('case_manager', array('id' => $id))->row();
        $path = $user_data->img_url;

        if (!empty($path)) {
            unlink($path);
        }
        $ion_user_id = $user_data->ion_user_id;
        $this->db->where('id', $ion_user_id);
        $this->db->delete('users');
        $this->case_manager_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('case_manager');
    }

    function getCase_manager() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['case_managers'] = $this->case_manager_model->getCase_managerBysearch($search);
            } else {
                $data['case_managers'] = $this->case_manager_model->getCase_manager();
            }
        } else {
            if (!empty($search)) {
                $data['case_managers'] = $this->case_manager_model->getCase_managerByLimitBySearch($limit, $start, $search);
            } else {
                $data['case_managers'] = $this->case_manager_model->getCase_managerByLimit($limit, $start);
            }
        }
        //  $data['case_managers'] = $this->case_manager_model->getCase_manager();

        foreach ($data['case_managers'] as $case_manager) {
            if ($this->ion_auth->in_group(array('admin', 'Finance_', 'Admin_comm'))) {
                $options1 = '<a type="button" class="btn btn-info btn-xs btn_width editbutton" title="' . lang('edit') . '" data-toggle="modal" data-id="' . $case_manager->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
                //   $options1 = '<a class="btn btn-info btn-xs btn_width" title="' . lang('edit') . '" href="case_manager/editCase_manager?id='.$case_manager->id.'"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
            }
            $options2 = '<a class="btn btn-info btn-xs detailsbutton" title="' . lang('patient_cares') . '"  href="patient_care/getPatient_careByCase_managerId?id=' . $case_manager->id . '"> <i class="fa fa-calendar"> </i> ' . lang('patient_cares') . '</a>';
            if ($this->ion_auth->in_group(array('admin', 'Finance_', 'Admin_comm'))) {
                $options3 = '<a class="btn btn-info btn-xs btn_width delete_button" title="' . lang('delete') . '" href="case_manager/delete?id=' . $case_manager->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash-o"> </i> ' . lang('delete') . '</a>';
            }



            if ($this->ion_auth->in_group(array('admin', 'Finance_', 'Admin_comm'))) {
                $options4 = '<a href="schedule/holidays?case_manager=' . $case_manager->id . '" class="btn btn-info btn-xs btn_width" data-toggle="modal" data-id="' . $case_manager->id . '"><i class="fa fa-book"></i> ' . lang('holiday') . '</a>';
                $options5 = '<a href="schedule/timeSchedule?case_manager=' . $case_manager->id . '" class="btn btn-info btn-xs btn_width" data-toggle="modal" data-id="' . $case_manager->id . '"><i class="fa fa-book"></i> ' . lang('time_schedule') . '</a>';
                $options6 = '<a type="button" class="btn btn-info btn-xs btn_width detailsbutton inffo" title="' . lang('info') . '" data-toggle="modal" data-id="' . $case_manager->id . '"><i class="fa fa-info"> </i> ' . lang('info') . '</a>';
            }

            $info[] = array(
                $case_manager->id,
                $case_manager->name,
                $case_manager->email,
                $case_manager->phone,
                $case_manager->department,
                $case_manager->profile,
                //  $options1 . ' ' . $options2 . ' ' . $options3,
                $options6 . ' ' . $options1 . ' ' . $options2 . ' ' . $options4 . ' ' . $options5 . ' ' . $options3,
                    //  $options2
            );
        }

        if (!empty($data['case_managers'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('case_manager')->num_rows(),
                "recordsFiltered" => $this->db->get('case_manager')->num_rows(),
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

/* End of file case_manager.php */
/* Location: ./application/modules/case_manager/controllers/case_manager.php */