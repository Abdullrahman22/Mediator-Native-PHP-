<?php



    if(isset($_POST["signUpBtn"])){
        

        $first_name           =  security( $_POST["first_name"] );
        $last_name            =  security( $_POST["last_name"] );
        $username             =  security( $_POST["username"] ); 
        $email                =  security( $_POST["email"] ); 
        $password             =  security( $_POST["password"] ); 
        $account_type         =  security( $_SESSION["account_type_success"] );



        $first_name_status = $last_name_status = $username_status = $email_status = $password_status = $agreement_accepted_status = 1 ;  // make status not empty;

        //===================== short_name Validation ==============================

        if( empty( $first_name ) ){
            $first_name_error = "First name is required";
            $first_name_status = ""; // make first_name_status empty
        }else {
            if( strlen($first_name) > 12 || strlen($first_name) < 2 ){
                $first_name_error = " First name must be between 2 and 12 characters";
                $first_name_status = "";   // make first_name_status  empty
            }else{
                if( empty( $last_name ) ){
                    $last_name_error = "Last name is required";
                    $last_name_status = ""; // make last_name_status empty
                }else{
                    if( strlen($last_name) > 12 || strlen($last_name) < 2 ){
                        $last_name_error = " Last name must be between 2 and 12 characters";
                        $last_name_status = "";   // make last_name_status  empty        
                    }
                }
            }
        }

        //===================== Username Validation ==============================

        if( empty( $username ) ){
            $username_error = "Username is required";
            $username_status = ""; // make username_status empty
        }else {
            if(strlen($username) > 24 || strlen($username) < 5 ){
                $username_error = "Username must be between 5 and 24 characters";
                $username_status = "";   // make username_status  empty
            }else{
                $countUser = checkUsernameExist($username);
                if( $countUser != 0){
                    $username_error = "Sorry this username is exist";
                    $username_status = ""; // make username_status  empty     
                }
            }
        }

        //===================== Email Validation ==============================
        if( empty( $email ) ){
            $email_error = "Email is required";
            $email_status = "";
        }else{
            if( !filter_var( $email , FILTER_VALIDATE_EMAIL ) ){
                $email_error = "Invalide Email";
                $email_status = ""; // make email_status  empty
            }else{
                $countEmail = checkEmailExist($email);
                if( $countEmail != 0 ){
                    $email_error = "Sorry this email is exist";
                    $email_status = ""; // make email_status  empty     
                }
            }
        }


        //===================== password Validation ==============================
        if( empty( $password ) ){
            $password_error = "Password is required";
            $password_status = "";
        }else{
            if(strlen($password) > 25 || strlen($password) < 5 ){
                $password_error = "Password must be between 5 and 25 characters";
                $username_status = "";  // make password_status  empty
            }else{
                if( preg_match("/[^A-Za-z0-9]/" , $password)){
                    $password_error = "Password must only contain numbers and letters";
                    $password_status = ""; // make password_status  empty
                }
            }
        }

        //===================== agreement_accepted Validation ==============================

        if( !isset( $_POST['agreement_accepted'] ) ){ 

            $agreement_accepted_error = "You must accept our agreement accepted ";
            $agreement_accepted_status = "";   // make agreement_accepted_status  empty

        }else{
            if( $_POST['agreement_accepted'] != 1 ){
                $agreement_accepted_error = "You must accept our agreement accepted ";
                $agreement_accepted_status = "";   // make agreement_accepted_status  empty
    
            }
        }
        

        //===================== Insert user into database ==============================
        if( !empty($first_name_status) && !empty($last_name_status) && !empty($username_status) && !empty($email_status) && !empty($password_status) && !empty($agreement_accepted_status) ){
            
            
            //==== token for vertification ====
            $token = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890";
            $token = str_shuffle( $token );
            $token = substr( $token , 0 , 20);

            //==== password hash ====
            $hashPassword = password_hash( $password , PASSWORD_BCRYPT);

            $stmt = $con->prepare(" INSERT INTO 
                                            users (  firstName , lastName , Username , Pass , Email  , GroupID , token ) 
                                            VALUES ( :zfirstName , :zlastName , :zUsername , :zPass , :zEmail  , :zGroupID , :ztoken) ");
            $stmt->execute( array( 
                ":zfirstName"       => $first_name,
                ":zlastName"        => $last_name,
                ":zUsername"        => $username,
                ":zPass"            => $hashPassword,
                ":zEmail"           => $email,
                ":zGroupID"         => $account_type , //  1 = users   ;  2 = seller   ;   3 = admins
                ":ztoken"           => $token 
            ) );

            if($stmt->rowCount() > 0){  // because rowCount() must be 1 at inserting database

                create_session( "creating_account_success" , " <i class='fas fa-check'></i> Create account Successfully" );
                header("Location: login.php");

            }else{

                create_session( "creating_account_failed" , " <i class='fas fa-times'></i> Create account Failed" );
                header("Location: login.php");

            }



        }

        
    }

?>