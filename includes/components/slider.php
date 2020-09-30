<?php

    $sessionId = $_SESSION["loginUserID"] ;
    $myRow  = getUserinfo( $sessionId );
    $username = $myRow["Username"];
    $myPhoto = $myRow["image"];
    if( $myPhoto == "" ){
        $myPhoto = 'user-img.png';
    }


?>
<div class="top-bar">
    <p> <a href="index.php">  <i class="fas fa-home"></i> <?php echo lang("Home") ; ?>  </a> </p>
</div>
<div class="slider-container">
    <div class="profile-info">

        <div class="profile-info-inner">
            <?php
                if( userType( $_SESSION["loginUserID"] ) == 1 ){
                    echo '<form class="userimg" enctype="multipart/form-data">';
                        echo '<label for="img" > <img src="assets/images/users-img/' . $myPhoto .'" alt=""> </label> '; 
                        echo ' <input type="file" class="file form-control" id="img" name="img"  />  '; 
                    echo '</form>';

                }else{
                    echo '<span> <img src="assets/images/users-img/'. $myPhoto .'" alt=""> </span> '; 
                }
            ?>
            <span class="username"> <?php  echo ucfirst( $username ); ?> </span>
        </div>

    </div>
    <div class="search-input">
        <i class='fas fa-search'></i>
        <input type="text" class="form-control" placeholder="Search By Emails...">
        <img src="assets/images/icons/loading.gif" alt="">
    </div>
</div>

<div class="freinds-messages">
    <div class="slider-container">

        <?php
            //============== Mediator.Org Admin Box  =================
            if( userType( $_SESSION["loginUserID"] ) != 3 ){
             ?>
                <div class="friend-messge-box " onclick="location.href='inbox.php?do=chat&receiver=admin'" > <!-- only way to dire-->
                    
                    <div class="friend-img">
                        <img src="assets/images/users-img/admin-img.png" alt="">
                    </div>
                    <div class="messege-info">
                        <div class="friend-name">
                            Mediator.org Admins
                        </div>
                        <div class="friend-messge">
                            
                        <?php
                            //============ create Var $admin_chating_Link ================
                            $admin_chating_Link = "admin_" . $sessionId;
                    
                            if( getLastMsgSender($admin_chating_Link) == $sessionId ){
                                $sender = "You : ";
                            }else{
                                $sender = " ";
                            }

                            if(getLastMsg($admin_chating_Link) == ""){
                                echo 'Contact with us !! <img src="assets/images/icons/waving-icon.png" class="waving-icon" alt=""/> ';
                            }else{

                                if( getLastMsgType($admin_chating_Link) == "text" ){

                                    echo $sender . getLastMsg($admin_chating_Link) ;

                                }elseif( getLastMsgType($admin_chating_Link) == "emoji" ){
                                    
                                    echo  $sender .  '<img src="'. getLastMsg($admin_chating_Link) .  '" class="emoji"/>' ;

                                }elseif( getLastMsgType($admin_chating_Link) == "like" ){
                                    
                                    echo   '<div class="like" > ' . $sender . ' <i class="fas fa-thumbs-up"></i>  </div>'  ;

                                }
                            }
                        ?>
                        </div>
                    </div>
                </div>
             <?php                   
            }
        ?>

        <?php
            //================= Loop To Get Lasted left Freindes Boxes  ===================================
            if( userType( $_SESSION["loginUserID"] ) == 3 ){
                $sessionId = "admin";
            }

        
            $stmt = $con->prepare(" SELECT DISTINCT `chat_Link` FROM `messages` WHERE `Sender_ID` = ? OR `Receiver_ID` = ? GROUP By `msg_id` DESC LIMIT 9999");
            $stmt->execute( array( $sessionId , $sessionId ) );
            $rows = $stmt->fetchAll();

            foreach ($rows  as $row) {

                $friendId = str_replace( $sessionId ,"", $row["chat_Link"] );
                $friendId = str_replace( "_" ,"", $friendId);
            
                if( is_numeric( $friendId ) ){

                    $stmt2 = $con->prepare("SELECT * FROM `users` WHERE UserID = ? LIMIT 1 ");
                    $stmt2->execute( array( $friendId ) );
                    $user = $stmt2->fetch();
                
                    //============ create Var $chating_Link ================
                    if( $sessionId > $friendId ){
                        $chating_Link = $sessionId . "_" . $friendId;
                    }else{
                        $chating_Link = $friendId . "_" . $sessionId;
                    }
                
                    //============ Friend Img ================
                    $friendPhoto = $user["image"];
                    if( $friendPhoto == "" ){
                        $friendPhoto = 'user-img.png';
                    }
                                
                    ?>
                    <div class="friend-messge-box " onclick="location.href='inbox.php?do=chat&receiver=<?php echo $user['UserID'] ;?>'" > <!-- only way to dire-->
                        <div class="friend-img">
                            <img src="assets/images/users-img/<?php  echo $friendPhoto ; ?>" alt="">
                        </div>
                        <div class="messege-info">
                            <div class="friend-name">
                                <?php  echo ucfirst( $user["Username"] ); ?>
                            </div>
                            <div class="friend-messge">
                            <?php
                                if( getLastMsgSender($chating_Link) == $sessionId ){
                                    $sender = "You : ";
                                }else{
                                    $sender = " ";
                                }

                                if(getLastMsg($chating_Link) == ""){
                                    echo 'Say Hi Now !! <img src="assets/images/icons/waving-icon.png" class="waving-icon" alt=""/> ';
                                }else{

                                    if( getLastMsgType($chating_Link) == "text" ){

                                        echo $sender . getLastMsg($chating_Link) ;

                                    }elseif( getLastMsgType($chating_Link) == "emoji" ){
                                        
                                        echo  $sender .  '<img src="'. getLastMsg($chating_Link) .  '" class="emoji"/>' ;

                                    }elseif( getLastMsgType($chating_Link) == "like" ){
                                        
                                        echo   '<div class="like" > ' . $sender . ' <i class="fas fa-thumbs-up"></i>  </div>'  ;

                                    }
                                }
                            ?>
                            </div>
                        </div>
                    </div>

                    <?php

                }

            }
            
        ?>

    </div>
</div>

<div class="search-box">
    <div class="slider-container">

    </div>
</div>
