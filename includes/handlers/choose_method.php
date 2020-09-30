<?php

        
    if( !isset( $_SESSION["loginUserID"] ) ){
        header("Location: login.php");
    }

    $userid = $_SESSION["loginUserID"] ;
    $user = getUserInfo( $userid );
    $email_1 = $user["Email"];
        
    if( isset($_POST["choose_method_btn"]) ){

        $receive_status = $send_status = 1;

        //===================== receive Validation ==============================
        $receive   = security($_POST['receive']);
        if( $receive == "0" || $receive == ""  ){
            $receive_error =  lang("Receive Payment Method is required");
            $receive_status = "";
        }


        //===================== send Validation ==============================
        $send   = security($_POST['send']);
        if( $send == "0" || $send == ""  ){
            $send_error =  lang("Send Payment Method is required");
            $send_status = "";
        }

        //===================== Save in sessions ==============================
        if( !empty($receive_status) && !empty($send_status)  ){

            if( checkRecord( "id" , "payment_methods" , $receive ) == 0  ){
                header("Location: index.php");
                exit();
            }else{
                if( checkRecord( "id" , "payment_methods" , $send ) == 0  ){

                    header("Location: index.php");
                    exit();

                }else {

                    $exchane_info =  array( 
                        "email_1" => $email_1 ,    
                        "method_1" => $send,    
                        "method_2" => $receive     
                    );
                    $_SESSION["exchane_info"] = $exchane_info ;
                    
                    header("Location: exchange_step.php");
                    exit();

                }
            }


        }
    }


?>