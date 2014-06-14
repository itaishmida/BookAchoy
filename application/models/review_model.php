<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 13/06/14
 * Time: 21:23
 */

class review_model  extends CI_Model{

    function __construct()
    {
        parent::__construct();
    }

    function addReview($userId, $bookId, $rank, $review)
    {
        $row = array(
            "user_id" => $userId,
            "book_id" => $bookId,
            "rating" => $rank,
            "review_text" => $review
        );
        $this->db->insert('review', $row);
    }

    function getReviews($bookId) {
        if ($bookId == null)
            return null;
        $queryStr = 'SELECT * FROM review R NATURAL JOIN user U WHERE R.user_id=U.id AND book_id='.$bookId.';';
        $query = $this->db->query($queryStr);
        return $query->result();
    }
} 