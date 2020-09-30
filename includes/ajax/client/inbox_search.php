<?php

    include("../../../init.php");

    if (isset($_SESSION["loginUserID"])) {
    
        $sessionId = $_SESSION["loginUserID"] ;

        
        if( isset( $_GET["search_content"] ) ){

    
            $search_content = $_GET["search_content"] ; 
    
    
            $stmt = $con->prepare(" SELECT * FROM `users` WHERE `Email` = ? AND UserID != ? AND GroupID != 3 LIMIT 1");
            $stmt->execute(array( $search_content , $sessionId ));
            $user = $stmt->fetch();
            $count = $stmt->rowCount();

            if( $count == 1 ){

                $userid = $user['UserID'];
                if( $sessionId > $userid ){
                    $chating_Link = $sessionId . "_" . $userid;
                }else{
                    $chating_Link = $userid . "_" . $sessionId;
                }

                $UserPhoto = $user["image"];
                if( $UserPhoto == "" ){
                    $UserPhoto = 'user-img.png';
                }

                ?>

                    <div class="friend-messge-box" onclick="location.href='inbox.php?do=chat&receiver=<?php echo $user['UserID'] ;?>'" uid = "<?php echo $user['UserID'] ;?>"> <!-- only way to dire-->
                        <div class="friend-img">
                            <img src="assets/images/users-img/<?php echo $UserPhoto ; ?>" alt="">
                        </div>
                        <div class="messege-info">
                            <div class="friend-name">
                                <?php  echo ucfirst( $user["Username"] ); ?>
                            </div>
                            <div class="friend-messge">
                                <?php
                                    
                                    if(  getLastMsgSender($chating_Link) == $sessionId ){
                                        $sender = "You : ";
                                    }else{
                                        $sender = " ";
                                    }
                                    if(  getLastMsg($chating_Link) == ""){
                                        echo 'Say Hi Now !! <img src="assets/images/icons/waving-icon.png" class="waving-icon" alt=""/> ';
                                    }else{

                                        if( getLastMsgType($chating_Link) == "text" ){

                                            echo $sender .   getLastMsg($chating_Link) ;

                                        }elseif( getLastMsgType($chating_Link) == "jpg" || getLastMsgType($chating_Link) == "png" ||   getLastMsgType($chating_Link) == "jpeg"  ){
                                            
                                            echo $sender .  '<i class="far fa-images"></i> ' . getLastMsg($chating_Link) ;

                                        }elseif( getLastMsgType($chating_Link) == "emoji" ){
                                            
                                            echo  $sender .  '<img src="'.   getLastMsg($chating_Link) .  '" class="emoji"/>' ;

                                        }elseif( getLastMsgType($chating_Link) == "like" ){
                                            
                                            echo   '<div class="like" > ' . $sender .   getLastMsg($chating_Link) .'  </div>'  ;

                                        }


                                    }

                                ?>
                            </div>
                        </div>
                    </div>

                <?php                
            }else{
                ?>
                
                    <div class="no_data text-center">
                        <img src="assets/images/icons/no_data.png" alt="">
                        <p >Name Not Found !</p>
                    </div>

                <?php
            }
    
    
    
    
        }
    
    }else{
        header("Location: ../../../index.php");
    }

