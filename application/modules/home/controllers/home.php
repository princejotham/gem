<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('finance/finance_model');
        $this->load->model('patient_care/patient_care_model');
        $this->load->model('account_/account__model');
        $this->load->model('notice/notice_model');
        $this->load->model('home_model');
    }

    public function index() {
        if (!$this->ion_auth->in_group(array('superadmin'))) {
            $data = array();
            $data['settings'] = $this->settings_model->getSettings();
            $data['sum'] = $this->home_model->getSum('gross_total', 'payment');
            $data['payments'] = $this->finance_model->getPayment();
            $data['notices'] = $this->notice_model->getNotice();
            $data['this_month'] = $this->finance_model->getThisMonth();
            $data['expenses'] = $this->finance_model->getExpense();
            if ($this->ion_auth->in_group(array('Case_manager'))) {
                redirect('case_manager/details');
            } else {
                $data['patient_cares'] = $this->patient_care_model->getPatient_care();
            }

            if ($this->ion_auth->in_group(array('Finance_', 'Admin_comm'))) {
                redirect('finance/addPaymentView');
            }

            if ($this->ion_auth->in_group(array('Pharmacist'))) {
                redirect('finance/pharmacy/home');
            }

            if ($this->ion_auth->in_group(array('Patient'))) {
                redirect('patient/medicalHistory');
            }



            $data['this_month']['payment'] = $this->finance_model->thisMonthPayment();
            $data['this_month']['expense'] = $this->finance_model->thisMonthExpense();
            $data['this_month']['patient_care'] = $this->finance_model->thisMonthPatient_care();

            $data['this_day']['payment'] = $this->finance_model->thisDayPayment();
            $data['this_day']['expense'] = $this->finance_model->thisDayExpense();
            $data['this_day']['patient_care'] = $this->finance_model->thisDayPatient_care();

            $data['this_year']['payment'] = $this->finance_model->thisYearPayment();
            $data['this_year']['expense'] = $this->finance_model->thisYearExpense();
            $data['this_year']['patient_care'] = $this->finance_model->thisYearPatient_care();

            $data['this_month']['patient_care'] = $this->finance_model->thisMonthPatient_care();
            $data['this_month']['patient_care_treated'] = $this->finance_model->thisMonthPatient_careTreated();
            $data['this_month']['patient_care_cancelled'] = $this->finance_model->thisMonthPatient_careCancelled();

            $data['this_year']['payment_per_month'] = $this->finance_model->getPaymentPerMonthThisYear();


            $data['this_year']['expense_per_month'] = $this->finance_model->getExpensePerMonthThisYear();



            $this->load->view('dashboard'); // just the header file
            $this->load->view('home', $data);
            $this->load->view('footer', $data);
        } else {
            $data['account_s'] = $this->account__model->getAccount_();
            $this->load->view('dashboard'); // just the header file
            $this->load->view('home', $data);
            $this->load->view('footer');
        }
    }

    public function permission() {
        $this->load->view('permission');
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
