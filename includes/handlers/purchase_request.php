<?php

    /*===== check if isset purchase_request =========*/
    if( !isset( $_SESSION["loginUserID"] ) ||  !isset( $_SESSION["purchase_request"] )  ){
        header("Location: login.php");
    }else{
        /*===== check there transferid $_GET =========*/
        if( isset( $_GET["transferid"] ) ){
            $transferid = security( $_GET["transferid"] );
        }else{
            /*===== check there transferid in DB =========*/
            if( checkTransferExist( $transferid ) == 0 ){
                header("Location: index.php");
            }
        }
    }


    if( isset($_POST["purchase_request_btn"]) ){

        $phone       = security($_POST['phone']);
        $wallet      = security($_POST['wallet']);
        $details     = security($_POST['details']);
        $agreement_accepted = security($_POST['agreement_accepted']);


        $img_name           = $_FILES["img"]["name"] ;
        $img_name_rand      = rand(0 , 1000) . "_" . $img_name;
        $tmp_name           = $_FILES["img"]["tmp_name"] ;
        $store_files        = "assets/images/proof-images";
        $extentions         = array("jpg" ,"png" , "jpeg" , "ico");
        $get_file_extention = explode("." , $img_name);
        $get_extention      = strtolower( end($get_file_extention) ) ;



        $phone_status = $wallet_status = $details_status = $img_status = $agreement_accepted_status = 1 ;
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

        //===================== details Validation ==============================
         if( $details == "" ){
            $details_error =  lang("details is empty");
            $details_status = "";

        }else{
            if(strlen($details) > 240 || strlen($details) < 5 ){
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

        //===================== Update Exchage in DB  ==============================
        if( !empty($phone_status) && !empty($wallet_status) && !empty($details_status) && !empty($img_status) && !empty($agreement_accepted_status)  ){

            fix_rotate_jpg_image($tmp_name);
            move_uploaded_file( $tmp_name , "$store_files/$img_name_rand");

            $stmt = $con->prepare("UPDATE
                                        exchanges
                                    SET
                                        `phone_2` = ? , `wallet_2` = ? , `proof_2` = ? ,  `details_2` = ? , `accepted` = 1
                                    WHERE
                                        transfer_id = ?");
            $stmt->execute(array( $phone, $wallet, $img_name_rand , $details, $transferid ));
            if( $stmt->rowCount() != 1 ){
                header("Location: index.php");
                exit();
            }else{


                $stmt2 = $con->prepare("UPDATE
                                        notifications
                                    SET
                                        `accepted` = 1 
                                    WHERE
                                        transfer_id = ?");
                $stmt2->execute(array($transferid ));
                if( $stmt2->rowCount() > 0  ){

                    create_session( "transfer_done" , true ); 
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