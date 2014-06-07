<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 18/04/14
 * Time: 21:07
 */

class facebook_model extends CI_Model {

    /*
     * Constructor
     * Loads facebook API
     */
    public function facebook_model() {
        parent::__construct();
        parse_str( $_SERVER['QUERY_STRING'], $_REQUEST );
        $CI = & get_instance();
        $CI->config->load("facebook",TRUE);
        $config = $CI->config->item('facebook');
        $this->load->library('Facebook', $config);
    }

    public function logout()
    {
        $this->facebook->destroySession();     
    }
    public function getFacebookId() {
        $facebookId = $this->facebook->getUser();
        return $facebookId;
    }

    public function getLoginUrl() {
        //return ""; // for test
        $userId = $this->facebook->getUser();
        if($userId == 0)
            return $this->facebook->getLoginUrl(array('scope'=>'email,user_friends'));
        $params = array("next" => base_url("user/logout"));
        return $this->facebook->getLogoutUrl($params);
    }

    public function getBasicInfo() {
        if($this->facebook->getUser() != 0)
            return $this->facebook->api('/me?fields=name,email');

        // fake data
        return array(
            "name" => "Shai (fake) Fisher",
            "email" => "shai.fisher@gmail.com",
            "id" => "676039134",
        );
    }


    public function getFriends() {
        //return $this->getFakeFriends(); // for test
        $userId = $this->facebook->getUser();
        if($userId != 0) {
            $temp = $this->facebook->api('/me/friends');
            return $temp["data"];
        }
        return $this->getFakeFriends();
    }

    public function getUser()
    {
        $user = $this->facebook->getUser();
        if ($user) {
            try {
                $data['user_profile'] = $this->facebook
                    ->api('/me');
            } catch (FacebookApiException $e) {
                $user = null;
            }
        }
       return $user;
    }

    public function getSomeFriends($numOfFriends)
    {
        $allFriends = $this->getFriends();
        $friends = array();

        $start = rand(0, count($allFriends));
        for ($i = 0; $i<$numOfFriends; $i++) {
            $j = ($start + $i) % count($allFriends);
            $friends[$i] = $allFriends[$j];
        }
        return $friends;
    }

    public function getPictureUrl($id) {
        return "http://graph.facebook.com/" + $id + "/picture?type=large";
    }

    public function sendNotification($userId, $text, $url) {
        try {
            $answer = $this->facebook->api( '/'.$userId.'/notifications', 'POST', array(
                'template' =>  $text,
                'href' =>  $url,
                'access_token' => $this->facebook->getAppId().'|'.$this->facebook->getApiSecret()
            ));
            //print_r($answer);
        } catch (FacebookApiException $e) {
            print_r($e);
        }
    }
}