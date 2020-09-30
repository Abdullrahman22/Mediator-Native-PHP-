    <?php

    /*==================  check loginUserID  ==================*/
    if( !isset( $_SESSION["loginUserID"] ) ){
        header("Location: login.php");
    }
   
    /*==================  check transfer session  ==================*/
    if( !isset( $_SESSION["exchange_done"] ) && !isset( $_SESSION["purchase_done"] ) ){
        header("Location: index.php");
    }

    /*==================  Destroy Setps pages Sessions  ==================*/
    unset( $_SESSION["exchane_info"] ); 
    unset( $_SESSION["purchase"] );
    


    /*==================  form submission ==================*/
    if( isset($_POST["add_comment"]) ){


        $sessionId   = $_SESSION["loginUserID"];
        $stars       = (int) security( $_POST["stars"] );
        $comment     = security( $_POST['comment'] );

        $stars_status = $comment_status = 1 ;
        
        //===================== comment Validation ==============================
        if( $comment == "" ){
            $comment_error =  lang("comment is empty") ;
            $comment_status = "";

        }else{
            if(strlen($comment) > 240 || strlen($comment) < 5 ){
                $comment_error = lang("comment must be between 5 and 240 characters") ;
                $comment_status = "";
            }
        }


        //===================== stars Validation ==============================
        if( !is_numeric( $stars ) ){
            header("Location: index.php");
            exit();
        }else{
            if( $stars == "" ){
                header("Location: index.php");
                exit();
            }else{
                if ( $stars < 1 || $stars > 5 ) {
                    header("Location: index.php");
                    exit();
                }
            }
        }



        //===================== Insert comment into DB  ==============================
        if( !empty($stars_status) && !empty($comment_status) ){


            if( isset( $_SESSION["purchase_done"] ) ){

                $sellerId = $_SESSION["purchase_done"];
                //================= Comment For Seller =====================
                $stmt = $con->prepare(" INSERT INTO 
                            comments ( `comment` , `rating` , `user_ID`  , `seller_ID`  )
                            VALUES( :zcomment , :zstars , :zuser_ID , :zseller_ID )");
                $stmt->execute(array(
                    ":zcomment"      => $comment,
                    ":zstars"        => $stars,
                    ":zuser_ID"      => $sessionId,
                    ":zseller_ID"    => $sellerId,
                ));

            }else{

                //================= Comment For Site =====================
                $stmt = $con->prepare(" INSERT INTO 
                            comments ( `comment` , `rating` , `user_ID`  )
                            VALUES( :zcomment , :zstars , :zuser_ID )");
                $stmt->execute(array(
                    ":zcomment"      => $comment,
                    ":zstars"        => $stars,
                    ":zuser_ID"      => $sessionId,
                ));

            }

            
            if( $stmt->rowCount() > 0  ){

                header("Location: index.php");
                exit();

                //======== destroy Sessions For this page =========
                unset( $_SESSION["exchange_done"] );
                unset( $_SESSION["purchase_done"] );

            }else{
                header("Location: index.php");
                exit();

                //======== destroy Sessions For this page =========
                unset( $_SESSION["exchange_done"] );
                unset( $_SESSION["purchase_done"] );

            }




        }

       
    }






















?>