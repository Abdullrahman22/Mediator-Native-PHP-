<?php
    $pagetitle = "Transfer Success"; 
    include("includes/template/header.php"); 

    include "includes/handlers/transfer_done.php"; 

?>
<div id="transfer-done">

    <?php include "includes/components/navbar.php";  ?>

    <div id="page-content">
        <div class="container">


            <h4>  <?php echo lang("<i class='fa fa-check-circle'></i>Your Transfer completed successfully") ;?> </h4>
            <hr>
            <p class="desc">
                <?php echo lang("Thank you for dealing with us.") ;?> <br>
                <?php echo lang("Your payment will be reviewed and confirmed soon, and you will receive a confirmation notification.") ;?>
            </p>


            <div class="form-content" >
                <h5>
                    <i class="fas fa-award"></i>
                    <?php  
                        if( isset( $_SESSION["purchase_done"] ) ){
                            echo lang('Rating Seller');
                        }else{
                            echo lang('Rating Our Services');
                        }
                    ?>
                </h5>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" method="POST" enctype="multipart/form-data">
                    <select id="combostar" name="stars" >
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <span class="rating"> Exellant </span>
                    <textarea name="comment" cols="10" rows="5" minlength="5" maxlength="240"  placeholder="<?php echo lang('Type your comment...') ;?>" class="form-control" required ></textarea>

                    <button class="btn" type="submit" name="add_comment"> <i class="fas fa-comment"></i> <?php echo lang("Add Rating") ;?> </button>

                </form>
            </div>


        </div>
    </div>

</div>



<?php
    include("includes/template/footer.php");
?>
