    
    
    
    
    
    <i class="fas fa-bars"></i>
    
    <!------------------------ Profile --------------------------->
    <div class="dropdown show">
        <a href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" > <i class="fas fa-user"></i>  </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <?php
                if( userType( $sessionId ) == 3 ){
                    echo '<a class="dropdown-item" href="admin/payments.php"> <i class="fas fa-tools"></i> ' . lang("Admin Panal") . '  </a>';
                }elseif( userType( $sessionId ) == 2  ){
                    echo '<a class="dropdown-item" href="profile.php?sellerid='. $sessionId .'"> <i class="fas fa-user"></i> ' . lang("Profile") . '  </a>';
                    echo '<a class="dropdown-item" href="mytransfers.php">  <i class="fas fa-money-bill-wave"></i> ' . lang("My Transfers") . ' </a>';
                }
                echo '<a class="dropdown-item" href="logout.php">  <i class="fas fa-sign-out-alt"></i> ' . lang("LogOut") . '  </a>';
            ?>
        </div>
    </div>

    <!-------------------------- Notifications ------------------------------>
    <?php
        if( isset( $sessionId ) && userType( $sessionId ) != 3 ){
            ?>
            <div class="dropdown show">
                <a href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" > <i class="fas fa-bell"></i>  </a>
                <?php
                    $notifications = getAllNotifications($sessionId);
                    $num =  countNotifications($sessionId);
                    if( $num > 9 ){
                        $num = "+9";
                    }
                    echo '<div class="red_circle bell">' .$num .' </div>';
                    if( $num >= 1 ){
                        echo '<div class="dropdown-menu bell" aria-labelledby="dropdownMenuLink">' ;

                            foreach( $notifications as $notification ){

                                $user = getUserInfo( $notification["receiver"] );

                                //============= get user img ================
                                $userPhoto = $user["image"];
                                if( $userPhoto == "" ){
                                    $userPhoto = 'user-img.png';
                                }

                                //============= notification type ================
                                if( $notification["type"] == 'purchase_request' ){
                                    $notification_type = lang("Purchase request");
                                }else{
                                    $notification_type = lang("Exchange request") ;
                                }

                                ?>
                                <div class="dropdown-item " > 
                                
                                    <p class="notification-info"> <img src="assets/images/users-img/<?php echo $userPhoto ; ?>" alt="user-img" class="user-img"> <span>  <?php echo $user["Email"] ; ?> <?php echo lang("send you a") ;?>   <?php echo $notification_type; ?>   <span class="date"> <i class="fas fa-clock"></i> <?php echo date( 'j M  Y', strtotime( $notification["date"] ) ); ?>  </span>  </span> </p>
                                    <p class="text-right buttons">
                                        <a href="<?php echo $notification["type"] . '.php?transferid=' . $notification["transfer_id"] ; ?>" class="btn btn-primary <?php echo $notification["type"] ; ?>"> <i class="fas fa-check"></i> <?php echo lang("Accept") ;?> </a>                                 
                                        <a href="" class="btn btn-danger reject-request" tid="<?php echo $notification["transfer_id"] ; ?>" >  <i class="fas fa-times"></i> <?php echo lang("Reject") ;?>  </a>
                                    </p>
                                
                                </div>
                                <hr>
                                <?php
                            }


                        echo '</div>';
                    }

                    
                ?>

            </div>

            <?php
        }
    ?>

    <!-------------------------- Languages ------------------------------>
    <div class="dropdown show">
        <a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php
            if( !isset( $_SESSION["language"] ) || $_SESSION["language"] == "en"  ){
                echo '<img src="assets/images/icons/en.png" alt="" class="lang-icon"> ';
            }else{
                if( $_SESSION["language"] == "fr"  ){
                    echo '<img src="assets/images/icons/fr.png" alt="" class="lang-icon"> </p>';
                }elseif( $_SESSION["language"] == "ar"  ){
                    echo '<img src="assets/images/icons/ar.png" alt="" class="lang-icon">';
                }
            }
            ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item choose-lang" href="" lang="en" > <span>  <?php echo lang("English UK") ;?> </span> <img src="assets/images/icons/en.png" alt="" class="lang-icon"> </a>
            <a class="dropdown-item choose-lang" href="" lang="fr" > <span>  <?php echo lang("French") ;?> </span>  <img src="assets/images/icons/fr.png" alt="" class="lang-icon"> </a>
            <a class="dropdown-item choose-lang" href="" lang="ar" > <span>  <?php echo lang("Arabic") ;?> </span>  <img src="assets/images/icons/ar.png" alt="" class="lang-icon"> </a>
        </div>
    </div>
