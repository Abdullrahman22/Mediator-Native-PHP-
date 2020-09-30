<?php
   
    //==================== check session exist ===============================
    if( !isset( $_SESSION["loginUserID"] ) ){
        header("Location: login.php");
    }else{
        $sessionId = $_SESSION["loginUserID"] ;
    }

    //==================== check Gets ===============================
    if( isset($_GET["sellerid"]) && is_numeric($_GET["sellerid"]) ){
        $sellerId = intval( $_GET["sellerid"] );
    }else{
        $sellerId == 0 ;
    }

    //==================== check Seller in DB ===============================
    if( checkSellerIdExist( $sellerId ) == 0 ){
        header("Location: index.php");
    }

    /*======================= Get seller info  ==========================*/
    $seller = getUserInfo( $sellerId );

    
    $payments = getAllPayments();
    

    /*======================= edit info submition  ==========================*/
    if( isset($_POST["edit_info_btn"]) ){

        $address    = security($_POST['address']);
        $about      = security($_POST['about']);
        $facebook   = security($_POST['facebook']);
        $twitter    = security($_POST['twitter']);
        $instagram  = security($_POST['instagram']);


        $img_name           = $_FILES["img"]["name"] ;
        $img_name_rand      = rand(0 , 1000) . "_" . $img_name;
        $tmp_name           = $_FILES["img"]["tmp_name"] ;
        $store_files        = "assets/images/users-img/";
        $extentions         = array("jpg" ,"png" , "jpeg" , "ico");
        $get_file_extention = explode("." , $img_name);
        $get_extention      = strtolower( end($get_file_extention) ) ;




        $address_status = $about_status = $facebook_status = $twitter_status = $instagram_status = $img_status = 1 ;

        //===================== address Validation ==============================
        if( !empty( $address ) ){
        
            if(strlen($address) > 250 || strlen($address) < 4 ){
                $address_error = lang("address must be between 4 and 250 characters");
                $address_status = "";   
            }

        }


        //===================== about Validation ==============================
        if( !empty( $about ) ){
        
            if(strlen($about) > 250 || strlen($about) < 4 ){
                $about_error = lang("about me must be between 4 and 250 characters");
                $about_status = "";   
            }

        }


        //===================== facebook Validation ==============================
        if( !empty( $facebook ) ){
        
            if ( !filter_var($facebook, FILTER_VALIDATE_URL) ) {
                $facebook_error = lang("Not a valid url");
                $facebook_status = "";
            }else{
                if(strlen($facebook) > 250 || strlen($facebook) < 20 ){
                    $facebook_error = lang("facebook link me must be between 20 and 250 characters");
                    $facebook_status = "";   
                }
            }

        }


        //===================== twitter Validation ==============================
        if( !empty( $twitter ) ){
        
            if ( !filter_var($twitter, FILTER_VALIDATE_URL) ) {
                $twitter_error = lang("Not a valid url");
                $twitter_status = "";
            }else{
                if(strlen($twitter) > 250 || strlen($twitter) < 20 ){
                    $twitter_error = lang("twitter link me must be between 20 and 250 characters");
                    $twitter_status = "";   
                }
            }

        }


        //===================== instagram Validation ==============================
        if( !empty( $instagram ) ){
        
            if ( !filter_var($instagram, FILTER_VALIDATE_URL) ) {
                $instagram_error = lang("Not a valid url");
                $instagram_status = "";
            }else{
                if(strlen($instagram) > 250 || strlen($instagram) < 20 ){
                    $instagram_error = lang("instagram link me must be between 20 and 250 characters");
                    $instagram_status = "";   
                }
            }

        }

        

        //===================== Img Validation ==============================
        if( !empty( $img_name ) ){

            if( !in_array( $get_extention ,  $extentions ) ) { 
                $img_error = lang("You must upload only photos");
                $img_status = ""; // make img_status  empty
            }

        }

        //===================== Update info in DB  ==============================
        if( !empty($address_status) && !empty($about_status) && !empty($facebook_status) && !empty($twitter_status) && !empty($instagram_status) && !empty($img_status)  ){


            /*========== check if is image in DB =============*/
            if( empty( $img_name ) ){

                if( $seller["image"] == ''){
                    $img_name_upload = '' ;
                }else{
                    $img_name_upload = $seller["image"] ;
                }

            }else{

                fix_rotate_jpg_image($tmp_name);
                move_uploaded_file( $tmp_name , "$store_files/$img_name_rand");
                $img_name_upload = $img_name_rand;

            }





            $stmt = $con->prepare("UPDATE
                            users
                        SET
                            `address` = ? , `about` = ? , `facebook` = ? , `twitter` = ? , instagram = ? , `image` = ?
                        WHERE
                            UserID = ?");
            $stmt->execute(array( $address, $about , $facebook , $twitter , $instagram ,  $img_name_upload, $seller["UserID"]  ));


            if( $stmt->rowCount() > 0  ){
                create_session( "success_messege" , '<i class="fas fa-check"></i> successfully edit info' ); 
                header("Location: profile.php?sellerid=" . $seller["UserID"] );
                exit();

            }else{
                create_session( "failed_messege" , '<i class="fas fa-times"></i> Failed edit info' ); 
                header("Location: profile.php?sellerid=" . $seller["UserID"] );
                exit();
            }


        }
    }

    /*======================= edit Details submition  ==========================*/
    if( isset($_POST["edit_details_btn"]) ){


        $availabilty  = security($_POST['availabilty']);
        $phone        = security($_POST['phone']);


        $availabilty_status = $phone_status = 1 ;
        //===================== availabilty Validation ==============================
        if( !empty( $availabilty )  ){
            if(  $availabilty != 1 && $availabilty != 2 && $availabilty != 3 ){
                $availabilty_error = lang("please choose availabilty");
                $availabilty_status = "";  
            }
        }


        //===================== phone Validation ==============================
        if( !empty( $minimum ) ){
            
            if( !is_numeric( $phone ) ){
                $phone_error = lang("phone must be numbers");
                $phone_status = "";  
            }else{
                if(strlen($phone) > 30 || strlen($phone) < 5 ){
                    $phone_error = lang("phone must be between 30 and 5 characters") ;
                    $phone_status = "";  
                }
            }
        }



        //===================== Update info in DB  ==============================
        if( !empty($availabilty_status) && !empty($phone_status) ){

            
            $stmt = $con->prepare("UPDATE
                            users
                        SET
                            `availability` = ? , `num` = ? 
                        WHERE
                            UserID = ?");
            $stmt->execute(array( $availabilty, $phone , $seller["UserID"]  ));

            if( $stmt->rowCount() > 0  ){
                create_session( "success_messege" , '<i class="fas fa-check"></i> successfully edit details' ); 
                header("Location: profile.php?sellerid=" . $seller["UserID"] );
                exit();

            }else{
                create_session( "failed_messege" , '<i class="fas fa-times"></i> Failed edit details' ); 
                header("Location: profile.php?sellerid=" . $seller["UserID"] );
                exit();
            }

        }


    }

    /*======================= Add Product submition  ==========================*/
    if( isset($_POST["add_product_btn"]) ){


        $name         = security($_POST['name']);
        $category     = security($_POST['category']);
        $amount       = security($_POST['amount']);
        $desc         = security($_POST['desc']);

        
        //=================  Img  =======================
        $img_name           = $_FILES["img"]["name"] ;
        $img_name_rand      = rand(0 , 1000) . "_" . $img_name;
        $tmp_name           = $_FILES["img"]["tmp_name"] ;
        $store_files        = "assets/images/payment-methods/cards/";
        $extentions         = array("jpg" ,"png" , "jpeg" );
        $get_file_extention = explode("." , $img_name);
        $get_extention      = strtolower( end($get_file_extention) ) ;




        $name_status = $category_status = $amount_status = $accepted_status = $desc_status =  $img_status = 1 ;


        //===================== name Validation ==============================
        if( empty( $name ) ){
            $name_error = lang("title is required") ;
            $name_status = ""; // make email_status empty
        }else {
            if(strlen($name) > 30 || strlen($name) < 5 ){
                $name_error = lang("title must be between 5 and 30 characters") ;
                $name_status = "";   // make email_status  empty
            }
        }

        //===================== category Validation ==============================
        if( $category == "0" || $category == ""  ){
            $category_error =  lang("Payment Method is required") ;
            $category_status = "";
        }else{
            if( checkRecord( "id" , "payment_methods" , $category ) == 0  ){
                header("Location: index.php");
                exit();
            }
        }

        //===================== amount Validation ==============================
        if( empty( $amount ) ){
            $amount_error = lang("Amount is required") ;
            $amount_status = ""; // make email_status empty
        }else {
            if(strlen($amount) > 4 || strlen($amount) < 2 ){
                $amount_error = lang("Amount must be between 2 and 4 characters") ;
                $amount_status = "";   // make email_status  empty
            }
        }

        //===================== Accepted Validation ==============================
        if( isset( $_POST["accepted"] ) ){

            $accepted =  $_POST["accepted"]  ;

            foreach( $accepted as $paymentMethod ){

                if( checkRecord( "name" , "payment_methods" , $paymentMethod ) == 0  ){
                    header("Location: index.php");
                    exit();
                }

            }

            $accepted =  json_encode($accepted);
            
        }else{
            $accepted_error = lang("You must choose at least one") ;
            $accepted_status = "";  
        }

        
        //===================== desc Validation ==============================
        if( $desc == "" ){
            $desc_error =  lang("description is empty") ;
            $desc_status = "";

        }else{
            if(strlen($desc) > 500 || strlen($desc) < 20 ){
                $desc_error =   lang("description must be between 20 and 500 characters") ;
                $desc_status = "";
            }
        }


        //===================== Img Validation ==============================
        if( empty( $img_name ) ){
            $img_error = lang("Upload photo is required") ;
            $img_status = ""; // make img_status  empty
        }else{ 
            if( !in_array( $get_extention ,  $extentions ) ) { 
                $img_error = lang("You must upload only photos") ;
                $img_status = ""; // make img_status  empty
            }
        }

        //===================== Insert into DB  ==============================
        if( !empty($name_status) && !empty($category_status)&& !empty($amount_status)&& !empty($accepted_status) &&!empty($desc_status)&& !empty($img_status) ){

            //========== Upload img ===============
            fix_rotate_jpg_image($tmp_name);
            move_uploaded_file( $tmp_name , "$store_files/$img_name_rand");

            //================ amount_paid =========================
            $amount_paid = round(  ( $amount * 0.03 ) + $amount );

            //================ session ID =========================
            $sessionId;

            $stmt = $con->prepare(" INSERT INTO 
                        products ( `name` , `description` , `UserID` , `amount`  , `amount_paid` , `category` , `accepted` , `img` )
                        VALUES( :zname , :zdescription , :zUserID ,:zamount , :zamount_paid , :zcategory , :zaccepted , :zimg )");
            $stmt->execute(array(
                ":zname"         => $name,
                ":zdescription"  => $desc,
                ":zUserID"       => $sessionId,
                ":zamount"       => $amount,
                ":zamount_paid"  => $amount_paid ,
                ":zcategory"     => $category ,
                ":zaccepted"     => $accepted ,
                ":zimg"          => $img_name_rand ,
            ));

            if( $stmt->rowCount() > 0  ){
                create_session( "success_messege" , '<i class="fas fa-check"></i> successfully Add Product' ); 
                header("Location: profile.php?sellerid=" . $seller["UserID"] );
                exit();

            }else{
                create_session( "failed_messege" , '<i class="fas fa-times"></i> Failed Add Product' ); 
                header("Location: profile.php?sellerid=" . $seller["UserID"] );
                exit();
            }
        }








    }




?>