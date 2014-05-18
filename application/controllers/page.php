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
        $this->load->model('login_model');
        $this->load->model('facebook_model');
        $this->load->model('user_model');
        $data['title'] = "My Friends";
        $data['url'] = $this->facebook_model->getLoginUrl();

        $user = $this->login_model->getCurrentUser();
        $user = $user[0];

        // retrieve friends from facebook, in the future will be in a batch
        $this->user_model->updateFriends($user);

        // retrieve friends from DB
        $data['friends'] = $this->user_model->getFriends($user->id);

        $this->load->view('template/header');
        $this->load->view('friends', $data);
        $this->load->view('template/footer');
    }

    public function profile()
    {
        $this->load->model('user_model');

        $data['test'] = $this->user_model->checkDatabase();

        $this->load->view('template/header');
        $this->load->view('test', $data);
        $this->load->view('template/footer');
    }

    public function myBooks()
    {
        $this->load->model('facebook_model');
        $this->load->model('book_model');
        //$data['books'] = $this->book_model->getFakeBooks();
        $facebookId = $this->facebook_model->getFacebookId();
        $data['books'] = $this->book_model->getUserBooks($facebookId);
        if ($data['books']==null) {
            $this->book_model->insertFakeBooks($facebookId);
            $data['books'] = $this->book_model->getUserBooks($facebookId);
        }
        $this->load->view('template/header');
        $this->load->view('books', $data);
        $this->load->view('template/footer');
    }

    public function book($bookId)
    {
        echo $bookId;
        $this->load->model('book_model');
        $data['book'] = $this->book_model->getFakeBook();
        $this->load->model('facebook_model');
        $data2['title'] = "Friends who has this book";
        $data2['url'] = $this->facebook_model->getLoginUrl();
        $data2['friends'] = $this->book_model->getOwners(253);
        $this->load->view('template/header');
        $this->load->view('book', $data);
        $this->load->view('friends', $data2);
        $this->load->view('template/footer');
    }

    public function newsfeed()
    {
        $this->load->model('user_model');
        $this->load->model('newsfeed_model');
        $this->load->view('template/header');
        $this->load->view('newsfeed');
        $this->load->view('template/footer');
    }

}

