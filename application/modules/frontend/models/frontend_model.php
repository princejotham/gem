<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Frontend_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function getCase_managerByAccount_($account__id) {
        $this->db->where('account__id', $account__id);
        $query = $this->db->get('case_manager');
        return $query->result();
    }

    function insertPatient_care($data) {

        $this->db->insert('patient_care', $data);
    }

    function getPatient_care() {
        $query = $this->db->get('patient_care');
        return $query->result();
    }

    function getPatient_careBySearch($search) {
        $this->db->order_by('id', 'desc');
        $this->db->like('id', $search);
        $this->db->or_like('name', $search);
        $query = $this->db->get('patient_care');
        return $query->result();
    }

    function getPatient_careByLimit($limit, $start) {
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_care');
        return $query->result();
    }

    function getPatient_careByLimitBySearch($limit, $start, $search) {

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
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('patient_care');
        return $query->result();
    }

    function getPatient_careByCase_manager($case_manager) {
        $this->db->where('case_manager', $case_manager);
        $query = $this->db->get('patient_care');
        return $query->result();
    }


    /////////

    //  function getPatient_careHos($account_) {
        
    //     $query = $this->db->get('account_');
    //     return $query->result();
    // }


    function getPatient_careByPatient($patient) {
        $this->db->where('patient', $patient);
        $query = $this->db->get('patient_care');
        return $query->result();
    }

    function getPatient_careById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('patient_care');
        return $query->row();
    }

    function getPatient_careByDate($date_from, $date_to) {
        $this->db->select('*');
        $this->db->from('patient_care');
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
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


    function getSettings() {
        $query = $this->db->get('website_settings');
        return $query->row();
    }

    function updateSettings($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('website_settings', $data);
    }
    
    function getAvailableSlotByCase_managerByDate($date, $case_manager) {
        //$newDate = date("m-d-Y", strtotime($date));
        $weekday = strftime("%A", $date);

        $this->db->where('date', $date);
        $this->db->where('case_manager', $case_manager);
        $holiday = $this->db->get('holidays')->result();

        if (empty($holiday)) {
            $this->db->where('date', $date);
            $this->db->where('case_manager', $case_manager);
            $query = $this->db->get('patient_care')->result();


            $this->db->where('case_manager', $case_manager);
            $this->db->where('weekday', $weekday);
            $this->db->order_by('s_time_key', 'asc');
            $query1 = $this->db->get('time_slot')->result();

            $availabletimeSlot = array();
            $bookedTimeSlot = array();

            foreach ($query1 as $timeslot) {
                $availabletimeSlot[] = $timeslot->s_time . ' To ' . $timeslot->e_time;
            }
            foreach ($query as $bookedTime) {
                if ($bookedTime->status != 'Cancelled') {
                    $bookedTimeSlot[] = $bookedTime->time_slot;
                }
            }

            $availableSlot = array_diff($availabletimeSlot, $bookedTimeSlot);
        } else {
            $availableSlot = array();
        }

        return $availableSlot;
    }
    

}
