<?php

    include("../../../init.php");
    $sessionId = $_SESSION["loginUserID"] ;

    if( isset($_FILES["img"]["name"]) ){


        $img_name           = security(  $_FILES["img"]["name"] ) ;
        $img_name_rand      = rand(0 , 1000) . "_" . $img_name;
        $tmp_name           = $_FILES["img"]["tmp_name"] ;
        $store_files        = "../../../assets/images/users-img/";
        $extentions         = array("jpg" ,"png" , "jpeg" , "ico");
        $get_file_extention = explode("." , $img_name);
        $get_extention      = strtolower( end($get_file_extention) ) ;


        //===================== Img Validation ==============================
        if( !in_array( $get_extention ,  $extentions ) ) { 
            echo "unvalidate_img";
            $img_status = ""; // make img_status  empty
        }else{

            fix_rotate_jpg_image($tmp_name);
            move_uploaded_file( $tmp_name , "$store_files/$img_name_rand");
            $stmt = $con->prepare("UPDATE users SET `image` = ? WHERE `UserID` = ?");
            $stmt->execute( array( $img_name_rand  , $sessionId ) );
            
            

        }


    }else{
        //header("Location: ../../../index.php");
        //exit();
    }
