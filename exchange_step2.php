<?php
    $pagetitle = "Exchange steps"; 
    include("includes/template/header.php"); 
    include "includes/handlers/exchange_step2.php"; 

?>

<div id="exchange-step2">

    <?php include "includes/components/navbar.php";  ?>

    <div id="page-content">
        <div class="container">


            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                <div class="info-content">
                    <div class="exchange-info">

                        <p class="title"> <i class="fas fa-user-friends"></i>  <?php echo  lang('Now !! Contact with other party and ask him to pay.'); ?> </p>
                        <hr>
                        <div class="search-input">
                            <i class="fas fa-search"></i>
                            <input type="text" class="form-control" placeholder="<?php echo  lang('Search for User...'); ?>" data-type="Search for friends...">
                            <img src="assets/images/icons/loading.gif" alt="">
                        </div>

                        
                        <div class="resulte-box">
                        
                            

                        </div>
                        <span class="btn btn-primary notify-user"> <i class="fab fa-telegram-plane"></i> <?php echo  lang('Notify'); ?></span>
                        <span class="btn btn-primary notify-done" > <i class="fas fa-check"></i>   <?php echo  lang('Notified'); ?> </span>
                        <?php
                            if( isset( $request_sent_error ) ){
                                echo '<p class="error_messege">' . $request_sent_error . '</p>'; 
                            }
                        ?>


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
                        <div class="dot current"> <?php echo lang("Step 2") ; ?> </div>
                        <div class="dot disabled"> <?php echo lang("Step 3") ; ?> </div>
                    </div>
                    </div>
                    
                    <div class="lined">
                        <div class="line-div line-before"></div>
                        <p> <?php echo lang("Enter the Amount") ; ?>  </p>
                        <div class="line-div line-after"></div>
                    </div>



                    <div class="form-content">

                        <?php $userInfo =  getUserInfo( $_SESSION["loginUserID"] ) ; ?>
                        <label for="name"> <i class="fas fa-user"></i> <?php echo  lang('Name'); ?> </label>
                        <input type="text" class="form-control" id="name"  value="<?php echo $userInfo['Username']; ?>" disabled />
                        <br>
            
                        <label for="email"> <i class="fas fa-envelope"></i> <?php echo  lang('Email'); ?> </label>
                        <input type="email" class="form-control" id="email" value="<?php echo $userInfo['Email']; ?>"  disabled />
                        <br>
            
                        <label for="phone">  <i class="fas fa-phone-volume"></i> <?php echo  lang('Phone'); ?>  </label>
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="<?php echo  lang('Enter phone number...'); ?>" value="<?php echo getInputValue("phone") ;?>" min="0" value="<?php echo getInputValue("receive") ;?>" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" autocomplete="off" minlength="5" maxlength="30"  required/>
                        <?php
                            if( isset( $phone_error ) ){
                                echo '<p class="error_messege">' . $phone_error . '</p>'; 
                            }
                        ?>
                        <br>
            
            
                        <label for="wallet"> <img src="assets/images/payment-methods/icons/<?php echo $send_row["icon"] ;?>" alt=""> <?php echo $send_row["name"] ;?> <?php echo  lang('Account'); ?>  </label>
                        <input type="text" name="wallet" class="form-control" id="wallet" value="<?php echo getInputValue("wallet") ;?>" placeholder="<?php echo  lang('Enter Account...'); ?>" autocomplete="off" minlength="5" maxlength="30"  required/>
                        <?php
                            if( isset( $wallet_error ) ){
                                echo '<p class="error_messege">' . $wallet_error . '</p>'; 
                            }
                        ?>
                        <br>
            
                        <input type="checkbox" id="agreement_accepted" name="agreement_accepted" value="1" required="required"/>
                        <label for="agreement_accepted"> <?php echo  lang('I agree to the <a href="terms.php"> terms </a> and conditions'); ?>  </label>
                        <?php
                            if( isset( $agreement_accepted_error ) ){
                                echo '<p class="error_messege">' . $agreement_accepted_error . '</p>'; 
                            }
                        ?>
                        <br>

                    </div>


                    <div class="buttons">

                        <button> <i class="fas fa-times"></i> <?php echo lang("Cancle") ; ?></button>
                        <button name="exchange_step2_btn" type="submit" > <?php echo lang("Next Step") ; ?> <i class="fas fa-arrow-right"></i> </button>

                    </div>


                </div>



            </form>
        </div>
    </div>

</div>



<?php
    include("includes/template/footer.php");
?>
