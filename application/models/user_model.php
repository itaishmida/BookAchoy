<?php
class User_model extends CI_Model {

    private $facebookId;

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

    function getFriends() {
        $this->load->model('facebook_model');
        $friends = $this->facebook_model->getFriends();
        $this->load->class('UserMySqlDAO');
        $this->UserMySqlDAO->insert($user);
    }

}