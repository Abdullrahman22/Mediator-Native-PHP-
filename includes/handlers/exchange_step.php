<?php


    if( !isset( $_SESSION["loginUserID"] ) ){
        header("Location: login.php");
    }

    if( !isset( $_SESSION["exchane_info"] ) ){
        header("Location: choose_method.php");
    }

    $exchane_info  =  $_SESSION["exchane_info"] ;
    $send          =  $exchane_info["method_1"];
    $send_row      =  getPaymentInfo($send);
    $receive       =  $exchane_info["method_2"];
    $receive_row   =  getPaymentInfo($receive);


    if( isset($_POST["exchange_step_btn"]) ){

        $money_1   = security($_POST['send']);
        $money_2   = security($_POST['receive']);

        $money_1_status = $money_2_status = 1;

        //===================== money_1 Validation ==============================
        if( $money_1 <  $send_row["minimum"] ){
            $money_1_error = lang("Send money must be over a minimum amount");
            $money_1_status = "";
        }
        //===================== money_2 Validation ==============================
        if( $money_2 <  $receive_row["minimum"] ){
            $money_2_error = lang("receive money must be over a minimum amount");
            $money_2_status = "";
        }

        //===================== Save in sessions ==============================
        if( !empty($money_1_status) && !empty($money_2_status)  ){

            
            //=========== create transfer id ===========
            $text = "ABCD";
            $text = str_shuffle( $text );
            $text = substr( $text , 0 , 1 );
            $transfer_id = rand( 1000  , 100000000 );
            $transfer_id = $text . $transfer_id ;
            
            $exchane_info["transfer_id"] = $transfer_id ;

            $exchane_info["money_1"] = $money_1;
            $exchane_info["money_2"] = $money_2;
    
            $_SESSION["exchane_info"] = $exchane_info ;
                        
            header("Location: exchange_step2.php");
            exit();

        }



    }

?>