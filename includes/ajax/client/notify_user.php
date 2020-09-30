<?php

    include("../../../init.php");


    if( isset( $_POST["friendid"] ) && is_numeric($_POST["friendid"]) ){


        $userid   = $_SESSION["loginUserID"];
        $friendid = $_POST["friendid"];
        $type     = "transfer_request";

        
        /*====== check if user send notification to friend =======*/
        $stmt = $con->prepare(" SELECT * FROM `notifications` WHERE `sender` = ? AND `receiver` = ? AND `type` = ? LIMIT 1");
        $stmt->execute(array( $userid , $friendid , $type  ));
        if( $stmt->rowCount() > 0 ){

            echo "request_isset";

        }else{

            /*====== create $friendid session =======*/
            $_SESSION["friendid"] = $friendid  ;

            /*====== insert $friendid in $exchane_info session =======*/
            $exchane_info  =  $_SESSION["exchane_info"] ;
            $exchane_info["friendid"]  = $friendid;

            echo "request_sent";

        }


    }else{
        header("Location: ../../../index.php");
        exit();
    }
