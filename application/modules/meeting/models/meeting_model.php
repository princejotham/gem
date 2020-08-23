<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Meeting_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertMeeting($data) {
        $data1 = array('account__id' => $this->session->userdata('account__id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('meeting', $data2);
    }

    function getMeeting() {
        if ($this->ion_auth->in_group('Case_manager')) {
            $this->db->where('case_manager_ion_id', $this->ion_auth->get_user_id());
        } elseif ($this->ion_auth->in_group('Patient')) {
            $this->db->where('patient_ion_id', $this->ion_auth->get_user_id());
        }
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('meeting');
        return $query->result();
    }

    function getMeetingBySearch($search) {

        if ($this->ion_auth->in_group('Case_manager')) {
            $this->db->where('case_manager_ion_id', $this->ion_auth->get_user_id());
        } elseif ($this->ion_auth->in_group('Patient')) {
            $this->db->where('patient_ion_id', $this->ion_auth->get_user_id());
        } else {
            $this->db->where('account__id', $this->session->userdata('account__id'));
        }

        $this->db->order_by('id', 'desc');
        $this->db->like('id', $search);
        $this->db->or_like('patientname', $search);
        $this->db->or_like('case_managername', $search);
        $query = $this->db->get('meeting');
        return $query->result();
    }

    function getMeetingByLimit($limit, $start) {

        if ($this->ion_auth->in_group('Case_manager')) {
            $this->db->where('case_manager_ion_id', $this->ion_auth->get_user_id());
        } elseif ($this->ion_auth->in_group('Patient')) {
            $this->db->where('patient_ion_id', $this->ion_auth->get_user_id());
        } else {
            $this->db->where('account__id', $this->session->userdata('account__id'));
        }

        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('meeting');
        return $query->result();
    }

    function getMeetingByLimitBySearch($limit, $start, $search) {

        if ($this->ion_auth->in_group('Case_manager')) {
            $this->db->where('case_manager_ion_id', $this->ion_auth->get_user_id());
        } elseif ($this->ion_auth->in_group('Patient')) {
            $this->db->where('patient_ion_id', $this->ion_auth->get_user_id());
        } else {
            $this->db->where('account__id', $this->session->userdata('account__id'));
        }

        $this->db->like('id', $search);
        $this->db->order_by('id', 'desc');
        $this->db->or_like('patientname', $search);
        $this->db->or_like('case_managername', $search);
        $this->db->limit($limit, $start);
        $query = $this->db->get('meeting');
        return $query->result();
    }

    function getMeetingByCase_manager($case_manager) {
        $this->db->order_by('id', 'desc');
        $this->db->where('case_manager', $case_manager);
        $query = $this->db->get('meeting');
        return $query->result();
    }

    function getMeetingByPatient($patient) {
        $this->db->order_by('id', 'desc');
        $this->db->where('patient', $patient);
        $query = $this->db->get('meeting');
        return $query->result();
    }

    function getMeetingById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('meeting');
        return $query->row();
    }

    function getMeetingByZoomMeetingId($id) {
        $this->db->where('meeting_id', $id);
        $query = $this->db->get('meeting');
        return $query->row();
    }

    function getMeetingByCase_managerByToday($case_manager_id) {
        $today = strtotime(date('Y-m-d'));
        $this->db->where('case_manager', $case_manager_id);
        $this->db->where('date', $today);
        $query = $this->db->get('meeting');
        return $query->result();
    }

    function updateMeeting($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('meeting', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('meeting');
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

    function getRequestMeetingBySearchByCase_manager($case_manager, $search) {
        $this->db->order_by('id', 'desc');
        $query = $this->db->select('*')
                ->from('meeting')
                ->where('status', 'Requested')
                ->where('case_manager', $case_manager)
                ->where("(id LIKE '%" . $search . "%' OR patientname LIKE '%" . $search . "%' OR case_managername LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getMeetingSettingsById($case_manager_ion_id) {
        if ($this->ion_auth->in_group('Case_manager')) {
            $this->db->where('ion_user_id', $this->ion_auth->get_user_id());
        } else {
            $this->db->where('ion_user_id', $case_manager_ion_id);
        }
        $query = $this->db->get('meeting_settings');
        return $query->row();
    }

    function addMeetingSettings($data) {
        $data1 = array('ion_user_id' => $this->ion_auth->get_user_id());
        $data2 = array_merge($data, $data1);
        $query = $this->db->insert('meeting_settings', $data2);
    }

    function updateMeetingSettings($id, $data) {
        $this->db->where('ion_user_id', $this->ion_auth->get_user_id());
        $this->db->update('meeting_settings', $data);
    }

}
