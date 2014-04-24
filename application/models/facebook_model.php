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

    public function getLoginUrl() {
        return ""; // for test
        $userId = $this->facebook->getUser();
        if($userId == 0)
            return $this->facebook->getLoginUrl(array('scope'=>'email'));
        return "";
    }

    public function getFriends() {
        return $this->getFakeFriends(); // for test
        $userId = $this->facebook->getUser();
        if($userId != 0) {
            $temp = $this->facebook->api('/me/friends');
            return $temp["data"];
        }
        return "";
    }

    private function getFakeFriends()
    {
        $friends = array(
            "data" => array(
                0 => array(
                    "name" => "Ronen Kahana",
                    "id" => "507700025"
                ),
                1 => array(
                    "name" => "Sinai Oren",
                    "id" => "513846204"
                ),
                2 => array(
                    "name" => "Shlomit Bar-Levav",
                    "id" => "516858663"
                ),
                3 => array(
                    "name" => "Dotan Horovits",
                    "id" => "517292892"
                ),
                4 => array(
                    "name" => "Gefen Shoval",
                    "id" => "592783367"
                ),
                5 => array(
                    "name" => "Uri Abeles",
                    "id" => "661510087"
                )
            )
        );
        return $friends["data"];
    }

    public function getPictureUrl($id) {
        return "http://graph.facebook.com/" + $id + "/picture?type=large";
    }
}