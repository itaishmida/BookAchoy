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
        $this->load->model('login_model');
        $this->load->model('facebook_model');

        $dataHeader['fbLogin'] = $this->facebook_model->getLoginUrl();

        $dataHeader['title'] = "Contact Us";
        $this->load->view('template/header',$dataHeader);
        $this->load->view('contact');
        $this->load->view('template/footer');
    }
    public function how_it_works()
    {
        $dataHeader['title'] = "How It Works";
        $this->load->view('template/header',$dataHeader);
        $this->load->view('how_it_works');
        $this->load->view('template/footer');
    }
    public function about()
    {
        $this->load->model('login_model');
        $this->load->model('facebook_model');

        $dataHeader['fbLogin'] = $this->facebook_model->getLoginUrl();
        $dataHeader['title'] = "About Us";
        $this->load->view('template/header',$dataHeader);
        $this->load->view('about');
        $this->load->view('template/footer');
    }

    public function myFriends()
    {
        $this->load->model('login_model');
        $this->load->model('facebook_model');
        $this->load->model('user_model');

        $user = $this->login_model->getCurrentUser();
        $user = $user;
        $data['user'] = $user;
        $data['friends'] = $this->user_model->getFriends($user);
        $dataHeader['fbLogin'] = $this->facebook_model->getLoginUrl();
        $dataHeader['title'] = "My Friends";
        $this->load->view('template/header',$dataHeader);
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

    public function myBookshelf()
    {
        $this->load->model('login_model');
        $this->load->model('book_model');
        $this->load->model('facebook_model');
        $dataHeader['fbLogin'] = $this->facebook_model->getLoginUrl();

        $user = $this->login_model->getCurrentUser();

        $data['books'] = $this->book_model->getUserBooks($user->id);
        if ($data['books']==null) {
            $this->book_model->insertFakeBooksToUserBookshelf($user->id);
            $data['books'] = $this->book_model->getUserBooks($user->id);
        }
        $dataHeader['title'] = "My Bookshelf";
        $this->load->view('template/header',$dataHeader);
        $this->load->view('books', $data);
        $this->load->view('addBook');
        $this->load->view('template/footer');
    }

    public function bookshelf($userId)
    {
        $this->load->model('book_model');
        $this->load->model('user_model');
        $this->load->model('facebook_model');
        $dataHeader['fbLogin'] = $this->facebook_model->getLoginUrl();
        $data['books'] = $this->book_model->getUserBooks($userId);
        $user = $this->user_model->get_user($userId);
        $data['title'] = $user->name."'s books";

        $this->load->view('template/header',$dataHeader);
        $this->load->view('books', $data);
        $this->load->view('template/footer');
    }

    public function book($bookId)
    {
        $this->load->model('book_model');
        $this->load->model('user_model');
        $this->load->model('facebook_model');
        $dataHeader['fbLogin'] = $this->facebook_model->getLoginUrl();

        $data['book'] = $this->book_model->getBook($bookId);
        $data['book'] = $data['book'];
        $friendsData['friends'] = $this->book_model->getOwners($data['book']['id']);
        $friendsData['url'] = '';

        $dataHeader['title'] = "Friends who has this book";
        $this->load->view('template/header',$dataHeader);
        $this->load->view('book', $data);
        $this->load->view('friends', $friendsData);
        $this->load->view('template/footer');
    }

    public function addBook($googleBookId) {
        $this->load->model('login_model');
        $this->load->model('book_model');
        $this->load->model('google_model');
        $user = $this->login_model->getCurrentUser();
        $userId = $user->id;
        $book = $this->google_model->getBookDetails($googleBookId);
        $data['bookDetails'] = $this->book_model->addBookToUserByGoogleId($userId, $googleBookId);
        $this->myBooks();
    }

    public function newsfeed()
    {
        $this->load->model('login_model');
        $this->load->model('user_model');
        $this->load->model('newsfeed_model');
        $this->load->model('facebook_model');
        $dataHeader['fbLogin'] = $this->facebook_model->getLoginUrl();

        $user = $this->login_model->getCurrentUser();
        if ($user==null) {
            $user->id = 1;
        }

        $data['result'] = $this->newsfeed_model->getNewsFeedBooks($user->id);

        $dataHeader['title'] = "News Feed";
        $this->load->view('template/header',$dataHeader);
        $this->load->view('newsfeed',$data);
        $this->load->view('template/footer');
    }

    public function test_addBook() {
        $this->load->model('book_model');
        $this->book_model->test_addBook();
    }
}

