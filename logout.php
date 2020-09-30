<?php

    include ("init.php");

    if( isset( $_COOKIE['email'] ) ){
        setcookie("email" , $email , time() - 60*60*24*5 , '/');    // cookie for 5 days 
    }

    session_unset();
    session_destroy();
    header("location: login.php");

    exit();