<?php

    include("../../../init.php");

        
    if( isset( $_POST["exchange_request"] ) ){

        create_session( "exchange_request" , ture );
        
    }else{
        header("Location: ../../../index.php");
        exit();
    }
