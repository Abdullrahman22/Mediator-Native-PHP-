<?php



    if(isset($_POST["accountTypeBtn"])){
        


        $account_type      =  security( $_POST["accout-type"] ); 
        $account_type_status = 1 ;  // make status not empty;

        //===================== account_type Validation ==============================
        if( empty( $account_type ) ){
            
            header("Location: login.php");
            $account_type_status = ""; // make account_type_status  empty

        }else{
            if( $account_type != 1 && $account_type != 2 ){
                header("Location: login.php"); 
                $account_type_status = ""; // make account_type_status  empty
            }
        }

        //===================== Insert user into database ==============================
        if( !empty($account_type_status) ){
            
            create_session( "account_type_success" , $account_type );
            header("Location: signup.php");

        }

        
        
    }

?>