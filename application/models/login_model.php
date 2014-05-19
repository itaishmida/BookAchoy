<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 18/05/14
 * Time: 21:54
 */

class login_model extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getCurrentUser() {
        $this->load->model('facebook_model');
        $this->load->model('user_model');

        // get facebook id
        $facebookId = $this->facebook_model->getFacebookId();
        //print_r($facebookId);
        if ($facebookId != 0) {
            $user = $this->user_model->getUserByFacebookId($facebookId);
            $this->user_model->updateFriends($user);
            //$this->user_model->deleteFakeUser();
        } else
            $user = $this->user_model->getFakeUser();
        //print_r('<BR>user: ');
        //print_r($user);
        // if is new user, insert to DB

        if ($user == null) {
            //print_r('<BR>insert new user');
            $fbuser = $this->facebook_model->getBasicInfo();
            $this->user_model->insertUser($fbuser);
            $this->user_model->updateFriends($user);
            $user = $this->user_model->getUserByFacebookId($facebookId);
        }
        return $user;
    }
} 