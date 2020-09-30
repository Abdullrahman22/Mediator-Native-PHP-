<?php
    $pagetitle = "Exchange steps"; 
    include("includes/template/header.php"); 
    include "includes/handlers/exchange_step.php"; 

?>

<div id="exchange-step">

    <?php include "includes/components/navbar.php";  ?>


    <div id="page-content">
        <div class="container">

            <div class="info-content">
                <div class="exchange-info">

                    <p class="title"> <i class="fas fa-exclamation-triangle"></i> <?php echo lang("Note !!!") ; ?>  </p>
                    <hr>
                    <p class="text">  <?php echo lang("Check that you you have contacted the other party to confirm transfer.") ; ?> </p>

                </div>
                <div class="security-info">
                    <p class="title"> <i class="fas fa-lock"></i>  <?php echo lang("Transfer is Safe") ; ?></p>
                    <hr>
                    <p class="text">  <?php echo lang("Your transfer is protected and secure.") ; ?> </p>
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
				    <div class="dot current"> <?php echo lang("Step 1") ; ?>  </div>
				    <div class="dot disabled"> <?php echo lang("Step 2") ; ?> </div>
				    <div class="dot disabled"> <?php echo lang("Step 3") ; ?> </div>
				  </div>
				</div>
                
                <div class="lined">
                    <div class="line-div line-before"></div>
                    <p> <?php echo lang("Enter the Amount") ; ?>  </p>
                    <div class="line-div line-after"></div>
                </div>

                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

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
                                    <input type="text" class="form-control" name="send" min="0" value="<?php echo getInputValue("send") ;?>"  onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" autocomplete="off" maxlength="5" required />
    
                                </div>
                                <ul>
                                    <li class="maximum" <?php if(isset( $money_1_error )){ echo 'style="color:red"'; } ?> > <?php echo lang('minimun amount in english')  ?> <?php echo $send_row["minimum"] ;?>$   <?php echo lang('minimun amount in arabic')  ?> </li>
                                </ul>
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
                                    <input type="text" class="form-control" name="receive" min="0" value="<?php echo getInputValue("receive") ;?>" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" autocomplete="off" maxlength="5"  required/>
                                </div>
                                <ul>
                                    <li class="maximum" <?php if(isset( $money_2_error )){ echo 'style="color:red"'; } ?> > <?php echo lang('minimun amount in english')  ?> <?php echo $receive_row["minimum"] ;?>$   <?php echo lang('minimun amount in arabic')  ?>  </li>
                                </ul>
                            </h6>
                        </div>

                    </div>


                    <div class="buttons">

                        <button> <i class="fas fa-times"></i> <?php echo lang("Cancle") ; ?> </button>
                        <button name="exchange_step_btn" type="submit"> <?php echo lang("Next Step") ; ?> <i class="fas fa-arrow-right"></i> </button>

                    </div>

                </form>

            </div>



        </div>
    </div>

</div>



<?php
    include("includes/template/footer.php");
?>
