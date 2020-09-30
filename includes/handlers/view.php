<?php

   




    if( isset($_GET["id"]) && is_numeric($_GET["id"]) ){
        $id = intval( $_GET["id"] );
    }else{
        $id = "0";
    }

    if( checkProductExist( $id ) == 0 ){
        header("Location: index.php");
    }


    //================= get Product info by id ==========================
    $product = getProductInfo( $id );

    //================= get User info by userid ==========================
    $seller = getUserInfo( $product["UserID"] );
    
    //================= get category info by ( name ) =========================
    $category = getPaymentInfo( $product["category"] );



  
    //================= get seller img ==========================
    if( $seller["image"] == "" ){
        $sellerImg = 'user-img.png';
    }else{
        $sellerImg = $seller["image"] ;
    }


    //================= get payment method info by name  =========================
    $payment_method = getPaymentInfoByName( $product["category"] );
    

    //================= form submition =========================
    if( isset($_POST["buy_btn"]) ){

        create_session( "purchase" , "true" );
        header("Location: purchase.php?id=" . $product["id"] );

    }





?>