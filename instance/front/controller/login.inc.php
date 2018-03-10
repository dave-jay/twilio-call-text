<?php

/**
 * Admin side Login file
 * 
 * 
 
 * @version 1.0
 * @package LySoft
 * 
 */
$login_error = '';
if ($_REQUEST['submit']) {
    if (($_REQUEST['email']) || $_REQUEST['email'] != '') {
        $user_name = _escape($_REQUEST['email']);
        $password = _escape($_REQUEST['password']);

        if (User::doLogin($user_name, $password)) {
            User::setSession($user_name);		
            $_SESSION['user']['tenant_id'] = $_SESSION['user']['id'];
            User::setConfig($_SESSION['user']['tenant_id']);            
        } else {
            //$error = "Invalid Login";
            $login_error = 1;
        }
    } else {
        //$error = "Invalid Login";
        $login_error = 1;
    }
}


if (isset($_SESSION['user'])) {
    _R(lr('call_report'));
}

//$login_action_url = lr('login');
$no_visible_elements = true;
$jsInclude = "login.js.php";

_cg("page_title", "Login");
?>