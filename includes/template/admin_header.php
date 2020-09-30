<?php

    include ("../init.php");

    //===================== Use cookie to create session ==========================================
    if( !isset( $_SESSION["loginUserID"] ) ){
    
        if( isset( $_COOKIE['email'] ) ){
            $email = $_COOKIE['email'];
            $user = getUserInfoByEmail($email);
            create_session( "loginUserID" , $user["UserID"] );
        }
        
    }
  
    
    //===================== check user is Admin ==========================================
    if( !isset( $_SESSION["loginUserID"] ) ){
        header("Location: ../login.php");
    }elseif( userType( $_SESSION["loginUserID"] ) != 3 ){
        header("Location: ../login.php");
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
        <!-------------------------------------- start favicon  -----------------------------> 
        <link rel="apple-touch-icon" sizes="57x57" href="../assets/images/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="../assets/images/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="../assets/images/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="../assets/images/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="../assets/images/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="../assets/images/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="../assets/images/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="../assets/images/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="../assets/images/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="../assets/images/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="../assets/images/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon/favicon-16x16.png">
        <link rel="manifest" href="../assets/images/favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="../assets/images/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff"> 
        <!-------------------------------------- End favicon  ------------------------------->  

        <!--------------------------------------  google font   ------------------------------->  
        <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
        <!--------------------------------------  fontawesome   -------------------------------> 
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

        <!--------------------------------------  bootstrap   ------------------------------->  
        <link rel="stylesheet" href="../assets/css/bootstrap.css">

        <!--------------------------------------  Style   ------------------------------->  
        <link rel="stylesheet" href="../assets/css/admin.css">

        <!--------------------------------------  Style   ------------------------------->  
        <link rel="stylesheet" href="../assets/css/admin_responsive.css">



    </head>
    <body>
        
        <div id="admin-page">


            <div class="lg-nav">
                <nav class="navbar navbar-expand-lg ">
                    <div class="container">

                        <a class="navbar-brand" href="../index.php"> <i class="fas fa-home"></i> Home </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon">  <i class="fas fa-bars"></i> </span>
                        </button>
                        <div class="collapse navbar-collapse " id="navbarNav">
                            <ul class="navbar-nav ml-auto">

                                <li class="nav-item">
                                    <a href="exchanges.php">  <i class="fas fa-sync-alt"></i> Exchanges </a> 
                                </li>

                                <li class="nav-item">
                                    <a href="users.php">  <i class="fas fa-user"></i> Users </a> 
                                </li>

                                <li class="nav-item">
                                    <a href="sellers.php"> <i class="fas fa-user-tie"></i> Seller </a> 
                                </li>

                                <li class="nav-item">
                                    <a href="payments.php">  <i class="fas fa-money-check-alt"></i> Payments </a> 
                                </li>

                                <li class="nav-item">
                                    <a href="comments.php">   <i class="fas fa-comment-alt"></i> Comments </a> 
                                </li>

                                <li class="nav-item">
                                    <a href="products.php">   <i class="fas fa-list-ul"></i> Products </a> 
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>

            <div class="sm-nav">
                <div class="admin-nav">

                    <div class="nav-item text-center">
                        <a href="../index.php">  <i class="fas fa-home"></i>  </a> 
                        <div class="absolute">
                            Home Page
                        </div>
                    </div>

                    <div class="nav-item text-center">
                        <a href="exchanges.php">  <i class="fas fa-sync-alt"></i> </a> 
                        <div class="absolute">
                            Exchanges
                        </div>
                    </div>

                    <div class="nav-item text-center">
                        <a href="users.php">  <i class="fas fa-user"></i>  </a> 
                        <div class="absolute">
                            Users
                        </div>
                    </div>
                    
                    <div class="nav-item text-center">
                        <a href="sellers.php"> <i class="fas fa-user-tie"></i>  </a> 
                        <div class="absolute">
                            Sellers
                        </div>
                    </div>
                    
                    <div class="nav-item text-center">
                        <a href="payments.php">  <i class="fas fa-money-check-alt"></i> </a> 
                        <div class="absolute">
                            Payments
                        </div>
                    </div>

                    <div class="nav-item text-center">
                        <a href="comments.php">   <i class="fas fa-comment-alt"></i> </a> 
                        <div class="absolute">
                            Comments
                            <div class="triangle-left"></div>
                        </div>
                    </div>

                    <div class="nav-item text-center">
                        <a href="products.php">   <i class="fas fa-list-ul"></i> </a> 
                        <div class="absolute">
                            Products
                            <div class="triangle-left"></div>
                        </div>
                    </div>

                </div>
                <div class="top-bar"></div>
            </div>
            
            
