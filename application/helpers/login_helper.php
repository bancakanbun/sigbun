<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('CheckLogin'))
{
    function CheckAkses($level = "")
    {
        $ci =& get_instance();
        $authorized = false;
        $user = $ci->session->userdata("userinfo");

        if($user) $authorized = ($level == $user["type"]);

        return $authorized;
    }

    function CheckAksesGroup($level)   
    {
        $ci =& get_instance();
        $authorized = false;
        $user = $ci->session->userdata("userinfo");

        if($user) $authorized = (in_array($user["type"], $level));

        return $authorized;
    }

}