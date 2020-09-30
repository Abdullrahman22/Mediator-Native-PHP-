<?php

    include("../../../init.php");

        
    if( isset($_POST["id"]) && is_numeric($_POST["id"]) ){
        $id = intval( $_POST["id"] );


        $check = checkRecord("id", "payment_methods", $id) ;

        if( $check > 0){ 
            $stmt = $con->prepare("DELETE FROM 
                                            payment_methods 
                                        WHERE 
                                            id = ?"); // i can get code from phpMyAdmin when i detele from user
            $stmt->execute(array(  $id )); // execute the statment 
            $count = $stmt->rowCount();
            if( $count > 0){ 
                create_session( "success_messege" , " <i class='fas fa-check'></i> &nbsp; successfuly delete Payment :) " );
                header("Location: payments.php");
                exit();
            }else{
                create_session( "failed_messege" , " <i class='fas fa-times'></i>  &nbsp; Failed to delete Payment :( " );
                header("Location: payments.php");
                exit();
            }
        }else{
            header("Location: payments.php");
            exit();
        }

    }else {
        directTo("../../../index.php");
    }



   

?>