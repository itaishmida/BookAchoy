<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {



	public function index()
	{
        $this->load->model('facebook_model');
        $data['fbLogin'] = $this->facebook_model->getLoginUrl();
        $this->load->view('template/header',$data);
        $this->load->view('main',$data);
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

    public function myFriends()
    {
        $this->load->model('login_model');
        $this->load->model('facebook_model');
        $this->load->model('user_model');

        $data['debug'] = 'debug: ';
        $data['url'] = $this->facebook_model->getLoginUrl();
        $user = $this->login_model->getCurrentUser();
        $user = $user[0];
        //print_r($user);
        $data['user'] = $user;
        $data['title'] = "My Friends";
        $data['friends'] = $this->user_model->getFriends($user);
        /*
        $data['allUsers'] = $this->user_model->getAllUsers();
        $data['allRelations'] = $this->user_model->getAllFriends();
        $data['facebook_friends'] = $this->facebook_model->getFriends();
        $data['facebook_friends'] = $this->user_model->getUsersByFacebookIds($data['facebook_friends']);
        //$this->user_model->updateFriends($user);
        //$stam = $this->user_model->deleteUser(676039134);
*/
        $this->load->view('template/header');
        $this->load->view('friends', $data);
        $this->load->view('template/footer');
    }

    public function friends($userId)
    {
        $this->load->model('user_model');

        $user = $this->user_model->getUser($userId);
        $user = $user[0];
        $data['title'] = $user->name . "'s Friends";

        // retrieve friends from DB
        $data['friends'] = $this->user_model->getFriends($user->id);

        $this->load->view('template/header');
        $this->load->view('friends', $data);
        $this->load->view('template/footer');
    }

    public function myBooks()
    {
        $this->load->model('login_model');
        $this->load->model('facebook_model');
        $this->load->model('book_model');
        //$data['books'] = $this->book_model->getFakeBooks();
        $user = $this->login_model->getCurrentUser();
        //$facebookId = $this->facebook_model->getFacebookId();
        $data['title'] = "My books";
        $data['books'] = $this->book_model->getUserBooks($user[0]->id);
        if ($data['books']==null) {
            $this->book_model->insertFakeBooks($user[0]->id);
            $data['books'] = $this->book_model->getUserBooks($user[0]->id);
        }
        $this->load->view('template/header');
        $this->load->view('books', $data);
        $this->load->view('template/footer');
    }

    public function bookshelf($userId)
    {
        $this->load->model('book_model');
        $this->load->model('user_model');
        $data['books'] = $this->book_model->getUserBooks($userId);
        $user = $this->user_model->getUser($userId);
        $data['title'] = $user[0]["name"] . "'s books";

        $this->load->view('template/header');
        $this->load->view('books', $data);
        $this->load->view('template/footer');
    }

    public function book($bookId)
    {
        $this->load->model('book_model');
        $this->load->model('user_model');

        $data['book'] = $this->book_model->getBook($bookId);
        $data['book'] = $data['book'][0];
        $friendsData['title'] = "Friends who has this book";
        $friendsData['friends'] = $this->book_model->getOwners($data['book']['id']);
        $friendsData['url'] = '';

        $this->load->view('template/header');
        $this->load->view('book', $data);
        $this->load->view('friends', $friendsData);
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

