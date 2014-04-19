<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {

    /*
     * Constructor
     * Loads facebook API
     */
    public function Page(){
        parent::__construct();
        parse_str( $_SERVER['QUERY_STRING'], $_REQUEST );
        $CI = & get_instance();
        $CI->config->load("facebook",TRUE);
        $config = $CI->config->item('facebook');
        $this->load->library('Facebook', $config);
    }

	public function index()
	{

        $this->load->view('template/header');
        $this->load->view('main');
        $this->load->view('template/footer');

	}
    public function contact()
    {
        $this->load->view('template/header');
        $this->load->view('contact');
        $this->load->view('template/footer');
    }
    public function how_it_works()
    {
        $this->load->view('template/header');
        $this->load->view('how_it_works');
        $this->load->view('template/footer');
    }
    public function about()
    {
        $this->load->view('template/header');
        $this->load->view('about');
        $this->load->view('template/footer');
    }

    public function friends()
    {
        /*
        $this->load->model('facebook_model');
        $data['friends'] = $this->facebook_model->get_friends();
        $this->load->view('template/header');
        $this->load->view('friends',$data);
        $this->load->view('template/footer');
        */
        // Try to get the user's id on Facebook
        $userId = $this->facebook->getUser();

        // If user is not yet authenticated, the id will be zero
        if($userId == 0){
            // Generate a login url
            $data['url'] = $this->facebook->getLoginUrl(array('scope'=>'email'));
            $this->load->view('template/header');
            $this->load->view('friends',$data);
            $this->load->view('template/footer');
        } else {
            // Get user's data and print it
            $user = $this->facebook->api('/me');
            print_r($user);
        }
    }
}

