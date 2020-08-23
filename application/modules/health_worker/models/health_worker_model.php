<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Health_worker_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertHealth_worker($data) {
        $data1 = array('account__id' => $this->session->userdata('account__id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('health_worker', $data2);
    }

    function getHealth_worker() {
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $query = $this->db->get('health_worker');
        return $query->result();
    }

    function getHealth_workerById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('health_worker');
        return $query->row();
    }

    function updateHealth_worker($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('health_worker', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('health_worker');
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
