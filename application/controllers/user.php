<?php
class user extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('facebook_model');
        $this->load->model('user_model');
        $this->user = $this->facebook->getUser();
    }



    public function login()
    {


    }

    function logout()
    {
        $this->facebook_model->logout();
        $this->user_model->set_session(0,"logout");
        redirect('/');
    }
    public function register()
    {

    }




}