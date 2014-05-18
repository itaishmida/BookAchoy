<?php
class User_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }


    function get_user($id) {
        $query = $this->db->query('SELECT * FROM user WHERE id = ' . $id);
        return $query->result_array();//array
    }

    function getUserByFacebookId($fbid) {
        $query = $this->db->query('SELECT * FROM user WHERE fbid = ' . $fbid);
        return $query->result();//array
    }

    function insertUser($user) {
        $now = date('Y-m-d');
        $this->db->query('INSERT INTO user (id, fbid, name, email, join_date) VALUES ("' . $user['id'] . '", "' . $user['id'] . '", "' . $user['name'] . '", "' . $user['email'] . '", "' . $now . '"); ');
    }

    function getFriends($user) {
        $query = $this->db->query('SELECT * FROM user where id in (SELECT friend_id FROM users_friends WHERE user_id = ' . $user["id"] . ')');
        return $query->result();//array
    }

    /*
     * insert friendship between users and a list of friends
     */
    function updateFriends($user) {
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
        foreach ($friends as $friend) {
            $values .= '("' . $user->id . '", "' . $friend->id . '"), ';
            $values .= '("' . $friend->id . '", "' . $user->id . '"), ';
        }
        // insert to DB
        $this->runQuery('INSERT INTO users_friends (user_id, friend_id) VALUES ' . substr($values, 0, -2) . ';');
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
        return get_user(999);
    }

    function updateFriendsFromFacebook() {

    }

    /************************ Test Methods *********************************/

    function test_userInDB () {

    }
}