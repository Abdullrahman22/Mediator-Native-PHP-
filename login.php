<?php 
    $pagetitle = "Login";
    include("includes/template/register_header.php");

    if( isset( $_SESSION["loginUserID"] ) ){
        header("Location: index.php");
    }else{


        include("includes/handlers/login-handler.php");

        ?>
            <div id="register-page" class="login-page">
    
                <div class="wrapper">
    
                    <div class="inner">
                        <div class="image-holder">
                            <img src="assets/images/img/money.png" alt="">
                        </div>    
    
                        <form  action="<?php echo  $_SERVER["PHP_SELF"]; ?>" method="POST" >
                            <p> Welcome Back   <i class="far fa-smile-beam"></i> </p>    
                            
                            <?php
                                if( isset( $vertification_error ) ){
                                    echo '<p class="vertification_error">' . $vertification_error . '</p>'; 
                                }

                                if( isset($_SESSION["creating_account_success"])){
                                    echo '<div class="signup-success-messege "> ';
                                        echo '<p class="text-center">';
                                            echo $_SESSION["creating_account_success"] ;
                                        echo '</p>';
                                    echo '</div>';
                                }
                                elseif ( isset($_SESSION["creating_account_failed"]) ) {
                                    echo '<div class="signup-failed-messege "> ';
                                        echo '<p class="text-center">';
                                            echo $_SESSION["creating_account_failed"] ;
                                        echo '</p>';
                                    echo '</div>';
                                }
                                unset( $_SESSION["creating_account_success"] );
                                unset( $_SESSION["creating_account_failed"] );




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

                                <div class="remember_me">

                                    <input type="checkbox" id="remember_me" name="remember_me" value="1">
                                    <label for="remember_me"> Remember me  </label>


                                </div>
                            <!------------------------------ Button ------------------------------>
                            <button type="submit" name="loginBtn" >Login !
                                <i class="zmdi zmdi-arrow-right fas fa-arrow-right"></i>
                            </button>
                            <a href="account_type.php"> Create an account ? </a>
                        </form>
                    </div>
                </div>
    
        
        
            </div>
    
        <?php 
    
            include("includes/template/register_footer.php");
            

    }

    ?>





