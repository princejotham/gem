<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Laboratorist_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertLaboratorist($data) {
        $data1 = array('account__id' => $this->session->userdata('account__id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('laboratorist', $data2);
    }

    function getLaboratorist() {
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $query = $this->db->get('laboratorist');
        return $query->result();
    }

    function getLaboratoristById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('laboratorist');
        return $query->row();
    }

    function updateLaboratorist($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('laboratorist', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('laboratorist');
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