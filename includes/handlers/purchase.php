<?php

    
    if( !isset( $_SESSION["loginUserID"] ) ){
        header("Location: login.php");
    }else{
        $sessionId = $_SESSION["loginUserID"];
    }

    if( !isset( $_SESSION["purchase"] ) ){
        header("Location: index.php");
    }


    //================= Securty $_GET id ==========================

    if( isset($_GET["id"]) && is_numeric($_GET["id"]) ){
        $id = intval( $_GET["id"] );
    }else{
        $id = "0";
    }

    if( checkProductExist( $id ) == 0 ){
        header("Location: index.php");
    }

    //================= get product info by ( product id ) ==========================
    $user  = getUserInfo( $sessionId );

    //================= get product info by ( product id ) ==========================
    $product = getProductInfo( $id );

    //================= get Seller info by  (userid ) ==========================
    $seller = getUserInfo( $product["UserID"] );

    //================= get category info by ( name ) =========================
    $category = getPaymentInfo( $product["category"] );


    //================= create transfer id ==================
    $text = "ABCD";
    $text = str_shuffle( $text );
    $text = substr( $text , 0 , 1 );
    $transfer_id = rand( 1000  , 100000000 );
    $transfer_id = $text . $transfer_id ;




    //================= Form Validation ==================
    if( isset($_POST["purchase_btn"]) ){

        $payment            = security($_POST['payment']);
        $phone              = security($_POST['phone']);
        $wallet             = security($_POST['wallet']);
        $details            = security($_POST['details']);
        //================= img validation =======================
        $img_name           = $_FILES["img"]["name"] ;
        $img_name_rand      = rand(0 , 1000) . "_" . $img_name;
        $tmp_name           = $_FILES["img"]["tmp_name"] ;
        $store_files        = "assets/images/proof-images";
        $extentions         = array("jpg" ,"png" , "jpeg" );
        $get_file_extention = explode("." , $img_name);
        $get_extention      = strtolower( end($get_file_extention) ) ;
        //==========================================================
        $agreement_accepted = security($_POST['agreement_accepted']);


        $phone_status = $wallet_status = $agreement_accepted_status = $details_status = $img_status = $payment_status =  1;

        //===================== payment Validation ==============================
        if( $payment == "0" || $payment == ""  ){
            $payment_error = lang("You must choose your payment method");
            $payment_status = "";
        }else {
            if( checkRecord( "id" , "payment_methods" , $payment ) == 0  ){
                header("Location: index.php");
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


        //===================== details Validation ==============================
         if( $details == "" ){
            $details_error =  lang("details is empty");
            $details_status = "";

        }else{
            if(strlen($details) > 240 || strlen($details) < 20 ){
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

        
        //===================== Insert Purchase into DB  ==============================
        if( !empty($phone_status) && !empty($wallet_status) && !empty($agreement_accepted_status) && !empty($details_status) &&  !empty($img_status) && !empty($payment_status)  ){

            

              

            /*====== extract vars from DB array =====*/
            $transfer_id    ;
            $sellerId     =  $seller["UserID"];
            $email_1      =  $user["Email"];
            $phone_1      =  $phone;
            $money_1      =  $product["amount_paid"];
            $method_1     = $payment ;
            $wallet_1     =  $wallet;
            $details_1    =  $details;
            $email_2      =  $seller["Email"];
            $money_2      =  $product["amount"];
            $method_2     =  $category["id"];
            $product_id   =  $product["id"];



            /*=================== notify user =====================*/
            $sessionId ;
            $sellerId ;
            $type   = "purchase_request";


            $stmt = $con->prepare(" INSERT INTO 
                        notifications ( `type` , `sender` , `receiver` , `transfer_id` )
                        VALUES( :ztype , :zsender , :zreceiver , :ztransfer_id )");
            $stmt->execute(array(
                ":ztype"          => $type,
                ":zsender"        => $sessionId,
                ":zreceiver"      => $sellerId,
                ":ztransfer_id"   => $transfer_id
            ));
            if( $stmt->rowCount() != 1 ){
                header("Location: index.php");
                exit();
            }else{



                fix_rotate_jpg_image($tmp_name);
                move_uploaded_file( $tmp_name , "$store_files/$img_name_rand");

                /*====== Create Purchase =====*/
                $stmt2 = $con->prepare(" INSERT INTO 
                                exchanges ( `transfer_id` , `email_1` , `phone_1` , `money_1` , `proof_1` , `method_1` , `wallet_1` , `details_1` , `email_2`,  `money_2` , `method_2` , `product_id` )
                                VALUES( :ztransfer_id , :zemail_1 ,  :zphone_1 , :zmoney_1 , :zproof_1 , :zmethod_1 , :zwallet_1 , :zdetails_1 ,:zemail_2 ,  :zmoney_2 , :zmethod_2 , :zproduct_id   )");
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
                    ":zproduct_id"     => $product_id,
                ));


                if( $stmt2->rowCount() > 0  ){

                    create_session( "purchase_done" , $sellerId ); 
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