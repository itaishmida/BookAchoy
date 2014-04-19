<?php
class User_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }
    function get_users()
    {
        $x = array(
            "shay" => "123987123",
            "adi" => "0921397123"
        );

        return $x;//array
    }


}