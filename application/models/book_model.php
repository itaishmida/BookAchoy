<?php

/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 24/04/14
 * Time: 21:36
 */
class book_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


    function getBook($id)
    {
        $books = $this->db->query('SELECT * FROM book WHERE id = ' . $id)->result_array();
        if ($books != null)
            return $books[0];
        return null;
    }

    function getBookByGoogleId($googleBookId)
    {
        $books = $this->db->query('SELECT * FROM book WHERE google_id="' . $googleBookId . '"')->result_array();
        if ($books != null)
            return $books[0];
        return null;
    }

    public function insertFakeBooks()
    {
        $books = array(
            0 => array(
                "name" => "Around the world in eighty days",
                "author" => "Jules Verne",
                "googleBooksId" => "SAoCAAAAQAAJ",
            ),
            1 => array(
                "name" => "Sanctuary",
                "author" => "Edith Wharton",
                "googleBooksId" => "WKLPETOoieIC",
            ),
            2 => array(
                "name" => "The Secret Garden",
                "author" => "Frances Hodgson Burnett",
                "googleBooksId" => "7GM4AAAAMAAJ",
            ),
            3 => array(
                "name" => "Penrod",
                "author" => "Booth Tarkington",
                "googleBooksId" => "zm8RAAAAYAAJ",
            ),
            4 => array(
                "name" => "Pollyanna",
                "author" => "Eleanor Hodgman Porter",
                "googleBooksId" => "v8IRAAAAYAAJ",
            ),
            5 => array(
                "name" => "Heidi",
                "author" => "Johanna Spyri",
                "googleBooksId" => "1G0jAAAAMAAJ",
            ),
            6 => array(
                "name" => "Little Women",
                "author" => "Arc Manor",
                "googleBooksId" => "MMwBZaorBHkC",
            ),
            7 => array(
                "name" => "Within the Song to Live",
                "author" => "Nathan Yonathan",
                "googleBooksId" => "vbNPkVVEYoYC",
            ),
            8 => array(
                "name" => "Ben and the bear",
                "author" => "Chris Riddell",
                "googleBooksId" => "qVkhHcbtXjIC",
            ),
            9 => array(
                "name" => "The Star of David and the War of Gog and Magog",
                "author" => "Joseph Shoshani",
                "googleBooksId" => "cxZllaF8gMYC",
            ),
            10 => array(
                "name" => "A Reliable Wife",
                "author" => "Robert Goolrick",
                "googleBooksId" => "q1EPx-ceN78C",
            ),
            11 => array(
                "name" => "Alexandra",
                "author" => "Valerie Martin",
                "googleBooksId" => "7cS_1K3HoMQC",
            )
        );
        $bookValues = '';
        foreach ($books as $book) {
            $bookValues .= '("' . $book['googleBooksId'] . '", "' . $book['name'] . '", "' . $book['author'] . '"), ';
        }
        $this->runQuery('INSERT INTO book (google_id, name, author) VALUES ' . substr($bookValues, 0, -2) . ';');
    }


    public function getFakeBook()
    {
        $books = $this->getFakeBooks();
        $i = rand(0, count($books) - 1);
        $book = array(
            "name" => "סיפור על אהבה וחושך",
            "author" => "עמוס עוז",
            "picUrl" => "http://bks0.books.google.co.il/books?id=YD_IqvIbjkUC&printsec=frontcover&img=1&zoom=2&edge=curl&imgtk=AFLRE71JeyM-kCkokhV-SIZsX6lXCiYmzg7QLzgYUJOYcHKflkyu7l65BHHf9yePAXw60RaUAlmfdBizQsmfAozEz0uVOrT55tZfPMS_NjJfGaqPUmnp5AimSYCVHLnsLPD4-zRTY6p-",
            "googleBooksId" => "YD_IqvIbjkUC"
            // "owners" => $owners
        );
        return $books[$i];
    }

    public function insertFakeBooksToUserBookshelf($id)
    {
        //$this->db->query('delete FROM users_owned_books');
        //$this->db->query('delete FROM book');
        $books = $this->db->query('SELECT * FROM book')->result();
        if ($books == null) {
            echo "no books";
            $this->insertFakeBooks();
            return;
        }
        //print_r($books);
        $book1 = $books[rand(0, count($books))];
        $book2 = $books[rand(0, count($books))];
        $ownValues = '("' . $id . '", "' . $book1->id . '", "' . date('Y-m-d') . '", 0), ';
        $ownValues .= '("' . $id . '", "' . $book2->id . '", "' . date('Y-m-d') . '", 0), ';

        $this->runQuery('INSERT INTO users_owned_books (user_id, book_id, added_date, status) VALUES ' . substr($ownValues, 0, -2) . ';');
    }

    public function getUserBooks($userId)
    {
        $queryStr = 'SELECT * FROM book WHERE id IN (SELECT book_id from users_owned_books WHERE user_id=' . $userId . ');';
        $query = $this->db->query($queryStr);
        //echo '<BR><BR>getUserBooks: ' . $queryStr . ': <BR>';
        //print_r($query->result());
        return $query->result();
    }


    function runQuery($queryStr)
    {
        try {
            $this->db->query($queryStr);
        } catch (Exception  $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    function getOwners($bookId)
    {
        if ($bookId == null)
            return null;
        $queryStr = 'SELECT * FROM user WHERE id IN (SELECT user_id FROM users_owned_books WHERE book_id=' . $bookId . ');';
        $query = $this->db->query($queryStr);
        //echo '<BR><BR>' . $queryStr . ': <BR>';
        //print_r($query->result());
        return $query->result();
    }

    function addBook($google_id, $name, $author, $isbn)
    {
        $book = $this->getBookByGoogleId($google_id);
        if ($book == null) {
            $row = array(
                "google_id" => $google_id,
                "name" => $name,
                "author" => $author,
                "isbn" => $isbn
            );
            $this->db->insert('book', $row);

            //$this->runQuery('INSERT INTO book (google_id, name, author, isbn) VALUES ("'.$google_id.'","'.$name.'","'.$author.'","'.$isbn.'");');
        }
    }

    function addBookToUser($userId, $bookId)
    {
        $own = $this->db->query('SELECT * FROM users_owned_books WHERE user_id=' . $userId . ' AND book_id=' . $bookId)->result();
        if ($own == null)
            $this->runQuery('INSERT INTO users_owned_books (user_id, book_id, added_date, status) VALUES ("' . $userId . '", "' . $bookId . '", "' . date('Y-m-d') . '", 0);');
    }

    function removeBookFromUser($userId, $bookId)
    {
        $this->db->query('DELETE FROM users_owned_books WHERE user_id=' . $userId . ' AND book_id=' . $bookId);
    }

    function addBookFromGoogle($googleBookId)
    {
        $this->load->model('google_model');

        $book = $this->getBookByGoogleId($googleBookId);
        if ($book == null) {
            $googleBook = $this->google_model->getBookDetails($googleBookId);
            if ($googleBook == null) {
                print_r("Book not found");
                return null;
            }
            // maybe the id that will return is different
            $book = $this->getBookByGoogleId($googleBook['google_id']);
            if ($book == null) {
                $this->addBook($googleBook['google_id'], $googleBook['name'], $googleBook['author'], $googleBook['isbn']);
                $book = $this->getBookByGoogleId($googleBook['google_id']);
            }
        }
        return $book['id'];
    }

    function addBookToUserByGoogleId($userId, $googleBookId)
    {
        $bookId = $this->addBookFromGoogle($googleBookId);
        if ($bookId == null)
            return;
        $this->addBookToUser($userId, $bookId);
    }

    function isOwnedby($bookId, $userId)
    {
        $owns = $this->db->query('SELECT * FROM users_owned_books WHERE user_id="' . $userId . '" AND book_id="' . $bookId . '"')->result();
        return (count($owns) > 0);
    }

    function requestBookLoan($loanFromUserId, $loanToUserId, $bookId)
    {
        $curTime = time();
        $dueTime = strtotime('+1 month', $curTime);
        $row = array(
            "user_id" => $loanToUserId,
            "friend_id" => $loanFromUserId,
            "book_id" => $bookId,
            "due_date" => $dueTime,
            "request_date" => $curTime
        );
        $this->db->insert('loans', $row);
    }

    function confirmBookLoan($loanFromUserId, $loanToUserId, $bookId)
    {
        $curTime = time();
        $row = array(
            "loan_date" => $curTime
        );
        $this->db->where('friend_id', $loanFromUserId);
        $this->db->where('user_id', $loanToUserId);
        $this->db->where('book_id', $bookId);
        $this->db->update('loans', $row);
    }


    function test_addBook()
    {
        $googleBookId = '3jfc-Fc1xdsC';

        // remove book from DB
        $book = $this->getBookByGoogleId($googleBookId);
        if ($book != null) {
            $this->db->query('DELETE FROM users_owned_books WHERE book_id="' . $book['id'] . '"');
            $this->db->query('DELETE FROM book WHERE google_id="' . $googleBookId . '"');
            $book = $this->getBookByGoogleId($googleBookId);
        }
        assert('$book==null');

        // test get details from google books
        $this->load->model('google_model');
        $googleBook = $this->google_model->getBookDetails($googleBookId);
        $name = 'Struggling Over Israel\'s Soul: An IDF General Speaks of His Controversial ...';
        $author = 'Elazar Stern';
        $isbn = 'ISBN9652295760';
        $assertion = assert('$googleBook[\'google_id\'] == $googleBookId');
        $assertion = assert('$googleBook[\'name\'] == $name');
        $assertion &= assert('$googleBook[\'author\'] == $author');
        $assertion &= assert('$googleBook[\'isbn\'] == $isbn');
        if ($assertion)
            print_r('<H2>Get book details from google: test success.</H2>');

        // test addition to db
        $bookId = $this->addBookFromGoogle($googleBookId);
        $assertion = assert($bookId != null);
        $book = $this->getBook($bookId);
        $assertion &= assert('$book[\'name\'] == $googleBook[\'name\']');
        $assertion &= assert('$book[\'author\'] == $googleBook[\'author\']');
        $assertion &= assert('$book[\'isbn\'] == $googleBook[\'isbn\']');
        if ($assertion)
            print_r('<H2>Add book to databse: test success.</H2>');

        // test add book to user
        $this->load->model('user_model');
        $user = $this->user_model->getFakeUser();
        $userId = $user->id;
        $this->addBookToUser($userId, $bookId);
        $books = $this->getUserBooks($userId);
        if (assert('$books[0]->id = $bookId'))
            print_r('<H2>Add book to User: test success.</H2>');

        // clean data
        $this->db->query('DELETE FROM users_owned_books WHERE book_id="' . $bookId . '"');
        $this->db->query('DELETE FROM book WHERE google_id="' . $googleBookId . '"');
    }
} 