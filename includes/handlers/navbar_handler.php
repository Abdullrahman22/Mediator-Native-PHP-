<?php

    if( isset( $_SESSION["loginUserID"] ) ){
        $sessionId = $_SESSION["loginUserID"] ;
    }


    
    if( isset($_POST["search"]) ){


        $value_status = $cats_status = 1 ; 

        //===================== cats Validation ==============================
        $value  = security($_POST['value']);
        if(strlen($value) > 30 ){
            
            $value_status = "";
            header("Location: index.php");
            exit();
            
        }else {
            if( empty( $value ) ){
                $value = "all_products";
            }
        }
        
        //===================== cats Validation ==============================
        $cats   = security($_POST['cats']);
        if( $cats == "0" || $cats == ""  ){
            $cats = "all_cats";
        }else {
            if( checkRecord( "id" , "payment_methods" , $cats ) == 0  ){
                header("Location: index.php");
                exit();
                $cats_status = "";
            }
        }


        //===================== header to search ==============================
        if( !empty($value_status) && !empty($cats_status) ){

            $value = str_replace(" ","+", $value );
            
            header( "Location: search.php?value=" . $value . "&cat=" . $cats );
            exit();

        }
        
    }

?>