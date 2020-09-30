<?php

    if( !isset( $_SESSION["loginUserID"] ) ){
        header("Location: login.php");
    }


    $sessionId = $_SESSION["loginUserID"] ;

    $user = getUserInfo( $sessionId );






?>