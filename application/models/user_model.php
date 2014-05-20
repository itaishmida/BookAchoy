<?php
class User_model extends CI_Model {

    //constants are defined at "config/constants.php"

    function __construct(){
        parent::__construct();


    }
    function add_user($fbid,$name,$email)
    {
        $row = array(
            "fbid" => $fbid,
            "name" => $name,
            "email" => $email,
            "aact_status" => ACTIVE,
            "join_date" => time()
        );
        $this->db->insert('user',$row);
    }

    function login($fbid)
    {
        $this->session->sess_destroy();
        $user = $this->get_user($fbid);

        if(!empty($user))
        {
            $this->set_session($fbid,'login');
            if($user['fbid'] == $fbid)
                return true;
            else
                return false;
        }
        return false;

    }

    function get_user($fbid)
    {
        $query = $this->db->query('SELECT * FROM user WHERE fbid = ' . $fbid);

        return $query->result_array();//array
    }


    function set_session($fbid, $state)
    {
        switch($state){
            case "login":{
                $user = $this->get_user($fbid); //get user row from db
                $this->session->set_userdata($user); //update the session with user info (LOGIN)
                                                    //it's important to use session info from this point
            }break;
            case "logout":{
                $this->session->sess_destroy(); //clearing the session means a logout for us
            }break;
            case "default":{
                throw new Exception("session error");
            }
        }

    }


}