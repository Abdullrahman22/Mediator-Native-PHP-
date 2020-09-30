<?php
    include ("init.php");
    
    //===================== Use cookie to create session ==========================================
    if( !isset( $_SESSION["loginUserID"] ) ){
    
        if( isset( $_COOKIE['email'] ) ){
            $email = $_COOKIE['email'];
            $user = getUserInfoByEmail($email);
            create_session( "loginUserID" , $user["UserID"] );
        }
        
    }
    

?>
<!DOCTYPE hmtl>
<html>
    <head>
        <title>
            <?php
                if(!isset($pagetitle)){
                    echo "Defulte Page";
                }else{
                    echo $pagetitle;
                }
            ?>
        </title>
        <!-- Meta -->
        <meta charset="utf-8">
        <!-- IE Compatibility Meta -->
        <meta http-equiv="X-UA-Compatibale" content="IE-=edge">
        <!-- Mobile meta-->
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <!--------------------------------------  favicon  -----------------------------> 
        <link rel="apple-touch-icon" sizes="57x57" href="assets/images/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="assets/images/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="assets/images/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="assets/images/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="assets/images/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="assets/images/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="assets/images/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="assets/images/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="assets/images/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="assets/images/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon/favicon-16x16.png">
        <link rel="manifest" href="assets/images/favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="assets/images/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff"> 

        <!--------------------------------------  google font  En  ------------------------------->  
        <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">

        <!--------------------------------------  google font  Ar  ------------------------------->  
        <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">


        <!--------------------------------------  fontawesome   -------------------------------> 

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

        <!--------------------------------------  bootstrap   ------------------------------->  
        <link rel="stylesheet" href="assets/css/bootstrap.css">

        <!--------------------------------------  animated   ------------------------------->  
        <link rel="stylesheet" href="assets/css/animated.css">


        <!--------------------------------------  jQueryUI   -----------------------------
        <link type="text/css" rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/base/jquery-ui.css" />
        <link type="text/css" rel="stylesheet" href="http://gregfranko.com/jquery.selectBoxIt.js/css/jquery.selectBoxIt.css" />
        -->  

        <!--------------------------------------  Owl Carousel   ------------------------------->  
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
        <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">


        <!--------------------------------------  Style   ------------------------------->  
        <link rel="stylesheet" href="assets/css/custom.css">

        <?php
            /*===================== Arabic Style ===========================*/
            if( isset( $_SESSION["language"] ) && $_SESSION["language"] == "ar" ){
                echo '<link rel="stylesheet" href="assets/css/arabic.css">';
            }
        ?>

        <!--------------------------------  Responsive ------------------------------->  
        <link rel="stylesheet" href="assets/css/responsive.css">


    </head>
    <body>
     