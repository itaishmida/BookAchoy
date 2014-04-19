<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 18/04/14
 * Time: 21:07
 */

class facebook_model extends CI_Model {

    function get_friends()
    {
        $x = array(
            "shay" => "123987123",
            "adi" => "0921397123"
        );

        return $x;//array
    }
}