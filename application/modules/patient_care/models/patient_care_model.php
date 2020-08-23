<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Patient_care_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertPatient_care($data) {
        $data1 = array('account__id' => $this->session->userdata('account__id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('patient_care', $data2);
    }

    function getPatient_care() {
        $this->db->order_by('id', 'desc');
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $query = $this->db->get('patient_care');
        return $query->result();
    }

    function getPatient_careBySearch($search) {
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $this->db->order_by('id', 'desc');
        $this->db->like('id', $search);
        $this->db->or_like('name', $search);
        $query = $this->db->get('patient_care');
        return $query->result();
    }

    function getPatient_careByLimit($limit, $start) {
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_care');
        return $query->result();
    }

    function getPatient_careByLimitBySearch($limit, $start, $search) {
        $this->db->where('account__id', $this->session->userdata('account__id'));

        $this->db->like('id', $search);

        $this->db->order_by('id', 'desc');

        $this->db->or_like('name', $search);
        $this->db->or_like('phone', $search);
        $this->db->or_like('address', $search);

        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_care');
        return $query->result();
    }

    function getPatient_careForCalendar() {
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('patient_care');
        return $query->result();
    }

    function getPatient_careByCase_manager($case_manager) {
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $this->db->order_by('id', 'desc');
        $this->db->where('case_manager', $case_manager);
        $query = $this->db->get('patient_care');
        return $query->result();
    }

    function getPatient_careRequest() {
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $this->db->order_by('id', 'desc');
        $this->db->where('request', 'Yes');
        $query = $this->db->get('patient_care');
        return $query->result();
    }

    function getPatient_careRequestByCase_manager($case_manager) {
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $this->db->where('request', 'Yes');
        $this->db->where('case_manager', $case_manager);
        $query = $this->db->get('patient_care');
        return $query->result();
    }

    function getPatient_careByPatient($patient) {
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $this->db->order_by('id', 'desc');
        $this->db->where('patient', $patient);
        $query = $this->db->get('patient_care');
        return $query->result();
    }

    function getPatient_careByStatus($status) {
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $this->db->order_by('id', 'desc');
        $this->db->where('status', $status);
        $query = $this->db->get('patient_care');
        return $query->result();
    }

    function getPatient_careByStatusByCase_manager($status, $case_manager) {
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $this->db->order_by('id', 'desc');
        $this->db->where('status', $status);
        $this->db->where('case_manager', $case_manager);
        $query = $this->db->get('patient_care');
        return $query->result();
    }

    function getPatient_careById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('patient_care');
        return $query->row();
    }

    function getPatient_careByDate($date_from, $date_to) {
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $this->db->select('*');
        $this->db->from('patient_care');
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }

    function getPatient_careByCase_managerByToday($case_manager_id) {
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $today = strtotime(date('Y-m-d'));
        $this->db->where('case_manager', $case_manager_id);
        $this->db->where('date', $today);
        $query = $this->db->get('patient_care');
        return $query->result();
    }

    function updatePatient_care($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('patient_care', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('patient_care');
    }

    function updateIonUser($username, $email, $password, $ion_user_id) {
        $uptade_ion_user = array(
            'username' => $username,
            'email' => $email,
            'password' => $password
        );
        $this->db->where('id', $ion_user_id);
        $this->db->update('users', $uptade_ion_user);
    }

}
