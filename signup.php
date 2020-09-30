<?php 






    $pagetitle = "SignUp";
    include("includes/template/register_header.php");



    /*   check user pass from account_type page   */
    if( !isset( $_SESSION["account_type_success"] )  ){
        header("Location: account_type.php");
    }else{
        

        /*   if user has login no allow to be in signup page  */
        if( isset( $_SESSION["loginUserID"] )  ){
            header("Location: index.php");
        }else{



            include("includes/handlers/signup-handler.php");

            ?>
                <div id="register-page" class="signup-page" >


                    <div class="wrapper">
                        <div class="inner">
                            <div class="image-holder">
                                <img src="assets/images/img/money.png" alt="">
                            </div>
                            <form  action="<?php echo  $_SERVER["PHP_SELF"]; ?>" method="POST" >
                                <p> <i class="fas fa-pen"></i> Create An Account </p>

                                <div class="form-inner">
                                    <!------------------------------ First name - Last name ------------------------------>
                                    <div class="form-group">
                                        <input type="text" placeholder="First Name" name ="first_name" class="form_control" value="<?php  echo getInputValue("first_name");  ?>" autocomplete="off"  required />
                                        <input type="text" placeholder="Last Name" name ="last_name" class="form_control" value="<?php  echo getInputValue("last_name");  ?>" autocomplete="off"  required />
                                    </div>
                                    <?php
                                        if( isset( $first_name_error ) ){
                                            echo '<p class="error_messege">' . $first_name_error . '</p>'; 
                                        }
                                    ?>
                                    <?php
                                        if( isset( $last_name_error ) ){
                                            echo '<p class="error_messege">' . $last_name_error . '</p>'; 
                                        }
                                    ?>
                                    <!------------------------------ username------------------------------>
            
                                    <div class="form-wrapper">
                                        <input type="text" placeholder="Username" name ="username" class="form_control" value="<?php  echo getInputValue("username");  ?>" autocomplete="off"  required />
                                        <i class="zmdi zmdi-account fas fa-user"></i>
                                    </div>
                                    <?php
                                        if( isset( $username_error ) ){
                                            echo '<p class="error_messege">' . $username_error . '</p>'; 
                                        }
                                    ?>
            
                                    <!------------------------------ email ------------------------------>
            
                                    <div class="form-wrapper">
                                        <input type="text" placeholder="Email Address" name ="email" class="form_control" value="<?php  echo getInputValue("email");  ?>" autocomplete="off"  required />
                                        <i class="zmdi zmdi-email fas fa-envelope"></i>
                                    </div>
                                    <?php
                                        if( isset( $email_error ) ){
                                            echo '<p class="error_messege">' . $email_error . '</p>'; 
                                        }
                                    ?>
            
                                    <!------------------------------ Password ------------------------------>
            
                                    <div class="form-wrapper">
                                        <input type="password" placeholder="Password" name ="password" class="form_control" value="<?php  echo getInputValue("password");  ?>" autocomplete="new-password" required/>
                                        <i class=" zmdi zmdi-lock fa fa-eye" style="display: none"></i> 
                                        <i class=" zmdi zmdi-lock fa fa-eye-slash" ></i> 
                                    </div>
                                    <?php
                                        if( isset( $password_error ) ){
                                            echo '<p class="error_messege">' . $password_error . '</p>'; 
                                        }
                                    ?>

                                    <!------------------------------ check box  ------------------------------>

                                    <div class="agreement_accepted">

                                        <input type="checkbox" id="agreement_accepted" name="agreement_accepted" value="1">
                                        <label for="agreement_accepted"> By Registering, you agree that you've read and accepted our <a href="#"> User Agreement </a>  , and you consent to our <a href="#"> Privacy Notice </a>  </label>
                                        <?php
                                            if( isset( $agreement_accepted_error ) ){
                                                echo '<p class="error_messege">' . $agreement_accepted_error . '</p>'; 
                                            }
                                        ?>

                                    </div>

                                    <!------------------------------ Button ------------------------------>
                                    <button type="submit" name="signUpBtn" >Register !
                                        <i class="zmdi zmdi-arrow-right fas fa-arrow-right"></i>
                                    </button>


                                </div>
                                
                                <a href="login.php"> Already have an account ? </a>
                            </form>
                        </div>
                    </div>



            
                </div>

            <?php

                include("includes/template/register_footer.php");

        }

        
    } 
    ?>


