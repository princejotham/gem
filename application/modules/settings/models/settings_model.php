<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    function insertSettings($account__settings_data) {
        $this->db->insert('settings', $account__settings_data);
    }


    function getSettings() {
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $query = $this->db->get('settings');
        return $query->row();
    }

    function updateSettings($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('settings', $data);
    }
    
    function updateAccount_Settings($id, $data) {
        $this->db->where('account__id', $id);
        $this->db->update('settings', $data);
    }
    
    
     function getSubscription() {
        $this->db->where('id', $this->account__id);
        $query = $this->db->get('account_');
        return $query->row();
    }


}
