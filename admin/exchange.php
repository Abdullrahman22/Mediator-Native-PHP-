<?php
    $pagetitle = "View Exchange"; 
    include("../includes/template/admin_header.php");


    if( isset( $_GET["transferid"] ) ){
        $transferid = security( $_GET["transferid"] );
    }else{
        $transferid = "0";
    }
    if( checkExchangeExist( $transferid ) == 0 ){
        header("Location: ../index.php");
    }else {
        $exchange = getExchangeInfo( $transferid ) ;


        //================ review_btn ===================
        if( isset($_POST["review_btn"]) ){

            $status    = security($_POST['status']);
            $comment   = security($_POST['comment']);

            $status_status = $comment_status = 1 ;


            //===================== status Validation ==============================
            if( $status != "0" &&  $status != "1" && $status != "2"){
                $status_error =  "status is required";
                $status_status = "";
            }

            //===================== comment Validation ==============================
            if( $comment == "" ){
                $comment_error  =  "comment is empty";
                $comment_status = "";

            }else{
                if(strlen($comment) > 240 || strlen($comment) < 5 ){
                    $comment_error  =  "comment must be between 5 and 240 characters";
                    $comment_status = "";
                }
            }
            
            //===================== insert into DB ==============================
            if( !empty($comment_status) && !empty($status_status)  ){

                $stmt = $con->prepare("UPDATE exchanges 
                                            SET comment = ? , `status` = ? 
                                            WHERE transfer_id=? ");
                $stmt->execute( array( $comment , $status , $transferid ) );    
                if( $stmt->rowCount() > 0 ){
                    header("Location: exchange.php?transferid=". $transferid );
                    exit();
                }else{
                    header("Location: exchange.php?transferid=". $transferid );
                    exit();
                }

            }
        }

        ?>
            <div id="exchange-page" class="container">
                
                <h4 class="title"> <i class="fas fa-info-circle"></i> Exchange Info </h4>
                <hr>
                <?php
                    /*===== sessions_messeges ========*/
                    include "../includes/components/sessions_messeges.php";
                ?>
                <div class="panel">

                    <table class="table table-striped ">
                        <tbody>
                            <tr>
                                <td> Exchange ID  </td>
                                <td> <?php echo $exchange['transfer_id']; ?> </td>
                                <input type="hidden" value="<?php echo $exchange['transfer_id']; ?>" class="transferid"/>
                            </tr>
                            <tr>
                                <td> Exchange Date  </td>
                                <td> 
                                    <?php 
                                        $dbDate = strtotime(  $exchange["date"] );
                                        $date =  date("d M Y", $dbDate ) ;
                                        echo $date;
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td> Status </td>
                                <td>
                                    <?php
                                        if( $exchange["status"] == 0 ){
                                            echo ' <div class="pendding"> <i class="fas fa-spinner"></i> Pendding </div> ';
                                        }elseif( $exchange["status"] == 1 ){
                                            echo ' <div class="success"> <i class="fas fa-check"></i> Success </div> ';
                                        }elseif( $exchange["status"] == 2 ){
                                            echo ' <div class="reject"> <i class="fas fa-times"></i> Reject </div> ';
                                        }
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="panel-heading 1st">1st User <i class="fas fa-arrow-circle-down"></i> </div>
                    <div class="panel-body 1st">

                        <table class="table table-striped ">
                        
                            <tbody>
                                
                                
                                <tr>
                                    <td> <i class="fas fa-envelope"></i>  Email </td>
                                    <td> <?php echo $exchange['email_1']; ?> </td>
                                </tr>
                                
                                <tr>
                                    <td> <i class="fas fa-dollar-sign"></i>  Money </td>
                                    <td> <?php echo $exchange['money_1']; ?>$ </td>
                                </tr>
                                
                                <tr>
                                    <td> <i class="fas fa-money-bill-wave"></i>  Payment method </td>
                                    <td> 
                                        <?php
                                            $payment = getPaymentInfo( $exchange['method_1'] ) ;
                                            echo $payment['name'];
                                        ?> 
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td> <i class="fas fa-wallet"></i>  wallet </td>
                                    <td> <?php echo $exchange['wallet_1']; ?> </td>
                                </tr>
                                
                                <tr>
                                    <td> <i class="fas fa-phone-volume"></i>  phone </td>
                                    <td> <?php echo $exchange['phone_1']; ?> </td>
                                </tr>
                                
                                <tr>
                                    <td> <i class="fas fa-images"></i>  Proof </td>
                                    <td> <a href="../assets/images/proof-images/<?php echo $exchange['proof_1']; ?>" target="_blank"> <?php echo $exchange['proof_1']; ?> </a> </td>

                                </tr>
                                
                                <tr>
                                    <td> <i class="fas fa-comment"></i>  details </td>
                                    <td> <?php echo $exchange['details_1']; ?> </td>
                                </tr>
                                
                                

                            </tbody>
                        </table>

                    </div>

                    <div class="panel-heading 2nd">2st User <i class="fas fa-arrow-circle-down"></i> </div>
                    <div class="panel-body 2nd">

                        <table class="table table-striped ">
                        
                            <tbody>
                                
                                
                                <tr>
                                    <td> <i class="fas fa-envelope"></i>  Email </td>
                                    <td> <?php echo $exchange['email_2']; ?> </td>
                                </tr>
                                
                                <tr>
                                    <td> <i class="fas fa-dollar-sign"></i>  Money </td>
                                    <td> <?php echo $exchange['money_2']; ?>$ </td>
                                </tr>
                                
                                <tr>
                                    <td> <i class="fas fa-money-bill-wave"></i>  Payment method </td>
                                    <td> 
                                        <?php
                                            $payment2 = getPaymentInfo( $exchange['method_2'] ) ;
                                            echo $payment2['name'];
                                        ?> 
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td> <i class="fas fa-wallet"></i>  wallet </td>
                                    <td> <?php echo $exchange['wallet_2']; ?> </td>
                                </tr>
                                
                                <tr>
                                    <td> <i class="fas fa-phone-volume"></i>  phone </td>
                                    <td> <?php echo $exchange['phone_2']; ?> </td>
                                </tr>
                                
                                <tr>
                                    <td> <i class="fas fa-images"></i>  Proof </td>
                                    <td> <a href="../assets/images/proof-images/<?php echo $exchange['proof_2']; ?>" target="_blank"> <?php echo $exchange['proof_1']; ?> </a> </td>
                                </tr>
                                
                                <tr>
                                    <td> <i class="fas fa-comment"></i>  details </td>
                                    <td> <?php echo $exchange['details_2']; ?> </td>
                                </tr>

                            </tbody>
                        </table>

                    </div>

                    <div class="transfer-comment">
                        <form action="<?php echo $_SERVER['PHP_SELF'] ."?transferid=". $transferid ;?>" method="POST" enctype="multipart/form-data">
                                        
                            <!--comment input-->
                            <label for="comment"> <i class="fas fa-info-circle"></i> Transfer Comment :</label>
                            <textarea name="comment" id="comment" rows="5" class="form-control" minlength="5" maxlength="240"  placeholder="Type a transfer comment.." required> <?php echo $exchange["comment"] ;?></textarea>
                            <?php
                                if( isset( $comment_error ) ){
                                    echo '<p class="error-messege">' . $comment_error . '</p>'; 
                                }
                            ?>
                            <hr>
                            
                            <!--status input-->
                            <label for="comment"> <i class="fas fa-info-circle"></i> Transfer Status :</label>
                            <select name="status" id="status" class="form-control">
                                <option value="0" <?php if( $exchange["status"] == 0 ){ echo "selected"; } ?> > Pendding </option>
                                <option value="1" <?php if( $exchange["status"] == 1 ){ echo "selected"; } ?>> Accepted </option>
                                <option value="2" <?php if( $exchange["status"] == 2 ){ echo "selected"; } ?> > Reject </option>
                            </select>
                            <?php
                                if( isset( $status_error ) ){
                                    echo '<p class="error-messege">' . $status_error . '</p>'; 
                                }
                            ?>
                            <br>

                            <button type="submit" name="review_btn" class="btn btn-success"> <i class="fas fa-tasks"></i> Submit Transfer </button>
                        </form>
                    </div>

                </div>
                

                        
            </div>
            
<?php
    }
    include("../includes/template/admin_footer.php");
?>
