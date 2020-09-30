<?php

    if( userType( $_SESSION["loginUserID"] ) == 3 ){
        $sessionId = "admin";
    }else{
        $sessionId = $_SESSION["loginUserID"] ;
    }

    $receiver =   security( $_GET["receiver"] ) ; 

    if( $receiver == "admin" ){
        $chat_Link = "admin_" . $sessionId;
    }elseif( $sessionId == "admin" ){
        $chat_Link = "admin_" . $receiver;
    }else{
        if( $sessionId > $receiver ){
            $chat_Link = $sessionId . "_" . $receiver;
        }else{
            $chat_Link = $receiver . "_" . $sessionId;
        }
    }
    


    /*============= choose num of lasted messeges ====================================*/
    $stmt2= $con->prepare("SELECT count(chat_Link) FROM messages  WHERE chat_Link = ? ");
    $stmt2->execute( array( $chat_Link ) );
    $staffrow = $stmt2->fetch(PDO::FETCH_NUM);
    $last_row_msg = $staffrow[0];
    $last_15_row_msg = $last_row_msg - 10;
    if( $last_15_row_msg < 0 ){
        $last_15_row_msg = 0;
    }

    /*============= get messeges in $rows ======================================*/
    $stmt = $con->prepare("SELECT 
                    *
                    FROM 
                        messages
                    WHERE 
                        chat_Link = ? ORDER BY msg_time  LIMIT  $last_15_row_msg , $last_row_msg  ");
    $stmt->execute( array( $chat_Link ) );
    $rows = $stmt->fetchAll();

    foreach( $rows as $row){

        /*=============================================================================================
        ===============================================================================================
        ====================== Get user messeges ====================================================*/
        
        if ( $row["Sender_ID"] == $sessionId ){
            if( $row["msg_type"] == "text" ){
                echo    '<div class="my-message">

                            <div class="my-message-inner">
                                <div class="my-message-content">
                                    <div class="date">
                                        <div> '. time_ago( $row["msg_time"])  .'  </div>
                                    </div>
                                    <div class="message">
                                        <span class="triangle"></span>
                                        '. $row["message"] .' 
                                    </div>
                                </div>
                            </div>
                        
                        </div> ';
            }elseif(  $row["msg_type"] == "emoji" ){
                echo    '<div class="my-message my_emoji">

                            <div class="my-message-inner">
                                <div class="my-message-content">
                                    <div class="date"> 
                                        <div> '. time_ago( $row["msg_time"])  .'  </div>
                                    </div>
                                    <div class="message">
                                        <img src=" '. $row["message"] .' "  alt=""/>
                                    </div>
                                </div>
                            </div>
                    
                        </div> ';
            }elseif(  $row["msg_type"] == "like" ){
                echo    '<div class="my-message my_like">

                            <div class="my-message-inner">
                                <div class="my-message-content">
                                    <div class="date"> 
                                        <div> '. time_ago( $row["msg_time"])  .'  </div>
                                    </div>
                                    <div class="message">
                                        <i class="fas fa-thumbs-up"></i>
                                    </div>
                                </div>
                            </div>
                    
                        </div> ';
            }elseif( $row["msg_type"] == "jpg" || $row["msg_type"] == "jpeg"  || $row["msg_type"] == "png" ){
                echo    '<div class="my-message my_photo">

                            <div class="my-message-inner">
                                <div class="my-message-content">
                                    <div class="date">
                                        <div> '. time_ago( $row["msg_time"])  .'  </div>
                                    </div>
                                    <div class="message">
                                        <img src="assets/images/files-sent/'. $row["message"] .'" alt=""/>
                                    </div>
                                </div>
                            </div>
                    
                        </div> ';
            }

        }elseif( $row["Sender_ID"] == $receiver ){

            if( $row["msg_type"] == "text" ){
                    echo '<div class="friend-messege">
                            <div class="friend-messege-content">
                                <div class="friend-info">
                                    <span class="date ">
                                        <div> '. time_ago( $row["msg_time"])  .'  </div>
                                    </span>
                                </div>
                                <div class="message">
                                    <span class="triangle"></span>
                                    '. $row["message"] .' 
                                </div>
                            </div>
                        </div>';
            }elseif(  $row["msg_type"] == "emoji" ){

                echo    '<div class="friend-messege friend_emoji">
                            <div class="friend-messege-content">
                                <div class="friend-info">
                                    <span class="date">
                                        <div> '. time_ago( $row["msg_time"])  .'  </div>
                                    </span>
                                </div>
                                <div class="message">
                                    <img src=" '. $row["message"] .' "  alt=""/>
                                </div>
                            </div>
                        </div>';
            }elseif(  $row["msg_type"] == "like" ){

                echo    '<div class="friend-messege friend_like">
                            <div class="friend-messege-content">
                                <div class="friend-info">
                                    <span class="date">
                                        <div> '. time_ago( $row["msg_time"])  .'  </div>
                                    </span>
                                </div>
                                <div class="message">
                                    <i class="fas fa-thumbs-up"></i>
                                </div>
                            </div>
                        </div>';
            }elseif( $row["msg_type"] == "jpg" || $row["msg_type"] == "jpeg"  || $row["msg_type"] == "png" ){
                echo    '<div class="friend-messege friend_photo">
                            <div class="friend-messege-content">
                                <div class="friend-info">
                                    <span class="date">
                                        <div> '. time_ago( $row["msg_time"])  .'  </div>
                                    </span>
                                </div>
                                <div class="message">
                                    <img src="assets/images/files-sent/'. $row["message"] .'" alt=""/>
                                </div>
                            </div>
                        </div>';
            }

        }
        
    }











            
        
