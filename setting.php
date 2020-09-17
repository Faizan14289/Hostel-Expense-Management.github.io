<?php

    define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_NAME", "account_handling");


    function post_val($key)
    {
        if (isset($_POST[$key])) {
            return $_POST[$key];
        }
        return "";
    }
    
    function get_val($key)
    {
        if (isset($_GET[$key])) {
            return $_GET[$key];
        }
        return "";
    }

?>