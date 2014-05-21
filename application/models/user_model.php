<?php
class User_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }


    function getUser($id) {
        $query = $this->db->query('SELECT * FROM user WHERE id = ' . $id);
        return $query->result_array();//array
    }

    function getAllUsers() {
        $query = $this->db->query('SELECT id, fbid, name FROM user');
        return $query->result_array();//array
    }

    function getUserByFacebookId($fbid) {
        //print_r('<BR>enter getUserByFacebookId');
        //print_r($fbid);
        $query = $this->db->query('SELECT * FROM user WHERE fbid = ' . $fbid);
        return $query->result();//array
    }

    function insertUser($facebook_user) {
        $this->db->query('INSERT INTO user (fbid, name, email, join_date) VALUES ("' . $facebook_user['id'] . '", "' . $facebook_user['name'] . '", "' . $facebook_user['email'] . '", "' . date('Y-m-d') . '"); ');
    }

    function getFriends($user) {
        $query = $this->db->query('SELECT * FROM user where id in (SELECT friend_id FROM users_friends WHERE user_id = ' . $user->id . ')');
        return $query->result();//array
    }

    function getAllFriends() {
        $query = $this->db->query('SELECT user_id, friend_id FROM users_friends');
        if ($query==null)
            return null;
        return $query->result();//array
    }

    /*
     * insert friendship between users and a list of friends
     */
    function updateFriends($user) {
        if ($user==null)
            return;
        $this->load->model('facebook_model');
        $facebook_friends = $this->facebook_model->getFriends();
        if (count($facebook_friends)==0)
            return;
        // filter users in DB
        $friends = $this->getUsersByFacebookIds($facebook_friends);
        if (count($friends)==0) {
            echo 'no friends left :(';
            return;
        }
        // prepare list
        $values = '';
        $userId = $user[0]->id;
        foreach ($friends as $friend) {
            $friendId = $friend->id;
            $values .= '("' . $userId . '", "' . $friendId . '"), ';
            $values .= '("' . $friendId . '", "' . $userId . '"), ';
        }
        // delete current friendships and insert the updated ones
        $queryStr = 'DELETE FROM users_friends WHERE user_id='.$userId.' OR friend_id='.$userId.';';
        $this->runQuery($queryStr);
        $queryStr = 'INSERT INTO users_friends (user_id, friend_id) VALUES ' . substr($values, 0, -2) . ';';
        $this->runQuery($queryStr);
    }

    function getUsersByFacebookIds($facebook_friends) {
        $facebook_ids = array(count($facebook_friends));
        foreach ($facebook_friends as $facebook_friend) {
            array_push($facebook_ids, $facebook_friend["id"]);
        }
        $queryStr = 'SELECT id FROM user WHERE fbid IN (' . implode(',',$facebook_ids) . ');';
        $query = $this->db->query($queryStr);
        return $query->result();
    }

    function runQuery($queryStr) {
        try {
            $this->db->query($queryStr);
        } catch (Exception  $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    function getFakeUser() {
        $fakeFacebookUser = array(
                "name" => "Shai Fisher (fake)‎‏‏",
                "email" => "shai.fisher@gmail.com",
                "fbid" => "676039134"
                );
        return $fakeFacebookUser;
    }

    function deleteUser($id) {
        $this->runQuery('DELETE FROM user WHERE id=' . $id);
        $this->runQuery('DELETE FROM user WHERE id="' . $id . '"');
    }

    /************************ Test Methods *********************************/

    function test_userInDB () {

    }
}