<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Schedule_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function getSchedule() {
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $query = $this->db->get('time_schedule');
        return $query->result();
    }

    function getAvailableCase_managerByDate($date) {

        $weekday = strftime("%A", $date);
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $this->db->where('date', $date);
        $query1 = $this->db->get('holidays')->result();
        if (!empty($query1)) {
            $case_manager = array();
            foreach ($query1 as $q1) {
                $case_manager[] = $q1->case_manager;
            }
            $this->db->where_not_in('id', $case_manager);
        }
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $query = $this->db->get('case_manager')->result();
        foreach ($query as $availableCase_manager) {
            $this->db->where('account__id', $this->session->userdata('account__id'));
            $this->db->where('case_manager', $availableCase_manager->id);
            $this->db->where('weekday', $weekday);
            $query_slot = $this->db->get('time_slot')->result();

            if (!empty($query_slot)) {
                $case_manager_avail[] = $availableCase_manager->id;
            }
        }
        $this->db->where_in('id', $case_manager_avail);
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $query_avail_case_manager = $this->db->get('case_manager');
        return $query_avail_case_manager->result();
    }

    function getAvailableCase_managersByDateBySlot($date, $slot) {

        $weekday = strftime("%A", $date);
        $this->db->where('date', $date);
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $query1 = $this->db->get('holidays')->result();
        if (!empty($query1)) {
            $case_manager = array();
            foreach ($query1 as $q1) {
                $case_manager[] = $q1->case_manager;
            }
            $this->db->where_not_in('id', $case_manager);
        }

        $query = $this->db->get('case_manager')->result();
        foreach ($query as $availableCase_manager) {
            $this->db->where('account__id', $this->session->userdata('account__id'));
            $this->db->where('case_manager', $availableCase_manager->id);
            $this->db->where('weekday', $weekday);
            $query_slot = $this->db->get('time_slot')->result();

            if (!empty($query_slot)) {
                $case_manager_avail[] = $availableCase_manager->id;
            }
        }

        foreach ($case_manager_avail as $key => $value) {
            $this->db->where('account__id', $this->session->userdata('account__id'));
            $this->db->where('case_manager', $value);
            $this->db->where('date', $date);
            $this->db->where('time_slot', $slot);
            $query_patient_care = $this->db->get('patient_care')->result();

            if (empty($query_patient_care)) {
                $most_probable_avail_case_manager[] = $value;
            }
        }
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $this->db->where_in('id', $most_probable_avail_case_manager);
        $query_avail_case_manager = $this->db->get('case_manager');
        return $query_avail_case_manager->result();
    }

    function getAvailableSlotByCase_managerByDate($date, $case_manager) {
        //$newDate = date("m-d-Y", strtotime($date));
        $weekday = strftime("%A", $date);

        $this->db->where('date', $date);
        $this->db->where('case_manager', $case_manager);
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $holiday = $this->db->get('holidays')->result();

        if (empty($holiday)) {
            $this->db->where('date', $date);
            $this->db->where('case_manager', $case_manager);
            $this->db->where('account__id', $this->session->userdata('account__id'));
            $query = $this->db->get('patient_care')->result();


            $this->db->where('case_manager', $case_manager);
            $this->db->where('weekday', $weekday);
            $this->db->order_by('s_time_key', 'asc');
            $this->db->where('account__id', $this->session->userdata('account__id'));
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

    function getAvailableSlotByCase_managerByDateByPatient_careId($date, $case_manager, $patient_care_id) {
        //$newDate = date("m-d-Y", strtotime($date));
        $weekday = strftime("%A", $date);

        $this->db->where('date', $date);
        $this->db->where('case_manager', $case_manager);
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $holiday = $this->db->get('holidays')->result();

        if (empty($holiday)) {

            $this->db->where('date', $date);
            $this->db->where('case_manager', $case_manager);
            $this->db->where('account__id', $this->session->userdata('account__id'));
            $query = $this->db->get('patient_care')->result();


            $this->db->where('case_manager', $case_manager);
            $this->db->where('weekday', $weekday);
            $this->db->order_by('s_time_key', 'asc');
            $this->db->where('account__id', $this->session->userdata('account__id'));
            $query1 = $this->db->get('time_slot')->result();

            $availabletimeSlot = array();
            $bookedTimeSlot = array();

            foreach ($query1 as $timeslot) {
                $availabletimeSlot[] = $timeslot->s_time . ' To ' . $timeslot->e_time;
            }
            foreach ($query as $bookedTime) {
                if ($bookedTime->status != 'Cancelled') {
                    if ($bookedTime->id != $patient_care_id) {
                        $bookedTimeSlot[] = $bookedTime->time_slot;
                    }
                }
            }

            $availableSlot = array_diff($availabletimeSlot, $bookedTimeSlot);
        } else {
            $availableSlot = array();
        }

        return $availableSlot;
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

    function getCase_managerByIonUserId($id) {
        $this->db->where('ion_user_id', $id);
        $query = $this->db->get('case_manager');
        return $query->row();
    }

    function insertTimeSlot($data) {
        $data1 = array('account__id' => $this->session->userdata('account__id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('time_slot', $data2);
    }

    function getTimeSlot() {
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $query = $this->db->get('time_slot');
        return $query->result();
    }

    function getTimeSlotById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('time_slot');
        return $query->row();
    }

    function getTimeSlotByCase_manager($id) {
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $this->db->order_by('s_time_key', 'asc');
        $this->db->where('case_manager', $id);
        $query = $this->db->get('time_slot');
        return $query->result();
    }

    function updateTimeSlot($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('time_slot', $data);
    }

    function deleteTimeSlot($id) {
        $this->db->where('id', $id);
        $this->db->delete('time_slot');
    }

    function insertSchedule($data) {
        $data1 = array('account__id' => $this->session->userdata('account__id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('time_schedule', $data2);
    }

    function getScheduleByCase_manager($case_manager) {
        $this->db->where('case_manager', $case_manager);
        $query = $this->db->get('time_schedule');
        return $query->result();
    }

    function getScheduleById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('time_schedule');
        return $query->row();
    }

    function getScheduleByCase_managerByWeekday($case_manager, $weekday) {
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $this->db->where('case_manager', $case_manager);
        $this->db->where('weekday', $weekday);
        $query = $this->db->get('time_schedule');
        return $query->result();
    }

    function getScheduleByCase_managerByWeekdayById($case_manager, $weekday, $id) {
        $this->db->where_not_in('id', $id);
        $this->db->where('case_manager', $case_manager);
        $this->db->where('weekday', $weekday);
        $query = $this->db->get('time_schedule');
        return $query->result();
    }

    function updateSchedule($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('time_schedule', $data);
    }

    function deleteSchedule($id) {
        $this->db->where('id', $id);
        $this->db->delete('time_schedule');
    }

    function deleteTimeSlotByCase_managerByWeekday($case_manager, $weekday) {
        $this->db->where('case_manager', $case_manager);
        $this->db->where('weekday', $weekday);
        $this->db->delete('time_slot');
    }

    function insertHoliday($data) {
        $data1 = array('account__id' => $this->session->userdata('account__id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('holidays', $data2);
    }

    function getHolidays() {
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $query = $this->db->get('holidays');
        return $query->result();
    }

    function getHolidayById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('holidays');
        return $query->row();
    }

    function getHolidaysByCase_manager($id) {
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $this->db->order_by('id', 'asc');
        $this->db->where('case_manager', $id);
        $query = $this->db->get('holidays');
        return $query->result();
    }

    function getHolidayByCase_managerByDate($case_manager, $date) {
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $this->db->where('case_manager', $case_manager);
        $this->db->where('date', $date);
        $query = $this->db->get('holidays');
        return $query->row();
    }

    function getTimeSlotByCase_managerByWeekday($case_manager, $weekday) {
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $this->db->where('case_manager', $case_manager);
        $this->db->where('weekday', $weekday);
        $query = $this->db->get('time_slot');
        return $query->result();
    }

    function getTimeSlotByCase_managerByWeekdayById($case_manager, $weekday, $id) {
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $this->db->where_not_in('id', $id);
        $this->db->where('case_manager', $case_manager);
        $this->db->where('weekday', $weekday);
        $query = $this->db->get('time_slot');
        return $query->result();
    }

    function updateHoliday($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('holidays', $data);
    }

    function deleteHoliday($id) {
        $this->db->where('id', $id);
        $this->db->delete('holidays');
    }

}
