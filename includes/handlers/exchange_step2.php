<?php


    if( !isset( $_SESSION["loginUserID"] ) ){
        header("Location: login.php");
    }

    if( !isset( $_SESSION["exchane_info"] ) ){
        header("Location: exchange_step.php");
    }


    $exchane_info  =  $_SESSION["exchane_info"] ;
    $send          =  $exchane_info["method_1"];
    $send_row      =  getPaymentInfo($send);
    $receive       =  $exchane_info["method_2"];
    $receive_row   =  getPaymentInfo($receive);


    if( isset($_POST["exchange_step2_btn"]) ){


        $phone              = security($_POST['phone']);
        $wallet             = security($_POST['wallet']);
        $agreement_accepted = security($_POST['agreement_accepted']);
        
        $phone_status = $wallet_status = $agreement_accepted_status = $request_sent_status = 1;

        //===================== phone Validation ==============================
        if( empty( $phone ) ){
            $phone_error = lang("phone is required");
            $phone_status = ""; 
        }else {
            if(strlen($phone) > 30 || strlen($phone) < 5 ){
                $phone_error = lang("phone must be between 5 and 30 characters");
                $phone_status = "";   
            }
        }


        //===================== wallet Validation ==============================
        if( empty( $wallet ) ){
            $wallet_error = lang("account is required");
            $wallet_status = ""; 
        }else {
            if(strlen($wallet) > 30 || strlen($wallet) < 5 ){
                $wallet_error = lang("account must be between 5 and 30 characters");
                $wallet_status = "";   
            }
        }
        //===================== request sent Validation ==============================

        if( !isset( $_SESSION["friendid"] ) ){

            $request_sent_error = lang("You must sent transfer request") ;
            $request_sent_status = "";  
             
        }

        //===================== agreement_accepted Validation ==============================
        if( !isset( $agreement_accepted ) ){ 

            $agreement_accepted_error = lang("You must accept our agreement accepted");
            $agreement_accepted_status = "";   

        }else{
            if( $agreement_accepted != 1 ){
                $agreement_accepted_error = lang("You must accept our agreement accepted");
                $agreement_accepted_status = "";   
            }
        }

        //===================== insert into session array ==============================
        if( !empty($phone_status) && !empty($wallet_status) && !empty($agreement_accepted_status) && !empty($request_sent_status)  ){
    

            /* =========== Add to exchange info array ======*/
            $friendid = $_SESSION["friendid"] ;
            $row = getUserInfo($friendid) ;
            $exchane_info["friendid"]   = $friendid ;
            $exchane_info["email_2"]    = $row["Email"];

            $exchane_info["phone_1"]    = $phone;
            $exchane_info["wallet_1"]   = $wallet;


            $_SESSION["exchane_info"] = $exchane_info ;
                        
            header("Location: exchange_step3.php");
            exit();

        }
    }

?>