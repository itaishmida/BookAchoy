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
    public function getLoginUrl() {
        //return ""; // for test
        $userId = $this->facebook->getUser();
        if($userId == 0)
            return $this->facebook->getLoginUrl(array('scope'=>'email,user_friends'));
        $params = array("next" => base_url("user/logout"));
        return $this->facebook->getLogoutUrl($params);
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

    private function getFakeFriends()
    {
        $friends = array(
            "data" => array(
                0 => array(
                    "name" => "Adi Mizrahi1‎‏‏",
                    "id" => "541032350"
                ),
                1 => array(
                    "name" => "Itai Shmida",
                    "id" => "100000617083781"
                ),
                2 => array(
                    "name" => "Shlomit Bar-Levav",
                    "id" => "516858663"
                ),
                3 => array(
                    "name" => "Shai Fisher",
                    "id" => "676039134"
                ),
                4 => array(
                    "name" => "Mor Hasson",
                    "id" => "1093670109"
                ),
                5 => array(
                    "name" => "Uri Abeles",
                    "id" => "661510087"
                ),
                6 => array(
                    "name" => "Yael Bresler‎‏‏",
                    "id" => "825014312"
                ),
                7 => array(
                    "name" => "Shiran Mor Yosef",
                    "id" => "1314034435"
                ),
                8 => array(
                    "name" => "Yosi Bar-niv",
                    "id" => "100000190638748"
                ),
                9 => array(
                    "name" => "Rotem Benjamin",
                    "id" => "100007678632235"
                ),
                10 => array(
                    "name" => "To Sha",
                    "id" => "1765676322"
                ),
                11 => array(
                    "name" => "Kobi Eliasi",
                    "id" => "1111720418"
                )
            )
        );
        return $friends["data"];
    }

    public function getPictureUrl($id) {
        return "http://graph.facebook.com/" + $id + "/picture?type=large";
    }
}