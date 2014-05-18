<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 24/04/14
 * Time: 21:36
 */

class book_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }



    public function getFakeBooks()
    {
        $books = array(
            0 => array(
                "name" => "סיכום ביניים",
                "author" => "דוד אבידן",
                "googleBooksId" => "qYcdAAAAIAAJ",
                "picUrl" => "http://bks2.books.google.co.il/books?id=qYcdAAAAIAAJ&printsec=frontcover&img=1&imgtk=AFLRE70VW5wcR87EV6g2VUrtCR1Tks98Jft0IbXU9L1jfEF2aSxUlJhbudguTEmImOVeOzNWdHt6U6U6bqTBUXmv_lITekk2K81_eZ9p-gIgU3IIdQ9_GaM"
            ),
            1 => array(
                "name" => "דמי מפתח",
                "author" => "יהלי סובול",
                "googleBooksId" => "Vqq03MSd7QsC",
                "picUrl" => "http://bks1.books.google.co.il/books?id=Vqq03MSd7QsC&printsec=frontcover&img=1&imgtk=AFLRE72jcn3E2eqxBp_FNWbfJ04QSIiscyqU39fjOo1M26QJTr4XqhcBTbsQ5F8PzdBZzVv6P17RNcvMNZROopboo7-9BnaPdPImJpcEItvYb0IOLxrQnzpvCR71HX4xsw5uoQYtlzOy"
            ),
            2 => array(
                "name" => "סיפור על אהבה וחושך",
                "author" => "עמוס עוז",
                "googleBooksId" => "YD_IqvIbjkUC",
                "picUrl" => "http://bks0.books.google.co.il/books?id=YD_IqvIbjkUC&printsec=frontcover&img=1&edge=curl&imgtk=AFLRE71sVh-_D-ApUZco1Yqq2k6gYN4j93V_jlatVE6ovHdP25oxYsIpNhIVVnkCc08MQqVtYnc715JlFYI2QFDOwLmBTI4rWDgBi76D8H58rt2Vv_h8GrRG_3z7yHz8-QQJBpl95fMG"
            ),
            3 => array(
                "name" => "ארבעה בתים וגעגוע",
                "author" => "אשכול נבו",
                "googleBooksId" => "jdJSk9QnjqcC",
                "picUrl" => "http://bks5.books.google.co.il/books?id=jdJSk9QnjqcC&printsec=frontcover&img=1&imgtk=AFLRE71XGgl5a5ti2rLWEtHmBL5p4y7wSptdepxJlBJoWBqfGuyFhnG4j5RKv2NqNDo3OyAfR5yXN7_40Pocb65Ay-xEN3kt3Ylz-UD30hCEngKe5RDB9T15_5FirYTu3qIHUrcMPnVH"
            ),
            4 => array(
                "name" => "אם יש גן עדן",
                "author" => "רון לשם",
                "googleBooksId" => "a8-RcuGzYRUC",
                "picUrl" => "http://bks9.books.google.co.il/books?id=a8-RcuGzYRUC&printsec=frontcover&img=1&imgtk=AFLRE73ECLO8RFXhY_jycIqg-do32FPiUOO2WNzogZEMAwqnk_St86onODrHhJrMpx9lQE9U8wY-Ow46h1vqmx2lvT1Jadoqu_DrMq_PSc3s6kmYef36Y9KzwzX4Pye0NospTQVibm1J"
            ),
            5 => array(
                "name" => "אשתו של הנוסע בזמן",
                "author" => "אודרי ניפנגר",
                "googleBooksId" => "VYUAu9X_LywC",
                "picUrl" => "http://bks0.books.google.co.il/books?id=VYUAu9X_LywC&printsec=frontcover&img=1&imgtk=AFLRE72xsNf2NPnfW0cykRTtmDyb5s7I3_kqrW1sTMC5PUHKET0IXSDY3p9d_8VtrJj56ny77IB3ICaY2wCAtzPKzgWDAAyYeQOJP5JqwFe1GgcsY15S7ktLD1NhhU0eJpo5bA9-Cj5Y"
            ),
            6 => array(
                "name" => "הידרומניה",
                "author" => "אסף גברון",
                "googleBooksId" => "7EgLAQAAMAAJ",
                "picUrl" => "http://bks6.books.google.co.il/books?id=7EgLAQAAMAAJ&printsec=frontcover&img=1&imgtk=AFLRE71BA0KyEvi0EHlTCkFJU9VvL8ZPByEu5kEXwkV1K3nfnJOYSTM63w4DiZ6McILEzxngME8GlvNsJKtkvWXgPhyMq15pzWnLD5fCZvUiaocM7QZSO9s"
            ),
            7 => array(
                "name" => "בשבילה גיבורים עפים",
                "author" => "אמיר גוטפרוינד",
                "googleBooksId" => "FUoLAQAAMAAJ",
                "picUrl" => "http://bks2.books.google.co.il/books?id=FUoLAQAAMAAJ&printsec=frontcover&img=1&imgtk=AFLRE70jurjJEqx4YP3akhXI_eHDXkzWEqoxAzuTHTvlJhs7xa8mlNgN7ewcdExbleVYdAR-7gizwOMrVEspmuYrishxpy_CFlDxttsjeEp6OcvBLxtMmVk"
            ),
            8 => array(
                "name" => "יונה ונער",
                "author" => "מאיר שלו",
                "googleBooksId" => "MjsOAAAAYAAJ",
                "picUrl" => "http://bks8.books.google.co.il/books?id=MjsOAAAAYAAJ&printsec=frontcover&img=1&imgtk=AFLRE71uc4_9F4NE37g-GorTC1TbaWqHgkD7Xypys8bHzkZEIB7chw96dTmvygLluOMS3kz7p-aEO5sfa8LsBiCzwTV0LTv4Wk5V62s9Yku6vX42DoK-PYE"
            ),
            9 => array(
                "name" => "עולם חדש, מופלא",
                "author" => "אלדוס האקסלי",
                "googleBooksId" => "GXG1C_7J91IC",
                "picUrl" => "http://bks2.books.google.co.il/books?id=GXG1C_7J91IC&printsec=frontcover&img=1&imgtk=AFLRE715O8RC94EepOsTygh-FN4UduyQyKOWFordIEzhfko8zivtDAP4WrgSqXZ4lD9VBBihSQarqADZjzGBDDdjLxu___LWFql-9AnLceBwrMQ3BBSxlcQyF77eBbiNfBWw4zt70g32"
            ),
            10 => array(
                "name" => "קפקא על החוף",
                "author" => "הרוקו מורקמי",
                "googleBooksId" => "am-w2EDj0mEC",
                "picUrl" => "http://bks2.books.google.co.il/books?id=am-w2EDj0mEC&printsec=frontcover&img=1&edge=curl&imgtk=AFLRE73fswmf2hd-2KkLGGMFlMblsoDyM_KsZm7nRGrOUBlZqBkJJSvhnfZx2dGm5qn9AQQyjvC9kgHYhSykHuKhJ11ZgvY_yTXnEo1ChBPRz0DG6JO2FJXNjSm4jDT1I5XHrlvLTgpb"
            ),
            11 => array(
                "name" => "סולאריס",
                "author" => "סטניסלב לם",
                "googleBooksId" => "uMF7Nd52SdAC",
                "picUrl" => "http://bks1.books.google.co.il/books?id=uMF7Nd52SdAC&printsec=frontcover&img=1&edge=curl&imgtk=AFLRE715Y-wsompz8W-iptOm1QY4B-rKVMokZqubVGZdZ_R20AD2BCP3AX1i3PXsWJTUTUmAXZQkg78TKuqssI8Mm1k04YlZvda9boUY2cE-N1dMuqjNZXi3J54DB24QRlNZYoHjEeeM"
            )
        );
        return $books;
    }


    public function getFakeBook() {
        $books = $this->getFakeBooks();
        $i = rand(0, count($books)-1);
        $book = array(
            "name" => "סיפור על אהבה וחושך",
            "author" => "עמוס עוז",
            "picUrl" => "http://bks0.books.google.co.il/books?id=YD_IqvIbjkUC&printsec=frontcover&img=1&zoom=2&edge=curl&imgtk=AFLRE71JeyM-kCkokhV-SIZsX6lXCiYmzg7QLzgYUJOYcHKflkyu7l65BHHf9yePAXw60RaUAlmfdBizQsmfAozEz0uVOrT55tZfPMS_NjJfGaqPUmnp5AimSYCVHLnsLPD4-zRTY6p-",
            "googleBooksId" => "YD_IqvIbjkUC"
           // "owners" => $owners
        );
        return $books[$i];
    }

    public function insertFakeBooks($id) {
        $bookValues = '';
        $ownValues = '';
        $start = rand(0, 1000);
        for ($i=$start; $i<$start+3; $i++) {
            $bookValues .= '("' . $i . '", "Book' . $i . '", "Author' . $i . '", ""), ';
            $ownValues .= '("' . $id . '", "' . $i . '", "' . date('Y-m-d') . '", 0), ';
        }
        $this->runQuery('INSERT INTO book (id, name, author, genre) VALUES ' . substr($bookValues, 0, -2) . ';');

        $this->runQuery('INSERT INTO users_owned_books (user_id, book_id, added_date, status) VALUES ' . substr($ownValues, 0, -2) . ';');
    }

    public function getUserBooks($id) {
        $queryStr = 'SELECT * FROM book WHERE id IN (SELECT book_id from users_owned_books WHERE user_id=' . $id . ');';
        $query = $this->db->query($queryStr);
        //echo '<BR><BR>getUserBooks: ' . $queryStr . ': <BR>';
        //print_r($query->result());
        return $query->result();
    }


    function runQuery($queryStr) {
        try {
            $this->db->query($queryStr);
        } catch (Exception  $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    function getOwners($bookId) {
        $queryStr = 'SELECT * FROM user WHERE fbid IN (SELECT user_id FROM users_owned_books WHERE book_id=' . $bookId . ');';
        $query = $this->db->query($queryStr);
        //echo '<BR><BR>' . $queryStr . ': <BR>';
        //print_r($query->result());
        return $query->result();
    }
} 