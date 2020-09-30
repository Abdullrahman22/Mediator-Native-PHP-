<?php
    $pagetitle = "Purchase"; 
    include("includes/template/header.php"); 
    include "includes/handlers/purchase.php"; 

?>

<div id="purchase-page">

    <?php include "includes/components/navbar.php";  ?>


    <div id="page-content">
        <div class="container">


            <div class="complete-step">

            
                <p class="title">
                    <span class="from"> <img src="assets/images/payment-methods/icons/<?php echo $category["icon"] ;?>" alt=""> <?php echo $category["name"] ;?>  </span>
                </p>

                
                <div class="lined">
                    <div class="line-div line-before"></div>
                    <p><i class="fas fa-info-circle"></i> <?php echo lang("Confirm Transfer") ; ?> </p>
                    <div class="line-div line-after"></div>
                </div>


                <form action="<?php echo $_SERVER['PHP_SELF'] . "?id=" . $product["id"] ; ?>" method="POST" enctype="multipart/form-data">

                    <div class="form-content">

                            <!-- Payment Method input -->
                            <label for="payment"> <i class="fas fa-money-bill-wave"></i>  <?php echo lang("Payment Method") ; ?> </label>
                            <select id="payment"  name="payment" class="form-control">
                                <option value="0" style="display:none" selected >  <?php echo lang("Choose Payment Method") ; ?></option>
                                <?php
                                    $payments = $product["accepted"] ;
                                    $payments = json_decode( $payments );
                                    foreach( $payments as $payment ){
                                        $payment = getPaymentInfoByName( $payment );
                                        echo '<li>' ;
                                            echo '<option value="'. $payment["id"] .'" > '. $payment["name"] .' </option>';
                                        echo '</li>' ;
                                    }
                                    if( isset( $payment_error ) ){
                                        echo '<p class="error_messege">' . $payment_error . '</p>'; 
                                    }
                                ?>
                            </select>

                            <!--wallet-input-->
                            <label for="wallet"> <i class="fas fa-wallet"></i>  <?php echo  lang('Account'); ?>  </label>
                            <input type="text" name="wallet" class="form-control" id="wallet" value="<?php echo getInputValue("wallet") ;?>" placeholder="<?php echo  lang('Enter Account...'); ?>" autocomplete="off" minlength="5" maxlength="30"  required />
                            <?php
                                if( isset( $wallet_error ) ){
                                    echo '<p class="error_messege">' . $wallet_error . '</p>'; 
                                }
                            ?>
                            <br>

                            <div class="ourAccount-content text-center">

                            </div>

                            <!--phone-input-->
                            <label for="phone">  <i class="fas fa-phone-volume"></i> <?php echo  lang('Phone'); ?> </label>
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="<?php echo  lang('Enter phone number...'); ?>" value="<?php echo getInputValue("phone") ;?>" min="0" value="<?php echo getInputValue("receive") ;?>" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" autocomplete="off" minlength="5" maxlength="30" required/>
                            <?php
                                if( isset( $phone_error ) ){
                                    echo '<p class="error_messege">' . $phone_error . '</p>'; 
                                }
                            ?>
                            <br>
                            

                            <!--Details-input-->
                            <label for="details"> <i class="fas fa-info-circle"></i> <?php echo lang("Your payment details") ; ?> </label>
                            <textarea name="details" id="details" rows="5" class="form-control" minlength="20" maxlength="240"  placeholder="<?php echo lang('You can upload any image with your proof of payment, such as a screenshot of the payment process, etc...');?>" required></textarea>
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

                            <!--checkbox-input-->
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

                        <button> <i class="fas fa-times"></i> <?php echo lang("Cancle") ; ?>   </button>
                        <button name="purchase_btn" type="submit"> <?php echo lang("Confirm") ; ?> <i class="fas fa-check"></i></button>

                    </div>
                </form>
            </div>


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
                                <td class="money"> <?php echo $product["amount_paid"]; ?>$ </td>
                            </tr>
                            <tr>
                            <td><?php echo lang("Amount Recevied"); ?></td>
                                <td class="money"> <?php echo $product["amount"]; ?>$ </td>
                            </tr>
                            <tr>
                                <td> <?php echo lang("From"); ?> </td>
                                <td> You </td>
                            </tr>
                            <tr>
                                <td> <?php echo lang("To"); ?>  </td>
                                <td> <?php echo $seller["Email"]; ?> </td>
                            </tr>
                            <tr>
                                <td> <?php echo lang("Transfer Date"); ?> </td>
                                <td> <?php  echo date("d M Y") ; ?> </td>
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
