<?php
class User_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }
    function get_users()
    {
        $x = $this->db->get('users');

        return $x->result_array();
    }


}