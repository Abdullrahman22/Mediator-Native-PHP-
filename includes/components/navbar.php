
    <?php  require 'includes/handlers/navbar_handler.php'; ?>
    <nav class="navbar navbar-expand-lg ">
        <div class="container">

            <a class="navbar-brand" href="index.php"> <i class="fas fa-home"></i> <?php echo lang("Home") ;?>  </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">  <i class="fas fa-bars"></i> </span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav ml-auto">

                    <!-------------------------- search ------------------------------>
                    <li class="nav-item search">
                        <?php
                            //=========== Fix search error in categories.php =============
                            $selfLink = $_SERVER['PHP_SELF'] ;
                            if (strpos($selfLink, 'categories.php') !== false) {
                                $catID = security ( $_GET["id"] );
                                $link = "categories.php?id=" . $catID ;
                            }else{
                                $link = $_SERVER['PHP_SELF'] ;
                            }
                        ?>
                        <form action="<?php echo $link ; ?>" method="POST">
                            <div class="search-group">
                                <button type="submit" name="search"> <i class="fas fa-search" ></i> </button>
                                <input type="text" name="value" class="custom-form" placeholder="<?php echo lang("Search for Products...") ;?>" autocomplete="off" maxlength="30" />
                                <select  class="custom-form" name="cats" id="cats">
                                    <option value="0" style="display: none"> <?php echo lang("Choose category") ;?>  </option>
                                    <?php
                                        $cats = getAllPayments();
                                        foreach( $cats as $cat ){
                                            ?>
                                                <option value="<?php echo $cat["id"] ; ?>">  <?php echo $cat["name"] ; ?> </option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </form>
                    </li>

                    <!-------------------------- Languages ------------------------------>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php
                            if( !isset( $_SESSION["language"] ) || $_SESSION["language"] == "en"  ){
                                echo '<img src="assets/images/icons/en.png" alt="" class="lang-icon"> <p class="text"> '. lang("Choose category") .' </p>';
                            }else{
                                if( $_SESSION["language"] == "fr"  ){
                                    echo '<img src="assets/images/icons/fr.png" alt="" class="lang-icon"> <p class="text">  '. lang("Language") .'  </p>';
                                }elseif( $_SESSION["language"] == "ar"  ){
                                    echo '<img src="assets/images/icons/ar.png" alt="" class="lang-icon"> <p class="text">  '. lang("Language") .'  </p>';
                                }
                            }
                            ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item choose-lang" href="" lang="en" > <span> <?php echo lang("English UK") ;?> </span> <img src="assets/images/icons/en.png" alt="" class="lang-icon"> </a>
                            <a class="dropdown-item choose-lang" href="" lang="fr" > <span> <?php echo lang("French") ;?> </span>  <img src="assets/images/icons/fr.png" alt="" class="lang-icon"> </a>
                            <a class="dropdown-item choose-lang" href="" lang="ar" > <span> <?php echo lang("Arabic") ;?> </span>  <img src="assets/images/icons/ar.png" alt="" class="lang-icon"> </a>
                        </div>
                    </li>

                    <!-------------------------- Notifications ------------------------------>
                    <?php
                        if( isset( $sessionId ) && userType( $sessionId ) != 3 ){

                            ?>
                            <li class="nav-item dropdown bell">
                                <a class="nav-link dropdown-toggle"href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">  <i class="fas fa-bell"></i> <p class="text"> <?php echo lang("Notifications") ;?>  </p>  </a>
                                <?php
                                $notifications = getAllNotifications($sessionId);
                                $num =  countNotifications($sessionId);
                                if( $num > 9 ){
                                    $num = "+9";
                                }
                                echo '<div class="red_circle bell">' .$num .' </div>';
                                if( $num >= 1 ){
                                    echo '<div class="dropdown-menu bell" aria-labelledby="navbarDropdownMenuLink">';
                                        
                                        foreach( $notifications as $notification ){

                                            $user = getUserInfo( $notification["receiver"] );

                                            
                                            //============= get user img ================
                                            $userPhoto = $user["image"];
                                            if( $userPhoto == "" ){
                                                $userPhoto = 'user-img.png';
                                            }

                                            //============= sender info ================
                                            $sender = getUserInfo( $notification["sender"] );

                                            
                                            //============= notification type ================
                                            if( $notification["type"] == 'purchase_request' ){
                                                $notification_type = lang("Purchase request");
                                            }else{
                                                $notification_type = lang("Exchange request") ;
                                            }

                                            ?>
                                            <div class="dropdown-item" > 
                                            
                                                <p class="notification-info"> <img src="assets/images/users-img/<?php echo $userPhoto ; ?>" alt="user-img" class="user-img"> <span>  <?php echo $sender["Email"] ; ?> <?php echo lang("send you a") ;?>   <?php echo $notification_type; ?>   <span class="date"> <i class="fas fa-clock"></i> <?php echo date( 'j M  Y', strtotime( $notification["date"] ) ); ?>  </span>  </span> </p>
                                                <p class="text-right buttons">
                                                    <a href="<?php echo $notification["type"] . '.php?transferid=' . $notification["transfer_id"] ; ?>" class="btn btn-primary <?php echo $notification["type"] ; ?>"> <i class="fas fa-check"></i> <?php echo lang("Accept") ;?>  </a>                                 
                                                    <a href="" class="btn btn-danger reject-request" tid="<?php echo $notification["transfer_id"] ; ?>" >  <i class="fas fa-times"></i> <?php echo lang("Reject") ;?>  </a>
                                                </p>
                                            
                                            </div>
                                            <hr>
                                            <?php
                                        }
                                    echo '</div>';
                                }
                                ?>
                            </li>
                            <?php
                            
                        }
                    ?>

                    <!-------------------------- Messeges ------------------------------>
                    <?php
                        if( isset( $sessionId ) ){

                            ?>
                            <li class="nav-item"> 
                                <a class="nav-link" href="inbox.php" > <i class="fas fa-envelope"></i> <p class="text"> <?php echo lang("Messeges") ;?>  </p>  </a>
                                <div class="red_circle messege">  </div>
                            </li>
                            <?php
                        }
                    ?>

                    <!-------------------------- Profile -------------------------->
                    <li class="nav-item"> 
                        <?php
                            if( !isset( $sessionId ) ){
                                echo '<a class="nav-link "href="login.php"> <i class="fas fa-user"></i>  </a>';
                            }else{
                                echo '<a class="nav-link "href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" > <i class="fas fa-user"></i> <p class="text"> ' . lang("Profile") . ' </p> </a>';
                                echo '<div class="dropdown-menu profile" aria-labelledby="navbarDropdown">';

                                    if( userType( $sessionId ) == 3 ){
                                        echo '<a class="dropdown-item" href="admin/payments.php"> <i class="fas fa-tools"></i> ' . lang("Admin Panal") . '  </a>';
                                    }elseif( userType( $sessionId ) == 2  ){
                                        echo '<a class="dropdown-item" href="profile.php?sellerid='. $sessionId .'"> <i class="fas fa-user"></i> ' . lang("Profile") . ' </a>';
                                        echo '<a class="dropdown-item" href="mytransfers.php">  <i class="fas fa-money-bill-wave"></i> ' . lang("My Transfers") . ' </a>';
                                    }elseif( userType( $sessionId ) == 1  ){
                                        echo '<a class="dropdown-item" href="mytransfers.php">  <i class="fas fa-money-bill-wave"></i> ' . lang("My Transfers") . ' </a>';
                                    }
                                    echo '<a class="dropdown-item" href="logout.php">  <i class="fas fa-sign-out-alt"></i> ' . lang("LogOut") . ' </a>';
                                echo '</div>';
                            }
                        ?>
                    </li>

                </ul>
            </div>
        </div>
    </nav>