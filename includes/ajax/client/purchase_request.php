<?php

    include("../../../init.php");

        
    if( isset( $_POST["purchase_request"] ) ){

        create_session( "purchase_request" , ture );
        
    }else{
        header("Location: ../../../index.php");
        exit();
    }
