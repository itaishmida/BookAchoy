<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 07/06/14
 * Time: 15:51
 */

class loan_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function requestBookLoan($loanFromUserId, $loanToUserId, $bookId) {

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

    function getLoansFrom($userId) {
        $queryStr = 'SELECT * FROM loans WHERE friend_id='.$userId.';';
        $query = $this->db->query($queryStr);
        return $query->result();
    }

    function getLoansTo($userId) {
        $queryStr = 'SELECT * FROM loans WHERE user_id='.$userId.';';
        $query = $this->db->query($queryStr);
        return $query->result();
    }

    function notifyRequest($userId, $bookId, $demanderUserId) {
        $this->load->model('book_model');
        $this->load->model('user_model');
        $this->load->model('facebook_model');
        $bookName = $this->book_model->getBook($bookId)['name'];
        $demanderName = $this->user_model->get_user($demanderUserId)->name;
        $userFBId = $this->user_model->get_user($userId)->fbid;
        $message = $demanderName.' is asking you to loan him the book "'.$bookName.'".';
        $bookUrl = "/page/book/".$bookId;
        $this->facebook_model->sendNotification($userFBId, $message, $bookUrl);
    }
} 