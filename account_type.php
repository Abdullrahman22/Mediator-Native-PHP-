<?php 

    $pagetitle = "Account Type";
    include("includes/template/register_header.php");

    if( isset( $_SESSION["loginUserID"] ) ){
        header("Location: index.php");
    }else{



        include("includes/handlers/account-type.php");


        ?>
            <div id="register-page" class="signup-page" >
    

                <div class="wrapper">
                    <div class="inner">
                        <div class="image-holder">
                            <img src="assets/images/img/money.png" alt="">
                        </div>
                        <form  action="<?php echo  $_SERVER["PHP_SELF"]; ?>" method="POST" >
                            <p> <i class="fas fa-pen"></i> Create An Account </p>

                            <div class="accout-type">

                                <p class="title"> Choose from 2 types of accounts : </p>
                                

                                <label class="container"> <span class="custom-head"> Personal Account </span>
                                    <input type="radio" checked="checked" name="accout-type" value="1">
                                    <span class="checkmark"></span>
                                    <p>For example, you can exchange money with people on a personal accounts like you</p>
                                </label>
                                <label class="container"> <span class="custom-head"> Seller Account </span> 
                                    <input type="radio" name="accout-type" value="2">
                                    <span class="checkmark"></span>
                                    <p >Through it you can work with us to gain more customers and transfer money to personal accounts </p>
                                </label>

                                <button class="btn btn-primary" name="accountTypeBtn"> Continue </button>

                            </div>
                            
                            
                            <a href="login.php"> Already have an account ? </a>
                        </form>
                    </div>
                </div>
    

    
        
            </div>

        <?php

            include("includes/template/register_footer.php");

    }
    ?>


