<?php
    $pagetitle = "Purchase Request"; 
    
    include("includes/template/header.php");
    include "includes/handlers/purchase_request.php"; 


?>

<div id="payment-request">

    <?php include "includes/components/navbar.php";  ?>


    <div id="page-content">
        <div class="container">


            <div class="complete-step">

                <?php
                    /*===== get transfer id from DB =========*/
                    $row = getTransferInfo( $transferid ) ;
                    /*===== get send and receive row =========*/
                    $send          =  $row["method_2"];
                    $send_row      =  getPaymentInfo($send);
                    $receive       =  $row["method_1"];
                    $receive_row   =  getPaymentInfo($receive);

                ?>
                <p class="title">
                    <?php echo lang("Purchase Process en") ; ?>
                    <span class="from"> <img src="assets/images/payment-methods/icons/<?php echo $send_row["icon"] ;?>" alt="">  <?php echo $send_row["name"] ;?> </span>
                    <?php echo lang("Purchase Process ar") ; ?>

                </p>

                <div class="lined">
                    <div class="line-div line-before"></div>
                    <p><i class="fas fa-info-circle"></i> <?php echo lang("Confirm Transfer") ; ?> </p>
                    <div class="line-div line-after"></div>
                </div>

                <p class="request-text">
                    <span class="bold">   <i class="fas fa-exclamation-triangle"></i> <?php echo $row["email_1"] ;?> </span> <?php echo lang("send you a Purchase request if your are accept confirm the transfer now .");?>
                </p>

                <div class="row counting-amount">
                    <div class="col-md-6">
                        <h6>
                            <div class="transfer-info">
                                <?php echo lang("Money Send") ; ?>
                                <i class="fas fa-arrow-left"></i>
                                <img class="payment-method" src="assets/images/payment-methods/icons/<?php echo $send_row["icon"] ;?>" alt="">
                            </div>
                            <div class="input-group">
                                <span class="input-group-icon">
                                    USD
                                    <img class="payment-method" src="assets/images/payment-methods/icons/<?php echo $send_row["icon"] ;?>" alt="">
                                </span>
                                <input type="number" class="form-control" value="<?php echo $row["money_2"] ;?>" disabled/>
                            </div>
                        </h6>
                    </div>
                    <div class="col-md-6">
                        <h6>
                            <div class="transfer-info">
                                <?php echo lang("Money Recevied") ; ?>
                                <i class="fas fa-arrow-right"></i>
                                <img class="payment-method" src="assets/images/payment-methods/icons/<?php echo $receive_row["icon"] ;?>" alt="">
                            </div>
                            <div class="input-group">
                                <span class="input-group-icon">
                                    USD
                                    <img class="payment-method" src="assets/images/payment-methods/icons/<?php echo $receive_row["icon"] ;?>" alt="">
                                </span>
                                <input type="number" class="form-control" value="<?php echo $row["money_1"] ;?>" disabled/>
  
                            </div>
                        </h6>
                    </div>
                </div>


                
                <div class="desc">
                    <?php
                        $payment_link = $send_row["name"] ;
                        $payment_link = str_replace(" ","", $payment_link);
                    ?>
                    <a href="https://www.<?php echo $payment_link ;?>.com" target="_blank" class="btn btn-primary"> <i class="fas fa-paper-plane"></i>  <?php echo lang("Go To Payment Page") ; ?> </a>
                    <p> <?php echo lang("you can transfer from within your account to our account and include your payment details in the field below") ; ?>   <span class="bold">  <?php echo $send_row["our_account"] ;?> </span>  </p>
                </div>


                <div class="waiting">
                    <?php echo lang('Waiting For Payment'); ?> <img src="assets/images/icons/waiting.gif" alt=""> 
                </div>

                <form action="<?php echo $_SERVER['PHP_SELF'] ."?transferid=". $row["transfer_id"] ; ?>" method="POST" enctype="multipart/form-data">

                    <div class="form-content">
                        
                        <!--- phone Field ---->
                        <label for="phone">  <i class="fas fa-phone-volume"></i>  <?php echo  lang('Phone'); ?> </label>
                        <input type="text" name="phone" class="form-control" id="phone" minlength="5" maxlength="30" placeholder="<?php echo  lang('Enter phone number...'); ?>"  value="<?php echo getInputValue("phone") ;?>" min="0" value="<?php echo getInputValue("receive") ;?>" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" autocomplete="off"  required/>
                        <?php
                            if( isset( $phone_error ) ){
                                echo '<p class="error_messege">' . $phone_error . '</p>'; 
                            }
                        ?>
                        <br>

                        <!--- wallet Field ---->
                        <label for="wallet"> <img src="assets/images/payment-methods/icons/<?php echo $send_row["icon"] ;?>" alt=""> <?php echo $send_row["name"] ;?> <?php echo  lang('Account'); ?> </label>
                        <input type="text" name="wallet" class="form-control" id="wallet" minlength="5" maxlength="30"  value="<?php echo getInputValue("wallet") ;?>" placeholder="<?php echo  lang('Enter Account...'); ?>"   autocomplete="off"  required />
                        <?php
                            if( isset( $wallet_error ) ){
                                echo '<p class="error_messege">' . $wallet_error . '</p>'; 
                            }
                        ?>
                        <br>

                        <!--- details Field ---->
                        <label for="details"> <i class="fas fa-info-circle"></i> <?php echo lang("Your payment details") ; ?>   </label>
                        <textarea name="details" id="details" rows="5" class="form-control" minlength="5" maxlength="240"  placeholder="<?php echo lang('You can upload any image with your proof of payment, such as a screenshot of the payment process, etc...');?>" required></textarea>
                        <?php
                            if( isset( $details_error ) ){
                                echo '<p class="error_messege">' . $details_error . '</p>'; 
                            }
                        ?>
                        <br>
                        
                        <!--upload-input-->
                        <div class="upload-input">
                            <label for="file" id="file-label">  <i class="fas fa-cloud-upload-alt"></i> &nbsp;  <?php echo lang("Choose image...") ; ?>   </label>
                            <input type="file" class="file form-control" id="file" name="img" required = 'required' /> 
                            <?php
                                if( isset( $img_error ) ){
                                    echo '<p class="error_messege">' . $img_error . '</p>'; 
                                }
                            ?>
                        </div>
                        
                        <!--- checkbox Field ---->
                        <input type="checkbox" id="agreement_accepted" name="agreement_accepted" value="1" required/>
                        <label for="agreement_accepted"> <?php echo  lang('I agree to the <a href="terms.php"> terms </a> and conditions'); ?>  </label>
                        <?php
                            if( isset( $agreement_accepted_error ) ){
                                echo '<p class="error_messege">' . $agreement_accepted_error . '</p>'; 
                            }
                        ?>
                        <br>

                        <p> <?php echo lang('<i class="fas fa-info-circle"></i>  Having any problem at paying ? <a href="inbox.php?do=chat&receiver=admin"> Contact Us</a>')?>  </p>
                        
                    </div>    

                    <div class="buttons">

                        <button onclick="window.location.href='index.php'" > <i class="fas fa-times"></i>  <?php echo lang("Cancle") ; ?></button>
                        <button name="purchase_request_btn" type="submit"> <?php echo lang("Confirm") ; ?> <i class="fas fa-check"></i></button>

                    </div>
                </form>
            </div>


            <div class="info-content">
                <div class="exchange-info">

                    <p> <i class="fas fa-info-circle"></i> Transfer info</p>
                    <hr>
                    
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td> <?php echo lang("Transfer ID"); ?></td>
                                <td><?php echo $row["transfer_id"] ;?> </td>
                            </tr>
                            <tr>
                                <td> <?php echo lang("Amount sent"); ?></td>
                                <td class="money"> <?php echo $row["money_2"] ;?>$ </td>
                            </tr>
                            <tr>
                                <td><?php echo lang("Amount Recevied"); ?></td>
                                <td class="money" > <?php echo $row["money_1"] ;?>$ </td>
                            </tr>
                            <tr>
                                <td> <?php echo lang("From"); ?> </td>
                                <td> You </td>
                            </tr>
                            <tr>
                                <td> <?php echo lang("To"); ?>  </td>
                                <td> <?php echo $row["email_1"] ;?> </td>
                            </tr>
                            <tr>
                                <td> <?php echo lang("Transfer Date"); ?> </td>
                                <td>
                                    <?php 
                                        $dbDate = strtotime(  $row["date"] );
                                        $date =  date("d M Y", $dbDate ) ;
                                        echo $date;
                                    ?> 
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div>
         



        </div>
    </div>


</div>



<?php
    include("includes/template/footer.php");
?>
