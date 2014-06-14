<?php

/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 07/06/14
 * Time: 15:51
 */
class loan_model extends CI_Model
{
    // IMPORTANT!
    // User Id is the user who got the book.
    // Friend Id is the user who gave the book.

    function __construct()
    {
        parent::__construct();
    }

    function isBookAlreadyLoaned($loanFromUserId, $loanToUserId, $bookId)
    {
        $queryStr = 'SELECT CASE count(*) WHEN 0 THEN FALSE ELSE TRUE END as isLoaned FROM loans WHERE friend_id=' . $loanFromUserId . ' AND user_id=' . $loanToUserId . ' AND book_id=' . $bookId . ';';
        $query = $this->db->query($queryStr);
        $result = $query->result();
        return (bool)($result[0]->isLoaned);
    }

    function requestBookLoan($loanFromUserId, $loanToUserId, $bookId)
    {
        // User Id is the user who got the book.
        // Friend Id is the user who gave the book.
        $curTime = time();
        $mysqlCurTime = date("Y-m-d H:i:s", $curTime);
        $row = array(
            "user_id" => $loanToUserId,
            "friend_id" => $loanFromUserId,
            "book_id" => $bookId,
            "request_date" => $mysqlCurTime
        );
        $this->db->insert('loans', $row);
    }

    function confirmBookLoan($loanToUserId, $loanFromUserId, $bookId)
    {
        $curTime = time();
        $dueTime = strtotime('+1 month', $curTime);
        $curTime = time();
        $mysqlCurTime = date("Y-m-d H:i:s", $curTime);
        $mysqlDueTime = date("Y-m-d H:i:s", $dueTime);
        $row = array(
            "loan_date" => $mysqlCurTime,
            "due_date" => $mysqlDueTime
        );
        $this->db->where('friend_id', $loanFromUserId);
        $this->db->where('user_id', $loanToUserId);
        $this->db->where('book_id', $bookId);
        $this->db->update('loans', $row);
    }

    function deleteLoan($loanToUserId, $loanFromUserId, $bookId)
    {
        $this->db->where('friend_id', $loanFromUserId);
        $this->db->where('user_id', $loanToUserId);
        $this->db->where('book_id', $bookId);
        $this->db->delete('loans');
    }

    function getLoansTo($userId)
    {
        // User Id is the user who got the book.
        // Friend Id is the user who gave the book.
        $queryStr = 'SELECT b.id as book_id,b.google_id,b.name as book_name,b.author,l.user_id as userId, l.friend_id as friendId, l.loan_date,l.due_date,l.request_date, u.name as friendName,u.fbid as friendFBid FROM loans l JOIN book b ON b.id = l.book_id JOIN user u ON u.id = l.friend_id WHERE l.user_id=' . $userId . ';';
        $query = $this->db->query($queryStr);
        return $query->result();
    }

    function getLoansFrom($userId)
    {
        // User Id is the user who got the book.
        // Friend Id is the user who gave the book.
        $queryStr = 'SELECT b.id as book_id,b.google_id,b.name as book_name,b.author,l.user_id as userId,l.loan_date,l.due_date,l.request_date, u.name as userName,u.fbid as userFBid FROM loans l JOIN book b ON b.id = l.book_id JOIN user u ON u.id = l.user_id WHERE l.friend_id=' . $userId . ';';
        $query = $this->db->query($queryStr);
        return $query->result();
    }

    function notifyRequest($userId, $bookId, $demanderUserId)
    {
        $this->load->model('book_model');
        $this->load->model('user_model');
        $this->load->model('facebook_model');
        $bookName = $this->book_model->getBook($bookId)->name;
        $demanderFBId = $this->user_model->get_user($demanderUserId)->fbid;
        $userFBId = $this->user_model->get_user($userId)->fbid;
        $message = '@[' . $demanderFBId . '] is asking you to loan him the book "' . $bookName . '".';
        $bookUrl = "page/book/" . $bookId;
        $this->facebook_model->sendNotification($userFBId, $message, $bookUrl);
    }

    function notifyLoanConfirmation($userId, $bookId, $demanderUserId)
    {
        $this->load->model('book_model');
        $this->load->model('user_model');
        $this->load->model('facebook_model');
        $bookName = $this->book_model->getBook($bookId)->name;
        $demanderFBId = $this->user_model->get_user($demanderUserId)->fbid;
        $userFBId = $this->user_model->get_user($userId)->fbid;
        $message = '@[' . $userFBId . '] confirmed your request to loan "' . $bookName . '".';
        $bookUrl = "page/book/" . $bookId;
        $this->facebook_model->sendNotification($demanderFBId, $message, $bookUrl);
    }

    function notifyLoanReturnConfirmation($userId, $bookId, $demanderUserId)
    {
        $this->load->model('book_model');
        $this->load->model('user_model');
        $this->load->model('facebook_model');
        $bookName = $this->book_model->getBook($bookId)->name;
        $demanderFBId = $this->user_model->get_user($demanderUserId)->fbid;
        $userFBId = $this->user_model->get_user($userId)->fbid;
        $message = '@[' . $userFBId . '] marked the book "' . $bookName . '" as returned.';
        $bookUrl = "page/book/" . $bookId;
        $this->facebook_model->sendNotification($demanderFBId, $message, $bookUrl);
    }
}