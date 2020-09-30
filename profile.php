<?php
    $pagetitle = "Profile"; 
    include("includes/template/header.php"); 


    include "includes/handlers/profile.php"; 


?>
<div id="profile-page">

    <?php include "includes/components/navbar.php";  ?>

    <!-------------------- header ----------------------------->
    <div class="header">
        <div class="container">
            <?php include 'includes/components/sessions_messeges.php'; ?>
            <div class="my-info">
                <div class="img section-left">
                    <?php
                        if( $seller["image"] == ''){
                            echo '<img src="assets/images/users-img/user-img.png" class="user-img" alt="" >';
                        }else{
                            echo '<img src="assets/images/users-img/'. $seller["image"] .'" class="user-img" alt="">';
                        }
                    ?>
                </div>
                <div class="section-right">
                    <h2 class="name"> 
                        <?php 
                            echo ucfirst( $seller["Username"] ); 
                            if(  $seller["UserID"] == $sessionId ){
                                echo ' <span class="icons"> <i class="fas fa-pen-square"></i> <i class="fas fa-plus-circle"></i> </span>  ';
                            }else {
                                echo '<a href="inbox.php?do=chat&receiver='. $seller["UserID"]  .'"> <i class="fab fa-facebook-messenger"></i> </a>';
                            }
                        ?>
                    </h2>
                    <p class="address"> 
                        <?php
                            if( $seller["address"] != ''){
                                echo '<i class="fas fa-map-marker-alt"></i> ' .$seller["address"] ;
                            }
                        ?>
                    </p>
                    <p class="about">
                        <?php
                            if( $seller["about"] != ''){
                                echo $seller["about"] ;
                            }
                        ?>
                    </p>
                    <ul class="list-unstyled">
                        <?php
                            if( $seller["facebook"] != ''){
                                echo '<li> <a href=" '. $seller["facebook"] .' ">  <i class="fab fa-facebook-f"></i> </a>  </li>';
                            }
                            if( $seller["twitter"] != ''){
                                echo '<li> <a href=" '. $seller["facebook"] .' ">  <i class="fab fa-twitter-square"></i> </a>  </li>';
                            }
                            if( $seller["instagram"] != ''){
                                echo '<li> <a href=" '. $seller["facebook"] .' ">  <i class="fab fa-instagram"></i> </a>  </li>';
                            }
                        ?>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <!------------------------- overlay-white  ------------------------------->
    <div class="overlay-white-loading">
        <div class="lds-dual-ring"></div>
    </div>



    <div class="content">
        <div class="container">

            <!------------------------- left-section  ------------------------------->
            <div class="left-section">


                <div class="history wow animated fadeInLeft" data-wow-duration="1s"  data-wow-delay=".5s">

                    <h5> <i class="fas fa-history"></i> <?php echo lang("Work History"); ?> </h5>
                    <hr>
                    <ul>
                        <?php
                            $jobs = countSellerjobs( $seller["Email"] );
                            if( $jobs > 0 ){
                                echo '<li>  
                                        <span class="bold"> 99% </span> '. lang("Jobs Success") .'
                                    </li>';
                            }
                        ?>
                        <li>
                            <?php
                                $starsCount = countSellerStars( $seller["UserID"] );
                                if( $starsCount > 0 ){

                                    $stars = getSellerStars( $seller["UserID"] );

                                    //================ Collection Of Star ================================
                                    $collection = 0;
                                    foreach( $stars as $star ){
                                        $collection += $star['rating'];
                                    }
                                    $sum  = ceil( $collection / $starsCount ) ;
                                    echo '<span class="bold"> '. $sum  . " " .  lang("Stars") . ' </span>';

                                    //================ echo Star ================================
                                    for ($x = 1; $x <= $sum; $x++) {
                                        echo '<img src="assets/images/icons/star.png" alt="">';
                                    }

                                    //================ echo Star Gray ================================
                                    $restSum = 5 - $sum;
                                    for ($x = 1; $x <= $restSum; $x++) {
                                        echo '<img src="assets/images/icons/star-gray.png" alt="">';
                                    }

                                

                                }else {
                                    echo ' <span class="bold"> ' . lang("Stars") . ' <i class="fas fa-question-circle"></i> </span> ';
                                }
                            ?>
                            
                        </li>
                        <li> 
                            <?php
                                $jobs = countSellerjobs( $seller["Email"] );
                                if( $jobs > 0 ){
                                    echo '<span class="bold"> '. $jobs .' </span>  ' . lang("Jobs") ;
                                }else {
                                    echo '<span class="bold"> ' .  lang("Jobs") . ' </span>  <i class="fas fa-question-circle"></i> ';
                                }
                            ?>
                        </li>
                    </ul>

                </div>

                <div class="details wow animated fadeInLeft" data-wow-duration="1s"  data-wow-delay=".5s">
                   
                    <h5> 
                        <i class="fas fa-info-circle"></i> <?php echo lang("Other Details"); ?>  
                        <?php
                            if(  $seller["UserID"] == $sessionId ){
                                echo '<i class="fas fa-pen-square"></i>';
                            }
                        ?>
                    </h5>
                    <hr>
                    <ul class="list-unstyled">
                        <li>
                            <span class="bold text"> <?php echo lang("Member Since"); ?> </span> : 
                            <?php
                                $dbDate = strtotime(  $seller["register_date"] );
                                $date =  date("d M Y", $dbDate ) ;
                                echo $date;
                            ?> 
                        </li>
                        <li>
                            <span class="bold text"> <?php echo lang("Availabilty"); ?>  </span> 
                            <?php
                                if( $seller["availability"] == '0'){
                                    echo '<img src="assets/images/icons/minus.png" alt="">';
                                }elseif(  $seller["availability"] == '1' ){
                                    echo ': 5-10 ' . lang("hrs/week") ;
                                }elseif(  $seller["availability"] == '2' ){
                                    echo ': 10-20 '. lang("hrs/week") ;
                                }elseif(  $seller["availability"] == '3' ){
                                    echo ': 20-30 '. lang("hrs/week") ;
                                }
                            ?>
                        </li>
                        <li style="display: none">   <span class="bold"> <i class="fas fa-envelope"></i> <?php echo lang("Email Verified"); ?>  </span>  
                            <?php
                                if( $seller["email_vertified"] == '0'  ){
                                    echo '<img src="assets/images/icons/minus.png" alt="">';
                                }else{
                                    echo '<img src="assets/images/icons/shield.png" alt="">';
                                }
                            ?> 
                        </li>
                        <li>  <span class="bold"> <i class="fas fa-phone-volume"></i>  <?php echo lang("Phone"); ?>  </span> 
                            <?php
                                if( $seller["num"] == ''  ){
                                    echo '<img src="assets/images/icons/minus.png" alt="">';
                                }else{
                                    echo '<img src="assets/images/icons/shield.png" alt="">';
                                }
                            ?>
                        </li>
                    </ul>

                </div>
                
            </div>

            <!------------------------- right-section  ------------------------------->
            <div class="right-section">

                <!-------------------- timeline ----------------------------->
                <div class="timeline wow animated fadeInRight" data-wow-duration="1s"  data-wow-delay=".5s">
                    <h5> <i class="fas fa-briefcase"></i> <?php echo lang("Projects Timeline"); ?> </h5>
                    <hr>
                    <div class="inner">

                        <?php
                            if( !empty( getTransfers(  $seller["Email"] ) ) ){

                                $transfers = getTransfers(  $seller["Email"] ) ;
                                foreach( $transfers as $transfer ){

                                    //================= product info===========================
                                    $product = getProductInfo( $transfer["product_id"] );
                                    //================= product category ===========================
                                    $category = getPaymentInfo( $product["category"] ); 

                                ?>
                                <div class="project-timeline">
                                    <div class="culmn"></div>
                                    <div class="section-left">
                                        <span class="project-time"> <?php  echo date( 'M  Y', strtotime( $transfer["date"] ) );  ?> <i class="far fa-calendar-check"></i>  </span>
                                        
                                    </div>
                                    <div class="section-right">
                                        <h5 class="payment-method"> <img src="assets/images/payment-methods/icons/<?php echo $category["icon"] ; ?>" alt=""> <?php echo $category["name"] ; ?> </h5>
                                        <p class="mount"> <?php echo $product["amount"] ; ?>$ </p>
                                        <p class="about"> <?php echo $product["description"] ; ?> </p>
                                    </div>
                                </div>
                                <hr>
                                <?php

                                }
                            }else{
                                echo "<div class='text-center no-timeline'> " .  lang("There's no Timelines") . " </div>";
                            }
                        ?>
                        
                        
                    </div>
                </div>


            </div>
            
        </div>
    </div>

    <!-------------------- products ----------------------------->
    <?php
    if(  !empty( getSellerProducts( $seller["UserID"]  ) ) ){
        ?>
            <div class="products">
                <div class="container">
                    <h3> <i class="fas fa-clipboard-list"></i> <?php if(  $seller["UserID"] == $sessionId ){ echo lang("My Products") ; }else{ echo lang("Products") ; }?>  </h3>
                    <div class="content-title-underline-left"></div>
                    <div class="row text-center">
                        <?php
                            $products = getSellerProducts( $seller["UserID"] );
                            foreach( $products as $product ){
                                ?>


                                    <div class="col-lg-3 col-md-4 col-sm-6 text-center">
                                        <div class="product-card">
                                            <?php
                                                if(  $seller["UserID"] == $sessionId ){ 
                                                    echo ' <span class="delete-project" productId="'. $product['id'] .'"> <i class="fas fa-times-circle"></i> </span> ';
                                                }
                                            ?>
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
                                                        if( $_SESSION["loginUserID"] == $seller["UserID"] ){
                                                            if( $product['status'] == 0 ){
                                                                echo '<a class="btn status pendding"> ' . lang('<i class="fas fa-spinner"></i> Pendding')  . '</a>';
                                                            }elseif(  $product['status'] == 1 ){
                                                                echo '<a class="btn status accepted"> ' . lang('<i class="fas fa-check"></i> Accepted')  . ' </a>';
                                                            }elseif(  $product['status'] == 2 ){
                                                                echo '<a class="btn status rejected"> ' . lang('<i class="fas fa-times"></i> Reject')  . ' </a>';
                                                            }
                                                        }
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>


                                <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        <?php
    }
    ?>

    <!-------------------- comment ----------------------------->
    <?php
    if( !empty(  sellerComments( $seller["UserID"]  ) ) ){
        $comments = sellerComments(  $seller["UserID"] );
        ?>
        <div class="comment">
            <div class="container">
                <div class="comment-inner wow animated fadeInUp" data-wow-duration="1s"  data-wow-delay=".5s">

                    <h5> <i class="fas fa-comment"></i> <?php echo lang("Customer Comments");?> </h5>
                    <hr>

                    <?php
                        foreach( $comments as $comment ){

                            $commenter = getUserInfo( $comment["user_ID"] );
                            ?>
                                <div class="comment-box">
                                    <div class="user-box">
                                        <div class="user-img">
                                            <img src="assets/images/users-img/user-img.png" alt="">
                                        </div>
                                        <div class="user-info">
                                            <div class="username"> 
                                                <?php  echo  $commenter["Email"] ;?>
                                            </div>
                                            <div class="comment-date"> 
                                                <?php  echo date( 'j M  Y', strtotime( $comment["date"] ) ); ;?>
                                            </div>
                                            <div class="rating"> 
                                                <ul class="list-unstyled">
                                                    <?php
                                                        $commentStars = $comment["rating"] ;

                                                        //================ echo Star ================================
                                                        for ( $x = 1 ; $x <= $commentStars ; $x++ ) {
                                                            echo '<li> <img src="assets/images/icons/star.png" alt=""> </li>';
                                                        }

                                                        //================ echo Star Gray ================================
                                                        $restStars = 5 - $commentStars ;
                                                        for ($x = 1; $x <= $restStars; $x++) {
                                                            echo '<li> <img src="assets/images/icons/star-gray.png" alt=""> </li>';
                                                        }

                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="user-comment">
                                        <p> <?php echo $comment["comment"] ; ?> </p>
                                    </div>
                                </div>  
                                <hr>


                            <?php
                        }
                    ?>
                </div>
            </div>
        </div>
        <?php
    }
    ?>

    <!-------------------- edit info ----------------------------->
    <?php 
        if(  $seller["UserID"] == $sessionId ){
            ?>
            <div class="popup-form edit-info">

                <div class="inner">


                    <h4> <i class="fas fa-pen-square"></i> <?php echo lang("Edit info") ; ?> </h4>
                    <hr>
                    <form action="profile.php?sellerid=<?php echo $seller["UserID"]; ?>" method="POST" enctype="multipart/form-data">

                        <!--Address Field-->
                        <div class="form-group">
                            <label for="address"> <i class="fas fa-map-marker-alt"></i>  <?php echo lang("Address") ; ?> </label>
                            <input type="text" name="address" placeholder="<?php echo lang("Type address..") ; ?>" class="form-control" value="<?php echo $seller["address"]; ?>"  autocomplete="off" minlength="4" maxlength="250">
                        </div>
                        <?php
                            if( isset( $address_error ) ){
                                echo '<p class="error_messege">' . $address_error . '</p>'; 
                            }
                        ?>
                        <hr>

                        <!-- about Field -->
                        <div class="form-group">
                            <label for="about">  <i class="fas fa-info-circle"></i> <?php echo lang("About Me") ; ?> </label>
                            <input type="text" name="about" placeholder="<?php echo lang("Type about you..") ; ?>" class="form-control" value="<?php echo $seller["about"]; ?>" autocomplete="off" minlength="4" maxlength="250">
                        </div>
                        <?php
                            if( isset( $about_error ) ){
                                echo '<p class="error_messege">' . $about_error . '</p>'; 
                            }
                        ?>
                        <hr>

                        <!-- facebook Field-->
                        <div class="form-group">
                            <label for="facebook"> <i class="fab fa-facebook-square"></i> <?php echo lang("Your Facebook Link") ; ?> </label>
                            <input type="url" pattern="http://www\.facebook\.com\/(.+)|https://www\.facebook\.com\/(.+)" title="please insert your facebook account" name="facebook" placeholder="<?php echo lang("Type facebook link..");?>"  class="form-control" value="<?php echo $seller["facebook"]; ?>" autocomplete="off" minlength="20" maxlength="250">
                        </div>
                        <?php
                            if( isset( $facebook_error ) ){
                                echo '<p class="error_messege">' . $facebook_error . '</p>'; 
                            }
                        ?>
                        <hr>

                        <!-- twitter Field-->
                        <div class="form-group">
                            <label for="twitter"> <i class="fab fa-twitter-square"></i> <?php echo lang("Your Twitter Link") ; ?> </label>
                            <input type="url" pattern="http://www\.twitter\.com\/(.+)|https://www\.twitter\.com\/(.+)" title="please insert your twitter account"  name="twitter" placeholder="<?php echo lang("Type twitter link..");?>" class="form-control" value="<?php echo $seller["twitter"]; ?>"  autocomplete="off" minlength="20" maxlength="250">
                        </div>
                        <?php
                            if( isset( $twitter_error ) ){
                                echo '<p class="error_messege">' . $twitter_error . '</p>'; 
                            }
                        ?>
                        <hr>

                        <!-- Instagram Field-->
                        <div class="form-group">
                            <label for="Instagram"> <i class="fab fa-instagram"></i> <?php echo lang("Your Instagram Link") ; ?> </label>
                            <input type="url" pattern="http://www\.instagram\.com\/(.+)|https://www\.instagram\.com\/(.+)" title="please insert your instagram account"   name="instagram" placeholder="<?php echo lang("Type Instagram link..");?>" class="form-control" value="<?php echo $seller["instagram"]; ?>" autocomplete="off" minlength="20" maxlength="250">
                        </div>
                        <?php
                            if( isset( $instagram_error ) ){
                                echo '<p class="error_messege">' . $instagram_error . '</p>'; 
                            }
                        ?>
                        <hr>

                        <!--upload-input-->
                        <div class="upload-input">
                            <label for="file" id="file-label">  <i class="fas fa-cloud-upload-alt"></i> &nbsp; <?php echo lang("Choose your image") ; ?>  </label>
                            <input type="file" class="file form-control" id="file" name="img" > 
                        </div>


                        <button name="edit_info_btn" type="submit" class="btn btn-primary"> <i class="fas fa-pencil-alt"></i> <?php echo lang("edit") ; ?> </button>

                    </form>

                </div>

            </div>

            <?php
        }
    ?>

    <!-------------------- edit Details ----------------------------->
    <?php 
        if(  $seller["UserID"] == $sessionId ){
            ?>
            <div class="popup-form edit-details">

                <div class="inner">


                    <h4> <i class="fas fa-pen-square"></i> <?php echo lang("Edit Details");?> </h4>
                    <hr>
                    <form action="profile.php?sellerid=<?php echo $seller["UserID"]; ?>" method="POST" enctype="multipart/form-data">

                        <!--Availabilty Field-->
                        <div class="form-group">
                            <label for="availabilty"> <i class="fas fa-toggle-on"></i> <?php echo lang("Availabilty");?>  </label>
                            <select name="availabilty" id="availabilty" class="form-control"  > 
                                <option value="0" style="display:none"> <?php echo lang("Choose Your Availabilty");?>  </option>
                                <option value="1" <?php if( $seller["availability"] == 1 ){ echo "selected" ; } ?> >5-10 <?php echo lang("hrs/week");?> </option>
                                <option value="2" <?php if( $seller["availability"] == 2 ){ echo "selected" ; } ?> >10-20 <?php echo lang("hrs/week");?> </option>
                                <option value="3" <?php if( $seller["availability"] == 3 ){ echo "selected" ; } ?> >20-30 <?php echo lang("hrs/week");?> </option>
                               
                            </select>
                        </div>
                        <?php
                            if( isset( $availabilty_error ) ){
                                echo '<p class="error_messege">' . $availabilty_error . '</p>'; 
                            }
                        ?>
                        <hr>

                        <!--phone Field-->
                        <div class="form-group">
                            <label for="phone"> <i class="fas fa-phone-volume"></i>  <?php echo lang("phone");?>  </label>
                            <input type="text"  name="phone" placeholder="<?php echo lang("Type Phone..");?>" class="form-control"  onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" value="<?php  echo $seller["num"];  ?>" autocomplete="off"  minlength="8" maxlength="30"/>
                        </div>
                        <?php
                            if( isset( $phone_error ) ){
                                echo '<p class="error_messege">' . $phone_error . '</p>'; 
                            }
                        ?>
                        <hr>



                        <button name="edit_details_btn" type="submit" class="btn btn-primary"> <i class="fas fa-pencil-alt"></i> <?php echo lang("edit");?> </button>

                    </form>

                </div>

            </div>

            <?php
        }
    ?>

    <!-------------------- Add Product ----------------------------->
    <?php 
        if(  $seller["UserID"] == $sessionId ){
            ?>

            <div class="popup-form add-product">

                <div class="inner">


                    <h4> <i class="fas fa-plus-circle"></i> <?php echo lang("Add Product") ;?> </h4>
                    <hr>
                    <form action="profile.php?sellerid=<?php echo $seller["UserID"]; ?>" method="POST" enctype="multipart/form-data">

                        <!--Name Field-->
                        <div class="form-group">
                            <label for="name"> <i class="fas fa-file-alt"></i>  <?php echo lang("Product Title") ;?> </label>
                            <input type="text" name="name" placeholder="<?php echo lang("Type Product Title..") ;?>" class="form-control" value="<?php echo getInputValue("name"); ?>"  autocomplete="off" minlength="5" maxlength="30" required/>
                        </div>
                        <?php
                            if( isset( $name_error ) ){
                                echo '<p class="error_messege">' . $name_error . '</p>'; 
                            }
                        ?>
                        <hr>

                        <!--category Field-->
                        <div class="form-group">
                            <label for="category"> <i class="fas fa-search-dollar"></i> <?php echo lang("Payment Method to be sold") ;?> </label>
                            <select name="category" id="category" class="form-control"  required> 
                                <option value="0" style="display:none"> <?php echo lang("Choose Category") ;?> </option>
                                <?php
                                    foreach( $payments as $payment){
                                        echo '<option value="'. $payment["id"] .'" > '. $payment["name"] .' </option> ';
                                    }
                                ?>
                            </select>
                        </div>
                        <?php
                            if( isset( $category_error ) ){
                                echo '<p class="error_messege">' . $category_error . '</p>'; 
                            }
                        ?>
                        <hr>


                        <!-- amount Field-->
                        <div class="form-group">
                            <label for="amount"> <i class="fas fa-money-check-alt"></i> <?php echo lang("Amount") ;?> </label>
                            <input type="text"  name="amount" placeholder="<?php echo lang("Type Amount..") ;?>" class="form-control"  onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" value="<?php echo getInputValue("amount"); ?>" autocomplete="off"  minlength="2" maxlength="4" required/>
                        </div>
                        <?php
                            if( isset( $amount_error ) ){
                                echo '<p class="error_messege">' . $amount_error . '</p>'; 
                            }
                        ?>
                        <hr>

                        <!-- accepted Field-->
                        <div class="form-group accepted-field">
                            <label for="accepted" > <i class="fas fa-tags"></i> <?php echo lang("Accepted") ;?> </label> 
                            <?php
                                foreach( $payments as $payment){

                                    echo ' <input type="checkbox" name="accepted[]" value="'. $payment["name"] .'" />
                                    <img src="assets/images/payment-methods/icons/'. $payment["icon"] .'" alt="payment-icon" class="payment-icon"> '. $payment["name"]  ;

                                    
                                }
                                echo '<p class="error_messege error-checkbox hidden"> ' . lang("You must choose at least one") .' </p>'; 
                            ?>
                        </div>
                        <?php
                            if( isset( $accepted_error ) ){
                                echo '<p class="error_messege">' . $accepted_error . '</p>'; 
                            }
                        ?>
                        <hr>

                        <!-- Desc Field -->
                        <label for="desc"> <i class="fas fa-info-circle"></i> <?php echo lang("Description") ;?>  </label>
                        <textarea name="desc" id="desc" rows="5" class="form-control" minlength="20" maxlength="500"  placeholder="<?php echo lang("Type description for your product and how do you want to recieve your money...") ;?>" required></textarea>
                        <?php
                            if( isset( $desc_error ) ){
                                echo '<p class="error_messege">' . $desc_error . '</p>'; 
                            }
                        ?>
                        <hr>

                        <!--upload-input-->
                        <div class="upload-input">
                            <label for="card-img" id="file-label">  <i class="fas fa-cloud-upload-alt"></i> &nbsp; <?php echo lang("Choose product image") ; ?> &nbsp;  </label>
                            <input type="file" class="file form-control" id="card-img" name="img" required="required"/>
                        </div>
                        <?php
                            if( isset( $img_error ) ){
                                echo '<p class="error_messege">' . $img_error . '</p>'; 
                            }
                        ?>


                        <button name="add_product_btn" type="submit" class="btn btn-primary"> <i class="fas fa-plus"></i> <?php echo lang("Add") ;?> </button>

                    </form>

                </div>

            </div>

            <?php
        }
    ?>


</div>



<?php
    include("includes/template/footer.php");
?>
