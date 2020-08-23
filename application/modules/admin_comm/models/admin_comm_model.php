<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_comm_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertAdmin_comm($data) {
        $data1 = array('account__id' => $this->session->userdata('account__id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('admin_comm', $data2);
    }

    function getAdmin_comm() {
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $query = $this->db->get('admin_comm');
        return $query->result();
    }

    function getAdmin_commById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('admin_comm');
        return $query->row();
    }

    function getAdmin_commByIonUserId($id) {
        $this->db->where('ion_user_id', $id);
        $query = $this->db->get('admin_comm');
        return $query->row();
    }

    function updateAdmin_comm($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('admin_comm', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('admin_comm');
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
