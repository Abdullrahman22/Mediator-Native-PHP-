<?php
    $pagetitle = "Home"; 
    include("includes/template/header.php"); 

    unset( $_SESSION["exchane_info"] );
    unset( $_SESSION["request_session"] );

?>

<div id="home">

    <!------------ Navbar  -------------->
    <?php include "includes/components/navbar.php";  ?>

    <!------------ Header  -------------->
    <div id="header" class="bg-parallax"> 
        <div class="container">
            <div class="row">
                <div class="col-md-4">

                    <div class="header-content">
                        <p class="home-heading animated zoomIn"> <?php echo  lang('Now!! Simply You Can Exchage Money With Friends in a Best Safe Method.'); ?> </p>
                        <a class=" home-btn wow animated fadeInLeft" data-wow-duration="1s" data-wow-delay=".5s" href="choose_method.php" > <?php echo  lang('Strat Exchange <i class="fas fa-sync-alt"></i>'); ?> </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!------------ Steps  -------------->
    <div id="steps" class="content-padding">
                                    
        <p class="section-title wow animated fadeInDown" data-wow-duration="1s" data-wow-delay=".5s"> <i class="fas fa-list-ul"></i> <?php echo  lang('STEPS !'); ?> </p>
        <div class="content-title-underline"></div>

        <div class="container">
            <div class="row text-center">

                <div class="col-md-4">
                    <div class="box wow animated fadeInleft" data-wow-duration="1s" data-wow-delay=".5s"> 
                        <i class="fas fa-shipping-fast"></i>
                        <h5> <?php echo  lang('Your Customer purchases product'); ?> </h5>
                        <p> <?php echo  lang('The advantage of Automater is that you can integrate it with such platforms as Allegro and eBay as well as with the majority of payment agents. You can use our API for new transactions.'); ?> </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="box wow animated fadeInUp" data-wow-duration="1s" data-wow-delay=".5s"> 
                        <i class="fas fa-money-check"></i>
                        <h5> <?php echo  lang('You get a payment'); ?> </h5>
                        <p> <?php echo  lang('System automatically notes the confirmation of received payment , if the customer decides to make a traditional transfer you will be able to book the payment manually .'); ?> </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="box wow animated fadeInRight" data-wow-duration="1s" data-wow-delay=".5s"> 
                        <i class="fas fa-paper-plane"></i>
                        <h5> <?php echo  lang('Automater sends the code to Client'); ?>  </h5>
                        <p> <?php echo  lang('When your customer opens a message with a code or it will not be delivered, you will receive a notification . Thanks to the complaint module, the Customer will be able to complaint the product.'); ?> </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!------------ products  -------------->
    <?php
    if( !empty( getLastedProducts() ) ){
        ?>

        <div id="products" class="content-padding">
            <p class="section-title wow animated fadeInDown" data-wow-duration="1s" data-wow-delay=".5s"> <i class="fas fa-cart-plus"></i>  <?php echo  lang('Products!'); ?>  </p>
            <div class="content-title-underline"></div>

            <div class="container">
                <div class="row products">

                    <div class="col-md-12 text-center">
                        <div id="porduct-card" class="text-center owl-carousel owl-theme">

                            <?php
                                $products = getLastedProducts();
                                foreach( $products as $product ){
                                    ?>

                                        <div class="product-card">
                                            <div class="product-img">
                                                <img src="assets/images/payment-methods/cards/<?php echo $product['img'];?>" alt="product-img"  >
                                                <span class="amount"> <?php echo $product['amount'];?>$ </span>
                                            </div>
                                            <div class="title "> <a href="view.php?id=<?php echo $product['id'] ; ?>"> <?php echo $product['name'];?> </a>  </div>
                                            <div class="price "> 
                                                <span class="text"> <?php echo lang('price'); ?> : </span>
                                                <span class="money"> <?php echo $product['amount_paid'];?> USD </span>
                                            </div>
                                            <div class="buttons">
                                                <a href="view.php?id=<?php echo $product['id'] ; ?>" class="btn"> <i class="fas fa-eye"></i>   <?php echo lang('view'); ?> </a>
                                                <?php
                                                    if( isset( $_SESSION["loginUserID"] )  ){
                                                        if( $_SESSION["loginUserID"] != $product["UserID"] ){
                                                            echo '<a href="inbox.php?do=chat&receiver='. $product['UserID'] .'" class="btn" > <i class="fab fa-facebook-messenger"></i> '. lang('Contact') .' </a>';
                                                        }
                                                    }else{
                                                        echo '<a href="inbox.php?do=chat&receiver='. $product['UserID'] .'" class="btn" > <i class="fab fa-facebook-messenger"></i> '. lang('Contact') .' </a>';  
                                                    }
                                                ?>
                                            </div>
                                        </div>

                                    <?php
                                }
                            ?>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <?php
    }
    ?>
    <!------------ Stats  -------------->
    <div id="stats" class="content-padding bg-parallax">
        <div class="overlay"></div>                      
        <p class="section-title wow animated fadeInDown" data-wow-duration="1s" data-wow-delay=".5s"> <?php echo  lang('We Never Stop Improving!'); ?></p>
        <div class="content-title-underline"></div>

        <div class="container">
            <div class="row text-center">

                <div class="col-md-3 col-sm-6"> 
                    <div class="stats-item wow animated fadeInLeft" data-wow-duration="1s" data-wow-delay=".5s"> 
                        <i class="fas fa-exchange-alt fa-5x"></i>
                        <h2>
                            <span class="counter"> 1590 </span>
                            <span> + </span>
                        </h2>
                        <p> <?php echo  lang('TOTAL EXCHANGES'); ?> </p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6"> 
                    <div class="stats-item wow animated fadeInDown" data-wow-duration="1s" data-wow-delay=".5s"> 
                        <i class="fas fa-money-bill-wave fa-5x"></i>
                        <h2>
                            <span class="counter"> 3527 </span>
                            <span>+</span>
                        </h2>
                        <p> <?php echo  lang('WITHDRAWAL REQUESTS'); ?></p>
                    </div>
                </div>
                

                <div class="col-md-3 col-sm-6"> 
                    <div class="stats-item wow animated fadeInUp" data-wow-duration="1s" data-wow-delay=".5s"> 
                        <i class="fas fa-star fa-5x"></i>
                        <h2>
                            <span class="counter"> 1590 </span>
                            <span>+</span>
                        </h2>
                        <p> <?php echo  lang('LIKES'); ?> </p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6"> 
                    <div class="stats-item wow animated fadeInRight" data-wow-duration="1s" data-wow-delay=".5s"> 
                        <i class="fas fa-users fa-5x"></i>
                        <h2>
                            <span class="counter"> 1590 </span>
                            <span>+</span>
                        </h2>
                        <p> <?php echo  lang('USERS'); ?> </p>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!------------ Lasted Transfer  -------------->
    <?php
    if( !empty( getSuccessExchanges() ) ){
        ?>
            <div id="last-transfer" class="content-padding" >
                <p class="section-title wow animated fadeInDown" data-wow-duration="1s" data-wow-delay=".5s"> <i class="fas fa-history"></i>  <?php echo  lang('LASTED TRANSFER !'); ?>  </p>
                <div class="content-title-underline"></div>
                <div class="container">
                    <?php
                        $transfers = getSuccessExchanges();
                        foreach( $transfers as $transfer ){

                            $send          =  $transfer["method_1"];
                            $send_row      =  getPaymentInfo($send);
                            $receive       =  $transfer["method_2"];
                            $receive_row   =  getPaymentInfo($receive);

                            ?>
                                <div class="transfer-box">
                                    <p class="method-text"> 
                                        <i class="fas fa-circle"></i>
                                        <span class="method-from"> <?php echo $send_row["name"] ?> </span>
                                        <i class="fas fa-exchange-alt" style="color: #1791e5"></i>
                                        <span class="method-to">  <?php echo $receive_row["name"] ?>  </span>
                                    </p>
                                    <p class="money-mount">
                                        <span class="method-from"> <img src="assets/images/payment-methods/icons/<?php echo $send_row["icon"] ?>" alt="" class="payment-img" > <?php echo $transfer["money_1"] ?> <small> USD</small>  </span>
                                        <i class="fas fa-exchange-alt " ></i>
                                        <span class="method-to"> <img src="assets/images/payment-methods/icons/<?php echo $receive_row["icon"] ?>" alt="" class="payment-img" >  <?php echo $transfer["money_2"] ?>  <small> USD</small>   </span>
                                    </p>
                                    <p class="persons">
                                        <span class="person-from">  <?php echo $transfer["email_1"] ?>  </span>
                                        <i class="fas fa-exchange-alt" style="color: #1791e5"></i>
                                        <span class="person-to"> <?php echo $transfer["email_2"] ?> </span>
                                    </p>
                                    <div class="date">
                                        <i class="fas fa-clock"></i> 
                                        <?php 
                                            $dbDate = strtotime(  $transfer["date"] );
                                            $date =  date("d M Y", $dbDate ) ;
                                            echo $date;
                                        ?> 
                                    </div>
                                    <hr>
                                </div>
                            <?php
                        }
                    ?>
                </div>
            </div>
        <?php
    }
    ?>

    <!------------ Testmonials  -------------->
    <?php
    if( !empty( Alltestmonials() ) ){
        ?>


        <div id="testmonials" class="content-padding bg-parallax">
            <p class="section-title"> <i class="fas fa-star-half-alt"></i>  <?php echo  lang('Testmonials !'); ?>  </p>
            <div class="content-title-underline"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div id="customers-testimonials" class="text-center owl-carousel owl-theme">
                            <?php
                                $comments = Alltestmonials();
                                foreach( $comments as $comment ){
                                    $userid = $comment["user_ID"];
                                    $user = getUserInfo( $userid );

                                    $userPhoto = $user["image"];
                                    if( $userPhoto == "" ){
                                        $userPhoto = 'user-img.png';
                                    }

                                    ?>
                                    <div class="testmonial-box">
                                        <img src="assets/images/users-img/<?php echo $userPhoto ; ?>" alt="user-img" class="user-img">
                                        <blockquote class="text-center">
                                            <p><?php echo $comment["comment"]; ?></p>
                                        </blockquote>

                                        <div class="rating"> 
                                            <ul class="list-unstyled">
                                                <?php
                                                    $commentStars = $comment["rating"] ;

                                                    //================ echo Star ================================
                                                    for ( $x = 1 ; $x <= $commentStars ; $x++ ) {
                                                        echo '<li> <img src="assets/images/icons/star.png" alt="rating-stars" class="rating-stars"> </li>';
                                                    }

                                                    //================ echo Star Gray ================================
                                                    $restStars = 5 - $commentStars ;
                                                    for ($x = 1; $x <= $restStars; $x++) {
                                                        echo '<li> <img src="assets/images/icons/star-gray.png" alt="rating-stars" class="rating-stars"> </li>';
                                                    }

                                                ?>
                                            </ul>
                                        </div>


                                        <p class="email"> <i class="fas fa-envelope"></i> <?php echo $user["Email"]; ?></p>


                                    </div>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>

    <!------------ Services  -------------->
    <div id="services" class="content-padding">
        <p class="section-title"> <i class="fas fa-award"></i> <?php echo  lang('Services !'); ?>  </p>
        <div class="content-title-underline"></div>
        
        <div class="container">
            <div class="row">



                <div class=" col-md-6 col-sm-12">

                    <div class="service-item wow animated fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">

                        <div class="service-item-icon">
                            <i class="fas fa-desktop fa-3x"></i>
                        </div>

                        <div class="service-item-title">
                            <h3> <?php echo  lang('One place to sell'); ?>  </h3>
                        </div>

                        <div class="service-item-desc">
                            <p> <?php echo  lang('You Can follow your process to the End'); ?> </p>
                        </div>

                    </div>

                </div>


                <div class=" col-md-6 col-sm-12">

                    <div class="service-item wow animated fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">

                        <div class="service-item-icon">
                            <i class="fas fa-unlock-alt fa-3x"></i>
                        </div>

                        <div class="service-item-title">
                            <h3> <?php echo  lang('Safty and reliability'); ?>  </h3> 
                        </div>

                        <div class="service-item-desc">
                            <p> <?php echo  lang('Your process will be done safely and you will be closely followed'); ?> </p>
                        </div>

                    </div>

                </div>


                <div class=" col-md-6 col-sm-12">

                    <div class="service-item wow animated fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">

                        <div class="service-item-icon">
                            <i class="fas fa-cogs fa-3x"></i>
                        </div>

                        <div class="service-item-title">
                            <h3> <?php echo  lang('Full automation'); ?>  </h3> 
                        </div>

                        <div class="service-item-desc">
                            <p> <?php echo  lang("Everything is accurate and organized, and it should be liked by our customers"); ?> </p>
                        </div>

                    </div>

                </div>



                <div class=" col-md-6 col-sm-12">

                    <div class="service-item wow animated fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">

                        <div class="service-item-icon">
                            <i class="fas fa-store fa-3x"></i>
                        </div>

                        <div class="service-item-title">
                            <h3> <?php echo  lang('Online Store'); ?>   </h3> 
                        </div>

                        <div class="service-item-desc">
                            <p> <?php echo  lang('you can create a seller account and sell products in our store'); ?> </p>
                        </div>

                    </div>

                </div>


                <div class=" col-md-6 col-sm-12">

                    <div class="service-item wow animated fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">

                        <div class="service-item-icon">
                            <i class="fas fa-comment-dots fa-3x"></i>
                        </div>

                        <div class="service-item-title">
                            <h3> <?php echo  lang('Live Chat'); ?>   </h3> 
                        </div>

                        <div class="service-item-desc">
                            <p> <?php echo  lang('You Can Contact With Us To Know More Offers'); ?> </p>
                        </div>

                    </div>

                </div>



                <div class=" col-md-6 col-sm-12">

                    <div class="service-item wow animated fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">

                        <div class="service-item-icon">
                            <i class="fas fa-envelope fa-3x"></i>
                        </div>

                        <div class="service-item-title">
                            <h3> <?php echo  lang('Online Store'); ?>   </h3> 
                        </div>

                        <div class="service-item-desc">
                            <p> <?php echo  lang('You Can Mail Us To Now Lasted Products'); ?> </p>
                        </div>

                    </div>

                </div>





            </div>
        </div>

    </div>


</div>
<?php
    include("includes/template/footer.php");
?>
