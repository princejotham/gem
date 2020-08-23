<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Department_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertDepartment($data) {
        $data1 = array('account__id' => $this->session->userdata('account__id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('department', $data2);
    }

    function getDepartment() {
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $query = $this->db->get('department');
        return $query->result();
    }

    function getDepartmentById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('department');
        return $query->row();
    }

    function updateDepartment($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('department', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('department');
    }

}
