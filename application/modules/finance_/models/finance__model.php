<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Finance__model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertFinance_($data) {
        $data1 = array('account__id' => $this->session->userdata('account__id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('finance_', $data2);
    }

    function getFinance_() {
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $query = $this->db->get('finance_');
        return $query->result();
    }

    function getFinance_ById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('finance_');
        return $query->row();
    }

    function updateFinance_($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('finance_', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('finance_');
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

    function getFinance_ByIonUserId($id) {
        $this->db->where('ion_user_id', $id);
        $query = $this->db->get('finance_');
        return $query->row();
    }

}
