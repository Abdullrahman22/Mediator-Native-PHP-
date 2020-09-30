<?php



    if( !isset( $_SESSION["exchane_info"] ) ){
        header("Location: exchange_step.php");
    }


    $exchane_info  =  $_SESSION["exchane_info"] ;
    $send          =  $exchane_info["method_1"];
    $send_row      =  getPaymentInfo($send);
    $receive       =  $exchane_info["method_2"];
    $receive_row   =  getPaymentInfo($receive);


    $money_1       =  $exchane_info["money_1"];
    $money_2       =  $exchane_info["money_2"];
    $email_2       =  $exchane_info["email_2"];
    $transfer_id   =  $exchane_info["transfer_id"];


    // var_dump( $exchane_info );

    if( isset($_POST["exchange_step3_btn"]) ){

        $details_1       = security($_POST['details']);


        $img_name           = $_FILES["img"]["name"] ;
        $img_name_rand      = rand(0 , 1000) . "_" . $img_name;
        $tmp_name           = $_FILES["img"]["tmp_name"] ;
        $store_files        = "assets/images/proof-images";
        $extentions         = array("jpg" ,"png" , "jpeg" , "ico");
        $get_file_extention = explode("." , $img_name);
        $get_extention      = strtolower( end($get_file_extention) ) ;


        $details_status = $img_status = 1 ;

        //===================== details_1 Validation ==============================
        if( $details_1 == "" ){
                $details_error =  lang("details is empty");
            $details_status = "";

        }else{
            if(strlen($details_1) > 240 || strlen($details_1) < 5 ){
                $details_error =   lang("details must be between 5 and 240 characters");
                $details_status = "";
            }
        }


        //===================== Img Validation ==============================
        if( empty( $img_name ) ){
            $img_error = lang("Upload photo is required");
            $img_status = ""; // make img_status  empty
        }else{ 
            if( !in_array( $get_extention ,  $extentions ) ) { 
                $img_error = lang("You must upload only photos");
                $img_status = ""; // make img_status  empty
            }
        }

        //===================== Insert into DB  ==============================
        
        if( !empty($details_status) && !empty($img_status) ){



            /*====== extract from session array =====*/
            $transfer_id   =  $exchane_info["transfer_id"];
            $friendid      =  $exchane_info["friendid"];
            $email_1       =  $exchane_info["email_1"];
            $phone_1       =  $exchane_info["phone_1"];
            $money_1       =  $exchane_info["money_1"];
            $method_1      =  $exchane_info["method_1"];
            $wallet_1      =  $exchane_info["wallet_1"];
            $email_2       =  $exchane_info["email_2"];
            $money_2       =  $exchane_info["money_2"];
            $method_2      =  $exchane_info["method_2"];


            /*====== notify user =====*/
            $userid = $_SESSION["loginUserID"];
            $type = "exchange_request";


            $stmt = $con->prepare(" INSERT INTO 
                        notifications ( `type` , `sender` , `receiver` , `transfer_id` )
                        VALUES( :ztype , :zsender , :zreceiver , :ztransfer_id )");
            $stmt->execute(array(
                ":ztype"          => $type,
                ":zsender"        => $userid,
                ":zreceiver"      => $friendid,
                ":ztransfer_id"   => $transfer_id
            ));
            if( $stmt->rowCount() != 1 ){
                header("Location: index.php");
                exit();
            }else{



                fix_rotate_jpg_image($tmp_name);
                move_uploaded_file( $tmp_name , "$store_files/$img_name_rand");

                /*====== Create exchange with 2 users =====*/
                $stmt2 = $con->prepare(" INSERT INTO 
                                exchanges ( `transfer_id` , `email_1` , `phone_1` , `money_1` , `proof_1` , `method_1` , `wallet_1` , `details_1` , `email_2`,  `money_2` , `method_2` )
                                VALUES( :ztransfer_id , :zemail_1 , :zphone_1 , :zmoney_1 , :zproof_1 , :zmethod_1 , :zwallet_1 , :zdetails_1 ,:zemail_2 , :zmoney_2 , :zmethod_2   )");
                $stmt2->execute(array(
                    ":ztransfer_id"    => $transfer_id,
                    ":zemail_1"        => $email_1,
                    ":zphone_1"        => $phone_1,
                    ":zmoney_1"        => $money_1,
                    ":zproof_1"        => $img_name_rand,
                    ":zmethod_1"       => $method_1,
                    ":zwallet_1"       => $wallet_1,
                    ":zdetails_1"      => $details_1,
                    ":zemail_2"        => $email_2,
                    ":zmoney_2"        => $money_2,
                    ":zmethod_2"       => $method_2,
                ));


                if( $stmt2->rowCount() > 0  ){

                    create_session( "exchange_done" , true ); 
                    header("Location: transfer_done.php");
                    exit();

                }else{
                    header("Location: index.php");
                    exit();
                }

            }

        }
        
        
    }

?>