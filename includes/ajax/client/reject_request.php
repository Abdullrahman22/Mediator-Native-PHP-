<?php

    include("../../../init.php");

        
    if( isset( $_POST["transferId"] ) ){


        $sessionId =  $_SESSION["loginUserID"]  ;
        $transferId = security(  $_POST["transferId"] ); 

        $stmt = $con->prepare("SELECT * FROM `notifications` WHERE transfer_id = ? AND receiver = ? LIMIT 1");
        $stmt->execute( array( $transferId  , $sessionId ) );
        if( $stmt->rowCount() > 0 ){

            $stmt2 = $con->prepare("UPDATE notifications SET `accepted` = 2 WHERE transfer_id = ? AND receiver = ? LIMIT 1");
            $stmt2->execute( array( $transferId  , $sessionId ) );
            if( $stmt->rowCount() > 0 ){
                echo 'success';
            }
            
        }else{
            echo 'error';
        }

        

    }else{
        header("Location: ../../../index.php");
        exit();
    }
