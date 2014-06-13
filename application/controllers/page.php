<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {



	public function index()
	{
        $this->load->model('facebook_model');
        $data['fbLogin'] = $this->facebook_model->getLoginUrl();
        $this->loadHeader("");
        $this->load->view('main',$data);
        $this->load->view('template/footer');

	}
    public function contact()
    {
        $this->loadHeader("Contact Us");
        $this->load->view('contact');
        $this->load->view('template/footer');
    }
    public function about()
    {
        $this->loadHeader("About Us");
        $this->load->view('about');
        $this->load->view('template/footer');
    }

    public function myFriends()
    {
        $this->load->model('login_model');
        $this->load->model('user_model');

        $this->loadHeader("My Friends");
        $user = $this->login_model->getCurrentUser();
        if ($user !=null) {
            $data['friends'] = $this->user_model->getFriends($user);
            $data['invite'] = true;
            $this->load->view('friends', $data);
        }
        $this->load->view('template/footer');
    }
/*
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
*/
    public function myBookshelf()
    {
        $this->load->model('login_model');
        $this->load->model('book_model');

        $this->loadHeader("My Bookshelf");
        $user = $this->login_model->getCurrentUser();
        if ($user != null) {
            $data['books'] = $this->book_model->getUserBooks($user->id);
            $this->load->view('books', $data);
            $this->load->view('addBook');
        }
        $this->load->view('template/footer');
    }

    public function bookshelf($userId)
    {
        $this->load->model('book_model');
        $this->load->model('user_model');
        $data['books'] = $this->book_model->getUserBooks($userId);
        $user = $this->user_model->get_user($userId);
        if ($user!=null)
            $title = $this->user_model->get_user($userId)->name."'s books";
        else
            $title = "";
        $data['title'] = $title;
        $this->loadHeader($title);
        $this->load->view('books', $data);
        $this->load->view('template/footer');
    }

    public function book($bookId)
    {
        $this->load->model('book_model');
        $this->load->model('login_model');
        $this->load->model('review_model');

        $data['book'] = $this->book_model->getBook($bookId);
        $friendsData['friends'] = $this->book_model->getOwners($data['book']['id']);
        $friendsData['title'] = "Friends who has this book";
        $friendsData['bookId'] = $bookId;
        $user = $this->login_model->getCurrentUser();
        $data['isOwnedByCurrentUser'] = $user!=null && $this->book_model->isOwnedby($bookId, $user->id);
        $data['reviews'] = $this->review_model->getReviews($bookId);

        $this->loadHeader($data['book']['name']);
        $this->load->view('book', $data);
        $this->load->view('friends', $friendsData);
        $this->load->view('template/footer');
    }

    public function searchBook() {
        $this->load->model('google_model');
        $searchTerm = $this->input->post('searchTerm');
        $data['searchResults'] = $this->google_model->searchBook($searchTerm);
        $this->loadHeader("Search Results");
        $this->load->view('addBook');
        $this->load->view('googleSearchResults', $data);
        $this->load->view('template/footer');
    }

    public function reviewBook() {
        $this->load->model('login_model');
        $this->load->model('review_model');
        $user = $this->login_model->getCurrentUser();
        if ($user!=null) {
            $userId = $user->id;
            $bookId = $this->input->post('book');
            $rank = $this->input->post('rank');
            $review = $this->input->post('review');
            $this->review_model->addReview($userId, $bookId, $rank, $review);
        }
        $this->book($bookId);
    }

    public function addBook($googleBookId) {
        $this->load->model('login_model');
        $this->load->model('book_model');
        $this->load->model('google_model');
        $user = $this->login_model->getCurrentUser();
        if ($user!=null) {
            $userId = $user->id;
            //$book = $this->google_model->getBookDetails($googleBookId);
            $data['bookDetails'] = $this->book_model->addBookToUserByGoogleId($userId, $googleBookId);
            $this->myBookshelf();
        }
    }


    public function removeBook($bookId) {
        $this->load->model('login_model');
        $this->load->model('book_model');
        $this->load->model('google_model');
        $user = $this->login_model->getCurrentUser();
        $userId = $user->id;
        $this->book_model->removeBookFromUser($userId, $bookId);
        $this->myBookshelf();
    }

    public function loanBook($bookId, $ownerUserId) {
        $this->load->model('login_model');
        $this->load->model('loan_model');
        //$this->load->model('facebook_model');
        $user = $this->login_model->getCurrentUser();
        if ($user!=null) {
            $userId = $user->id;
            $this->loan_model->requestBookLoan($ownerUserId, $userId, $bookId);
            $this->loan_model->notifyRequest($ownerUserId, $bookId, $userId);
            $this->myBookshelf(); // should route to loans page, when it will be exist
        }
    }

    public function newsfeed()
    {
        $this->load->model('login_model');
        $this->load->model('newsfeed_model');

        $this->loadHeader("News Feed");
        $user = $this->login_model->getCurrentUser();
        if ($user!=null) {
            $data['result'] = $this->newsfeed_model->getNewsFeedBooks($user->id);
            $this->load->view('newsfeed',$data);
        }
        $this->load->view('template/footer');
    }

    private function loadHeader($title) {
        $this->load->model('login_model');
        $this->load->model('facebook_model');
        $user = $this->login_model->getCurrentUser();

        if ($user!=null)
        {
            $dataHeader['username'] = $user->name;
            $dataHeader['loggedIn'] = true;
        }
        else
        {
            $dataHeader['username'] = "login";
            $dataHeader['loggedIn'] = false;
        }
        $dataHeader['fbLogin'] = $this->facebook_model->getLoginUrl();
        $dataHeader['title'] = $title;
        $this->load->view('template/header',$dataHeader);
    }

    public function test_addBook() {
        $this->load->model('book_model');
        $this->book_model->test_addBook();
    }

    public function test_Google_Model() {
        $this->load->model('google_model');
        $searchResults = $this->google_model->searchBook("war and peace");
        print_r($searchResults);
        print_r("<BR><BR>");
        print_r($searchResults[1]);
    }
}

