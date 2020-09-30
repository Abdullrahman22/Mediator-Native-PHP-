<?php
    $pagetitle = "Exchange steps"; 
    include("includes/template/header.php"); 
    
    if( !isset( $_SESSION["loginUserID"] ) ){
        header("Location: login.php");
    }

    include "includes/handlers/exchange_step3.php"; 

?>

<div id="exchange-step3">

    <?php include "includes/components/navbar.php";  ?>


    <div id="page-content">
        <div class="container">



            <div class="info-content">
                <div class="exchange-info">

                    <p> <i class="fas fa-info-circle"></i> <?php echo lang("Transfer info"); ?></p>
                    <hr>
                    
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td> <?php echo lang("Transfer ID"); ?></td>
                                <td><?php echo $transfer_id ; ?></td>
                            </tr>
                            <tr>
                                <td> <?php echo lang("Amount sent"); ?></td>
                                <td class="money"> <?php echo $money_1; ?>$ </td>
                            </tr>
                            <tr>
                                <td><?php echo lang("Amount Recevied"); ?></td>
                                <td class="money" > <?php echo $money_2; ?>$ </td>
                            </tr>
                            <tr>
                                <td> <?php echo lang("From"); ?> </td>
                                <td> You </td>
                            </tr>
                            <tr>
                                <td> <?php echo lang("To"); ?>  </td>
                                <td> <?php echo $email_2; ?> </td>
                            </tr>
                            <tr>
                                <td> <?php echo lang("Transfer Date"); ?> </td>
                                <td> <?php  echo date("d M Y") ; ?> </td>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div>
         

            <div class="complete-step">

                <p class="title">
                    <?php echo lang("Exchange in english") ; ?>
                    <span class="from"> <img src="assets/images/payment-methods/icons/<?php echo $send_row["icon"] ;?>" alt=""> <?php echo $send_row["name"] ;?> </span>
                    <?php echo lang("arrow exchange") ; ?>
                    <span class="from"> <img src="assets/images/payment-methods/icons/<?php echo $receive_row["icon"] ;?>" alt=""> <?php echo $receive_row["name"] ;?> </span>
                    <?php echo lang("Exchange in arabic") ; ?>
                </p>

                <div class="wrap">
                    <div class="links">
                        <div class="dot done"> <?php echo lang("Step 1") ; ?>  </div>
                        <div class="dot done"> <?php echo lang("Step 2") ; ?> </div>
                        <div class="dot current"> <?php echo lang("Step 3") ; ?> </div>
                    </div>
                </div>
                
                
                <div class="lined">
                    <div class="line-div line-before"></div>
                    <p><i class="fas fa-info-circle"></i> <?php echo lang("Confirm Transfer") ; ?> </p>
                    <div class="line-div line-after"></div>
                </div>

                
                <div class="desc">
                    <?php
                        $payment_link = $send_row["name"] ;
                        $payment_link = str_replace(" ","", $payment_link);
                    ?>
                    <a href="https://www.<?php echo $payment_link ;?>.com" target="_blank"  class="btn btn-primary"> <i class="fas fa-paper-plane"></i> <?php echo lang("Go To Payment Page") ; ?>  </a>
                    <p> <?php echo lang("you can transfer from within your account to our account and include your payment details in the field below") ; ?> :  <span class="bold">  <?php echo $send_row["our_account"] ;?> </span>  </p>
                </div>


                <div class="waiting">
                    <?php echo lang('Waiting For Payment'); ?> <img src="assets/images/icons/waiting.gif" alt=""> 
                </div>

                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">

                    <div class="form-content">

                            <!--Details-input-->
                            <label for="details"> <i class="fas fa-info-circle"></i> <?php echo lang("Your payment details") ; ?>  </label>
                            <textarea name="details" id="details" rows="5" class="form-control" minlength="5" maxlength="240"  placeholder="<?php echo lang('You can upload any image with your proof of payment, such as a screenshot of the payment process, etc...');?>" required></textarea>
                            <?php
                                if( isset( $details_error ) ){
                                    echo '<p class="error_messege">' . $details_error . '</p>'; 
                                }
                            ?>
                            <br>

                            <!--upload-input-->
                            <div class="upload-input">
                                <label for="file" id="file-label">  <i class="fas fa-cloud-upload-alt"></i> &nbsp; <?php echo lang("Choose image...") ; ?> </label>
                                <input type="file" class="file form-control" id="file" name="img" required = 'required' /> 
                                <?php
                                    if( isset( $img_error ) ){
                                        echo '<p class="error_messege">' . $img_error . '</p>'; 
                                    }
                                ?>
                            </div>
                            <br>

                        <p> <?php echo lang('<i class="fas fa-info-circle"></i>  Having any problem at paying ? <a href="inbox.php?do=chat&receiver=admin"> Contact Us</a>')?>  </p>
                    </div>    


                    <div class="buttons">

                        <button> <i class="fas fa-times"></i> <?php echo lang("Cancle") ; ?>  </button>
                        <button name="exchange_step3_btn"> <?php echo lang("Confirm") ; ?> <i class="fas fa-check"></i></button>

                    </div>
                </form>
            </div>

        </div>
    </div>


</div>



<?php
    include("includes/template/footer.php");
?>
