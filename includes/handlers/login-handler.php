<?php

    if(isset($_POST["loginBtn"])){
        

        $email             =  security( $_POST["email"] ); 
        $password          =  security( $_POST["password"] ); 

        $email_status = $password_status = $vertification_status = 1 ;  // make status not empty;



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
                if( $countEmail == 0 ){
                    $email_error = "This email isn't exist";
                    $email_status = ""; // make email_status  empty     
                }
            }
        }
        


        //===================== Password Validation ==============================


        if( empty( $password ) ){
            $password_error = "Password is required";
            $password_status = "";
        }else{
            if(strlen($password) > 25 || strlen($password) < 5 ){
                $password_error = "Password must be between 5 and 25 characters";
                $password_status = "";  // make password_status  empty
            }else{
                if( preg_match("/[^A-Za-z0-9]/" , $password)){
                    $password_error = "Password must only contain numbers and letters";
                    $password_status = ""; // make password_status  empty
                }
            }
        }

        //===================== token Validation ==============================

        /*
        if( tokenValue( $email ) == "" ){
            $vertification_error = " <i class='fas fa-times'></i> You must first vertify your account on email";
            $vertification_status = ""; // make password_status  empty
        }
        */
        //===================== Check if email in DB ==============================
        if( !empty($email_status) && !empty($password_status) && !empty($vertification_status) ){


            

                $dbPass = getDbPassword( $email );
                if( password_verify( $password , $dbPass ) ){ 

                    if( count($_COOKIE) > 0 ){
                        if( isset( $_POST['remember_me'])  &&  $_POST['remember_me'] == 1){
                            setcookie("email" , $email , time() + 60*60*24*5 , '/');    // cookie for 5 days 
                        }
                    }

                    $sessionId = getUserId( $email ); 
                    create_session( "loginUserID" , $sessionId );
                    header("Location: index.php");

                }else {
                    $password_error = "Password is incorrect";                
                }


        }


    }


?>