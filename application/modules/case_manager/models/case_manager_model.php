<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Case_manager_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertCase_manager($data) {
        $data1 = array('account__id' => $this->session->userdata('account__id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('case_manager', $data2);
    }


    //this function is view in frontend
   


    //  //this function is view in frontend
    // function getDc() {

    //     $this->db->order_by('id');
      
    //  $this->db->where('account__id', $this->session->userdata('account__id'));
    //       $this->db->like('account__id', $account_);
        
    //       $query = $this->db->get('case_manager');
    // }



    //     //  //this function is view in frontend
    function getCase_manager() {
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $query = $this->db->get('case_manager');
        return $query->result();
    }


    //     //  //this function is view in frontend
    function getCase_managerr() {
        
        $query = $this->db->get('case_manager');
        return $query->result();
    }






















    /////account_
    function getHos(){

       $query = $this->db->get('account_');
        return $query->result();

    }

    function getLimit() {
        $current = $this->db->get_where('case_manager', array('account__id' => $this->account__id))->num_rows();
        $limit = $this->db->get_where('account_', array('id' => $this->account__id))->row()->d_limit;
        return $limit - $current;
    }

    function getCase_managerBySearch($search) {

        $this->db->order_by('id', 'desc');

        /*
          $this->db->where('account__id', $this->session->userdata('account__id'));
          $this->db->like('id', $search);
          $this->db->or_like('name', $search);
          $this->db->or_like('phone', $search);
          $this->db->or_like('address', $search);
          $this->db->or_like('email', $search);
          $this->db->or_like('department', $search);
          $query = $this->db->get('case_manager');
         * 
         */

        $query = $this->db->select('*')
                ->from('case_manager')
                ->where('account__id', $this->session->userdata('account__id'))
                ->where("(id LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR phone LIKE '%" . $search . "%' OR address LIKE '%" . $search . "%'OR email LIKE '%" . $search . "%'OR department LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
    }

    function getCase_managerByLimit($limit, $start) {
        $this->db->where('account__id', $this->session->userdata('account__id'));
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('case_manager');
        return $query->result();
    }

    function getCase_managerByLimitBySearch($limit, $start, $search) {


        $this->db->order_by('id', 'desc');

        /*
          $this->db->where('account__id', $this->session->userdata('account__id'));
          $this->db->like('id', $search);
          $this->db->or_like('name', $search);
          $this->db->or_like('phone', $search);
          $this->db->or_like('address', $search);
          $this->db->or_like('email', $search);
          $this->db->or_like('department', $search);
          $this->db->limit($limit, $start);
          $query = $this->db->get('case_manager');
         * 
         */

        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('case_manager')
                ->where('account__id', $this->session->userdata('account__id'))
                ->where("(id LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR phone LIKE '%" . $search . "%' OR address LIKE '%" . $search . "%'OR email LIKE '%" . $search . "%'OR department LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
    }

    function getCase_managerById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('case_manager');
        return $query->row();
    }

    function getCase_managerByIonUserId($id) {
        $this->db->where('ion_user_id', $id);
        $query = $this->db->get('case_manager');
        return $query->row();
    }

    function updateCase_manager($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('case_manager', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('case_manager');
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
