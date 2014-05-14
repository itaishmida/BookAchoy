<?php
class User_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }
    function get_user($id)
    {
        $query = $this->db->query('SELECT * FROM user WHERE id = ' . $id);

        return $query->result();//array
    }

}