<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {

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
        $this->load->model('facebook_model');
        $data['url'] = $this->facebook_model->getLoginUrl();
        $data['friends'] = $this->facebook_model->getFriends();
        $data['allFriends'] = true;
        $this->load->view('template/header');
        $this->load->view('friends', $data);
        $this->load->view('template/footer');
    }

    public function profile()
    {
        $this->load->model('facebook_model');
        $this->load->model('book_model');

        $data['url'] = $this->facebook_model->getLoginUrl();
        $data['friends'] = $this->facebook_model->getFriends();
        $data['allFriends'] = false;
        $data2['books'] = $this->book_model->getFakeBooks();

        $this->load->view('template/header');
        $this->load->view('friends', $data);
        $this->load->view('books', $data2);
        $this->load->view('template/footer');
    }

    public function myBooks()
    {
        $this->load->model('book_model');
        $data['books'] = $this->book_model->getFakeBooks();
        $this->load->view('template/header');
        $this->load->view('books', $data);
        $this->load->view('template/footer');
    }


}

