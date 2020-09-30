<?php


    if(isset($_POST["addPaymentBtn"])){

        $paymentName         = security($_POST['paymentName']);
        $ourAccount          = security($_POST['ourAccount']);
        $minimum             = security($_POST['minimum']);


        $img_name           = $_FILES["img"]["name"] ;
        $img_name_rand      = rand(0 , 1000) . "_" . $img_name;
        $tmp_name           = $_FILES["img"]["tmp_name"] ;
        $store_files        = "../assets/images/payment-methods/icons";
        $extentions         = array("jpg" ,"png" , "jpeg" , "ico");
        $get_file_extention = explode("." , $img_name);
        $get_extention      = strtolower( end($get_file_extention) ) ;


        $paymentName_status = $ourAccount_status = $minimum_status = $img_status = 1 ;


        //===================== paymentName Validation ==============================

        if( empty( $paymentName ) ){
            $paymentName_error = "Payment Name is required";
            $paymentName_status = ""; 
        }else {
            if(strlen($paymentName) > 30 || strlen($paymentName) < 4 ){
                $paymentName_error = "Payment Name must be between 30 and 4 characters";
                $paymentName_status = "";  
            }
        }

        //===================== ourAccount Validation ==============================
        if( empty( $ourAccount ) ){
            $ourAccount_error = "Our Account is required";
            $ourAccount_status = ""; 
        }else {
            if(strlen($ourAccount) > 30 || strlen($ourAccount) < 4 ){
                $ourAccount_error = "Our Account must be between 30 and 4 characters";
                $ourAccount_status = "";  
            }
        }

        //===================== minimum Validation ==============================
        if( empty( $minimum ) ){
            $minimum_error = "Minimum is required";
            $minimum_status = ""; 
        }else {
            if(strlen($minimum) > 8 || strlen($minimum) < 1 ){
                $minimum_error = "Minimum must be between 8 and 1 characters";
                $minimum_status = "";  
            }
        }

        //===================== Img Validation ==============================
        if( empty( $img_name ) ){
            $img_error = "Upload photo is required";
            $img_status = ""; // make img_status  empty
        }else{ 
            if( !in_array( $get_extention ,  $extentions ) ) { 
                $img_error = "You must upload only photos";
                $img_status = ""; // make img_status  empty
            }
        }


        //===================== Insert into DB  ==============================
        if( !empty($paymentName_status) && !empty($ourAccount_status) && !empty($minimum_status) && !empty($img_status) ){


            fix_rotate_jpg_image($tmp_name);
            move_uploaded_file( $tmp_name , "$store_files/$img_name_rand");

            $stmt = $con->prepare(" INSERT INTO 
                                        payment_methods ( `name` , `icon` , our_account , minimum )
                                        VALUES( :zname , :zicon , :zour_account ,  :zminimum   )");
            $stmt->execute(array(
                ":zname"           => $paymentName,
                ":zicon"           => $img_name_rand,
                ":zour_account"    => $ourAccount,
                ":zminimum"        => $minimum
            ));
            if($stmt->rowCount() > 0){  // because rowCount() must be 1 at inserting database
                create_session( "success_messege" , " <i class='fas fa-check'></i> &nbsp; successfuly Add New Payment :) " );
                header("Location: payments.php");
                exit();
            }else{
                create_session( "failed_messege" , " <i class='fas fa-times'></i>  &nbsp; Failed to Add New Payment :( " );
                header("Location: payments.php");
                exit();
            }

        }

    }



?>