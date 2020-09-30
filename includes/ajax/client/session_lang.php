<?php

    include("../../../init.php");

        
    if( isset( $_POST["lang"] ) ){

        $lang = $_POST["lang"];
        create_session( "language" , $lang );
        echo 'success';
    }else{
        header("Location: ../../../index.php");
        exit();
    }
