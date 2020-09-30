<?php

    include("../../../init.php");

        
    if( isset( $_GET["value"] ) ){

        $value = intval( $_GET["value"] );
        if( checkPaymentExist( $value ) != 0 ){
            $payment = getPaymentInfo( $value );
            ?>

                <div class="desc">
                    <?php
                        $payment_link = $payment["name"] ;
                        $payment_link = str_replace(" ","", $payment_link);
                    ?>
                    <a href="https://www.<?php echo $payment_link ;?>.com" target="_blank"  class="btn btn-primary"> <i class="fas fa-paper-plane"></i> <?php echo lang("Go To Payment Page") ; ?>  </a>
                    <p> <?php echo lang("you can transfer from within your account to our account and include your payment details in the field below") ; ?>   <span class="bold">  <?php echo $payment["our_account"] ;?> </span>  </p>
                </div>
                <div class="waiting">
                    <?php echo lang('Waiting For Payment'); ?> <img src="assets/images/icons/waiting.gif" alt=""> 
                </div>

            <?php
        }
        
        
    }else{
        header("Location: ../../../index.php");
        exit();
    }
