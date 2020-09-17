<?php

/* 
 * This file auto starts the session
 * and provide some helper functions
 */

session_start();

/**
 * function checks that user is loggedin or not
 * return bool
 */
function isLoggedIn() {
    if(isset($_SESSION["id"]) &&
        
        isset($_SESSION["login_time"])
         ) {
        return TRUE;
    }
    return FALSE;
}
/**
 * this function accepts a key and return related data found in session
 * @param type $key
 * @return mixed
 */
function getSessionData($key) {
    if(isset($_SESSION[$key])){
        return $_SESSION[$key];
    }
    return "";
}
/**
 * starts the session
 * @param type $user_id
 * @param type $user_name
 * @param type $email
 * @param type $avatar
 */
function initiateSession ($user_id) {
    $_SESSION["id"] = $user_id;
    
    $_SESSION["login_time"] = time();
}
/**
 * end the current session
 */
function logout() {
    session_destroy();
}

?>
