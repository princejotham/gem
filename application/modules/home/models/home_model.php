<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getSum($field, $table) {
        $this->db->select_sum($field);
         $this->db->where('account__id', $this->session->userdata('account__id'));
        $query = $this->db->get($table);
        return $query->result();
    }

}
