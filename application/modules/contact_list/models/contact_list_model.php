<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact_list_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertContact_list($data) {
        $data1 = array('account__id' => $this->session->userdata('account__id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('contact_list', $data2);
    }

    function getContact_list() {
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $query = $this->db->get('contact_list');
        return $query->result();
    }

    function getContact_listById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('contact_list');
        return $query->row();
    }

    function updateContact_list($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('contact_list', $data);
    }

    function deleteContact_list($id) {
        $this->db->where('id', $id);
        $this->db->delete('contact_list');
    }

    function getBloodBank() {
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $query = $this->db->get('bankb');
        return $query->result();
    }

    function getBloodBankById($id) {
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $this->db->where('id', $id);
        $query = $this->db->get('bankb');
        return $query->row();
    }

    function updateBloodBank($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('bankb', $data);
    }
    
    function insertBloodBank($data) {
        $this->db->insert('bankb', $data);
    }
                                

}
