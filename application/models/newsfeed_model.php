<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 24/04/14
 * Time: 21:36
 */

class newsfeed_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    public function getNewsFeedBooks($userId) {
        $queryStr = 'SELECT u.name AS friend_name,b.google_id,u.id AS friend_id,u.fbid AS friend_fbid,b.id AS book_id,b.name AS book_name,b.author AS book_author,uob.added_date AS book_added_date FROM users_friends as uf INNER JOIN users_owned_books as uob ON uf.friend_id = uob.user_id INNER JOIN book AS b ON uob.book_id = b.id INNER JOIN user AS u ON uf.friend_id = u.id WHERE uf.user_id = '.$userId.' GROUP BY uob.book_id HAVING count(uf.friend_id) > 0 ORDER BY uob.added_date DESC;';
        $query = $this->db->query($queryStr);
        //echo '<BR><BR>getUserBooks: ' . $queryStr . ': <BR>';
        //print_r($query->result());
        return $query->result();
    }

} 