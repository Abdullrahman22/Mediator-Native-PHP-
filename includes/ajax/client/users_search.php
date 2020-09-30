<?php

    include("../../../init.php");

        
    if( isset( $_GET["search_content"] ) ){

        $userid   = $_SESSION["loginUserID"];
        $search_content = $_GET["search_content"] ; 


        $stmt = $con->prepare(" SELECT * FROM `users` WHERE `Email` = ? AND `UserID` != ? AND `GroupID` != 3 AND `Status` = 1 LIMIT 1");
        $stmt->execute(array( $search_content , $userid ));
        $user = $stmt->fetch( );
        $count = $stmt->rowCount();

        if( $count == 1 ){
            ?>

            
                <div class="search-results">
                    <div class="user">
                        <?php
                            if( $user["image"] == ''){
                                echo ' <img src="assets/images/users-img/user-img.png" alt="user-img" class="user-img"> ';
                            }else{
                                echo ' <img src="assets/images/users-img/'. $user["image"] .'" alt="user-img" class="user-img"> ';
                            }
                            echo ucfirst($user["Username"] );
                            echo '<input class="friendID" type="hidden" value="'. $user["UserID"] .'"/>';
                        ?>
                    </div>
                </div>
                <script>
                    $(document).ready( function (){
                        "use strict";
                        $("#exchange-step2 .notify-user").css("display" , "block")
                    });
                </script>

            <?php  
        }else{
            ?>
                
                <div class="no_data text-center">
                    <img src="assets/images/icons/no_data.png" alt="">
                    <p> <?php echo lang('Oops email Not Found !'); ?> </p>
                </div>
                <script>
                    $(document).ready( function (){
                        "use strict";
                        $("#exchange-step2 .notify-user").css("display" , "none")
                    });
                </script>
            <?php
        }




    }else{
        header("Location: ../../../index.php");
        exit();
    }
