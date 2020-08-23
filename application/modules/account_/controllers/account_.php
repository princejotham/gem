<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Account_ extends MX_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('account__model');
        $this->load->model('account_/package_model');
        $this->load->model('contact_list/contact_list_model');
        $this->load->model('pgateway/pgateway_model');
        $this->load->model('sms/sms_model');
        $this->load->model('email/email_model');
        if (!$this->ion_auth->in_group('superadmin')) {
            redirect('home/permission');
        }
    }

    public function index() {
        $data['account_s'] = $this->account__model->getAccount_();
        $data['packages'] = $this->package_model->getPackage();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('account_', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView() {
        $data['packages'] = $this->package_model->getPackage();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $package = $this->input->post('package');
        $language = $this->input->post('language');


        if (!empty($package)) {
            $module = $this->package_model->getPackageById($package)->module;
            $p_limit = $this->package_model->getPackageById($package)->p_limit;
            $d_limit = $this->package_model->getPackageById($package)->d_limit;
        } else {
            $p_limit = $this->input->post('p_limit');
            $d_limit = $this->input->post('d_limit');
            $module = $this->input->post('module');
            if (!empty($module)) {
                $module = implode(',', $module);
            }
        }




        $language_array = array('english', 'arabic', 'spanish', 'french', 'italian', 'portuguese');

        if (!in_array($language, $language_array)) {
            $language = 'english';
        }

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Password Field
        if (empty($id)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        }
        // Validating Email Field
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[5]|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[5]|max_length[50]|xss_clean');

        // Validating Phone Field           
        $this->form_validation->set_rules('p_limit', 'Patient Limit', 'trim|required|min_length[1]|max_length[100]|xss_clean');

        // Validating Phone Field           
        $this->form_validation->set_rules('language', 'Language', 'trim|required|min_length[1]|max_length[50]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("account_/editAccount_?id=$id");
            } else {
                $data['packages'] = $this->package_model->getPackage();
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'name' => $name,
                'email' => $email,
                'address' => $address,
                'phone' => $phone,
                'package' => $package,
                'p_limit' => $p_limit,
                'd_limit' => $d_limit,
                'module' => $module
            );

            $username = $this->input->post('name');

            if (empty($id)) {     // Adding New Account_
                if ($this->ion_auth->email_check($email)) {
                    $this->session->set_flashdata('feedback', lang('payment_failed_no_gateway_selected'));
                    redirect('account_/addNewView');
                } else {
                    $dfg = 11;
                    $this->ion_auth->register($username, $password, $email, $dfg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
                    $this->account__model->insertAccount_($data);
                    $account__user_id = $this->db->get_where('account_', array('email' => $email))->row()->id;
                    $id_info = array('ion_user_id' => $ion_user_id);
                    $this->account__model->updateAccount_($account__user_id, $id_info);
                    $account__settings_data = array();
                    $account__settings_data = array('account__id' => $account__user_id,
                        'title' => $name,
                        'email' => $email,
                        'address' => $address,
                        'phone' => $phone,
                        'language' => $language,
                        'system_vendor' => 'Beyond Unicorn | Hospital management System',
                        'discount' => 'flat',
                        'currency' => '₱'
                    );
                    $this->settings_model->insertSettings($account__settings_data);
                    $account__contact_summary = array();
                    $account__contact_summary = array('Confirmed' => '0 Cases', 'Probable-PUM' => '0 Cases', 'Deceased' => '0 Cases', 'Probable-PUI' => '0 Cases', 'Recovered' => '0 Cases');
                    foreach ($account__contact_summary as $key => $value) {
                        $data_bb = array('group' => $key, 'status' => $value, 'account__id' => $account__user_id);
                        $this->contact_list_model->insertBloodBank($data_bb);
                        $data_bb = NULL;
                    }

                    $data_sms_clickatell = array();
                    $data_sms_clickatell = array(
                        'name' => 'Clickatell',
                        'username' => 'Your ClickAtell Username',
                        'password' => 'Your ClickAtell Password',
                        'api_id' => 'Your ClickAtell Api Id',
                        'user' => $this->ion_auth->get_user_id(),
                        'account__id' => $account__user_id
                    );

                    $this->sms_model->addSmsSettings($data_sms_clickatell);

                    $data_sms_msg91 = array(
                        'name' => 'MSG91',
                        'username' => 'Your MSG91 Username',
                        'api_id' => 'Your MSG91 API ID',
                        'authkey' => 'Your MSG91 Auth Key',
                        'user' => $this->ion_auth->get_user_id(),
                        'account__id' => $account__user_id
                    );

                    $this->sms_model->addSmsSettings($data_sms_msg91);



                    $data_pgateway_paypal = array(
                        'name' => 'PayPal', // Sandbox / testing mode option.
                        'APIUsername' => 'PayPal API Username', // PayPal API username of the API caller
                        'APIPassword' => 'PayPal API Password', // PayPal API password of the API caller
                        'APISignature' => 'PayPal API Signature', // PayPal API signature of the API caller
                        'status' => 'test',
                        'account__id' => $account__user_id
                    );

                    $this->pgateway_model->addPaymentGatewaySettings($data_pgateway_paypal);

                    $data_pgateway_payumoney = array(
                        'name' => 'Pay U Money', // Sandbox / testing mode option.
                        'merchant_key' => 'Merchant key', // PayPal API username of the API caller
                        'salt' => 'Salt', // PayPal API password of the API caller
                        'status' => 'test',
                        'account__id' => $account__user_id
                    );

                    $this->pgateway_model->addPaymentGatewaySettings($data_pgateway_payumoney);


                    $data_email_settings = array(
                        'admin_email' => 'Admin Email', // Sandbox / testing mode option.
                        'account__id' => $account__user_id
                    );

                    $this->email_model->addEmailSettings($data_email_settings);

                    $this->session->set_flashdata('feedback', lang('new_account__created'));
                    redirect('account_');
                }
            } else { // Updating Account_
                $ion_user_id = $this->db->get_where('account_', array('id' => $id))->row()->ion_user_id;
                if (empty($password)) {
                    $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
                } else {
                    $password = $this->ion_auth_model->hash_password($password);
                }
                $this->account__model->updateIonUser($username, $email, $password, $ion_user_id);
                $this->account__model->updateAccount_($id, $data);

                $account__settings_data = array();
                $account__settings_data = array(
                    'language' => $language
                );
                $this->settings_model->updateAccount_Settings($id, $account__settings_data);


                $this->session->set_flashdata('feedback', lang('updated'));
                redirect('account_/editAccount_?id=' . $id);
            }
            // Loading View
        }
    }

    function getAccount_() {
        $data['account_s'] = $this->account__model->getAccount_();
        $this->load->view('account_', $data);
    }

    function activate() {
        $account__id = $this->input->get('account__id');
        $data = array('active' => 1);
        $this->account__model->activate($account__id, $data);
        $this->session->set_flashdata('feedback', lang('activated'));
        redirect('account_');
    }

    function deactivate() {
        $account__id = $this->input->get('account__id');
        $data = array('active' => 0);
        $this->account__model->deactivate($account__id, $data);
        $this->session->set_flashdata('feedback', lang('deactivated'));
        redirect('account_');
    }

    function editAccount_() {
        $data = array();
        $id = $this->input->get('id');
        $data['packages'] = $this->package_model->getPackage();
        $data['account_'] = $this->account__model->getAccount_ById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editAccount_ByJason() {
        $id = $this->input->get('id');
        $data['account_'] = $this->account__model->getAccount_ById($id);
        $data['settings'] = $this->settings_model->getSettingsByHId($id);
        echo json_encode($data);
    }

    function delete() {
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('account_', array('id' => $id))->row();
        $ion_user_id = $user_data->ion_user_id;
        $this->db->where('id', $ion_user_id);
        $this->db->delete('users');
        $this->account__model->delete($id);
        redirect('account_');
    }

}

/* End of file account_.php */
/* Location: ./application/modules/account_/controllers/account_.php */
