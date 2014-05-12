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

    function checkDatabase() {
        $this->load->model('facebook_model');
        $friends = $this->facebook_model->getFriends();

        $this->load->class('UserMySqlDAO.class');
        $user = null;
        $user->id = '111';
        $user->name = 'shai fisher';
        $myInstance->insert($user);

        $user2 = $myInstance->load('111');
        return $user2;
    }

}