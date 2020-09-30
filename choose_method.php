<?php
    $pagetitle = "Exchange steps"; 
    include("includes/template/header.php"); 
    include "includes/handlers/choose_method.php"; 

?>

<div id="choose-method">

    <?php include "includes/components/navbar.php";  ?>

    <div id="page-content">
        <div class="container">

            <div class="info-content">
                <div class="exchange-info">
                    <p class="title"> <i class="fas fa-info-circle"></i> <?php echo lang("Minimum transferable amount") ; ?>  </p>
                    <hr>
                    <div class="text">
                        <ul class="list-unstyled">
                            
                            <?php
                                $rows = getAllTable( "payment_methods" );
                                foreach( $rows as $row ){
                                    echo '<li>' ;
                                        echo '<img class="payment-img" src="assets/images/payment-methods/icons/'. $row["icon"] .'" alt="payment-img">';
                                        echo '<span class="payment-name">' . $row["name"] . '</span> :';
                                        echo ' <span class="minimum-amount">'.  $row["minimum"] .'$</span> ';
                                    echo '</li>' ;
                                }
                            ?>

                        </ul>
                    </div>
                </div>
                <div class="security-info">
                    <p class="title"> <i class="fas fa-lock"></i> <?php echo lang("Transfer is Safe") ; ?> </p>
                    <hr>
                    <p class="text">  <?php echo lang("Your transfer is protected and secure.") ; ?> </p>
                </div>
            </div>

            <div class="complete-step ">
                <p class="title"> <i class="fas fa-handshake"></i> <?php echo lang("Start Exchange") ; ?> </p>
                <hr>
                <div class="transfer-form">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="row">
                            <div class="col-md-5"> 
                                <h5> Send <i class="fas fa-arrow-up"></i> </h5>
                                <select id="send" name="send" class="form-control" required="true" >
                                    <option value="0" style="display:none" selected >  <?php echo lang("Choose Payment Method") ; ?> </option>
                                    <?php
                                        $rows = getAllTable( "payment_methods" );
                                        foreach( $rows as $row ){
                                            echo '<li>' ;
                                                echo '<option value="'. $row["id"] .'" > '. $row["name"] .' </option>';
                                            echo '</li>' ;
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-2 text-center"> <i class="fas fa-exchange-alt "></i> </div>
                            <div class="col-md-5"> 
                                <h5> Receive <i class="fas fa-arrow-down"></i></h5>
                                <select id="receive"  name="receive" class="form-control" required="true" >
                                    <option value="0" style="display:none" selected >  <?php echo lang("Choose Payment Method") ; ?>  </option>
                                    <?php
                                        $rows = getAllTable( "payment_methods" );
                                        foreach( $rows as $row ){
                                            echo '<li>' ;
                                                echo '<option value="'. $row["id"] .'" > '. $row["name"] .' </option>';
                                            echo '</li>' ;
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <button type="submit" name="choose_method_btn" >
                            <?php echo lang("Transfer") ; ?>  <i class="fas fa-sync-alt"></i> 
                        </button>
                    </form>
                    <div class="errors">
                        <ul>
                            <?php
                                if( isset( $receive_error ) ){
                                    echo '<li class="error_messege">  ' . $receive_error . '</li>'; 
                                }
                                if( isset( $send_error ) ){
                                    echo '<li class="error_messege">  ' . $send_error . '</li>'; 
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>


         
        </div>
    </div>



<?php
    include("includes/template/footer.php");
?>
