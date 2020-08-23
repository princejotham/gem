<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Account__model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function account_Id() {
        if (!$this->ion_auth->in_group(array('superadmin'))) {
            if ($this->ion_auth->in_group(array('admin'))) {
                $current_user_id = $this->ion_auth->user()->row()->id;
                $account__id = $this->db->get_where('account_', array('ion_user_id' => $current_user_id))->row()->id;
                return $account__id;
            } else {
                $current_user_id = $this->ion_auth->user()->row()->id;
                $group_id = $this->db->get_where('users_groups', array('user_id' => $current_user_id))->row()->group_id;
                $group_name = $this->db->get_where('groups', array('id' => $group_id))->row()->name;
                $group_name = strtolower($group_name);
                $account__id = $this->db->get_where($group_name, array('ion_user_id' => $current_user_id))->row()->account__id;
                return $account__id;
            }
        }   
    }

    function modules() {
        if (!$this->ion_auth->in_group(array('superadmin'))) {
            if ($this->ion_auth->in_group(array('admin'))) {
                $current_user_id = $this->ion_auth->user()->row()->id;
                $modules = $this->db->get_where('account_', array('ion_user_id' => $current_user_id))->row()->module;
                $module = explode(',', $modules);
                return $module;
            } else {
                $current_user_id = $this->ion_auth->user()->row()->id;
                $group_id = $this->db->get_where('users_groups', array('user_id' => $current_user_id))->row()->group_id;
                $group_name = $this->db->get_where('groups', array('id' => $group_id))->row()->name;
                $group_name = strtolower($group_name);
                $account__id = $this->db->get_where($group_name, array('ion_user_id' => $current_user_id))->row()->account__id;
                $modules = $this->db->get_where('account_', array('id' => $account__id))->row()->module;
                $module = explode(',', $modules);
                return $module;
            }
        }
    }

    function addAccount_IdToIonUser($ion_user_id, $account__id) {
        $account__ion_id = $this->db->get_where('account_', array('id' => $account__id))->row()->ion_user_id;
        $uptade_ion_user = array(
            'account__ion_id' => $account__ion_id,
        );
        $this->db->where('id', $ion_user_id);
        $this->db->update('users', $uptade_ion_user);
    }

    function insertAccount_($data) {
        $this->db->insert('account_', $data);
    }

    function getAccount_() {
        $query = $this->db->get('account_');
        return $query->result();
    }

    function getAccount_ById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('account_');
        return $query->row();
    }

    function updateAccount_($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('account_', $data);
    }
    
    function updateAccount_ByIonId($id, $data) {
        $this->db->where('ion_user_id', $id);
        $this->db->update('account_', $data);
    }
    
    

    function activate($id, $data) {
        $this->db->where('id', $id);
        $this->db->or_where('account__ion_id', $id);
        $this->db->update('users', $data);
    }

    function deactivate($id, $data) {
        $this->db->where('account__ion_id', $id);
        $this->db->or_where('id', $id);
        $this->db->update('users', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('account_');
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

    function getAccount_Id($current_user_id) {
        $group_id = $this->db->get_where('users_groups', array('user_id' => $current_user_id))->row()->group_id;
        $group_name = $this->db->get_where('groups', array('id' => $group_id))->row()->name;
        $group_name = strtolower($group_name);
        $account__id = $this->db->get_where($group_name, array('ion_user_id' => $current_user_id))->row()->account__id;
        return $account__id;
    }

}
