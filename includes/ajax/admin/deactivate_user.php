<?php

    include("../../../init.php");

        
    if( isset( $_POST["userid"] ) ){

        $userid = $_POST["userid"] ; 

        $stmt = $con->prepare("UPDATE users SET `Status` = 0 WHERE UserID = ? LIMIT 1");
        $stmt->execute( array( $userid ) );
        $count = $stmt->rowCount();
        if( $count > 0){ 
            create_session( "success_messege" , " <i class='fas fa-check'></i> Deactivate user successfully");
        }else{
            create_session( "failed_messege" , " <i class='fas fa-times'></i> Deactivate user failed");
        }

    }else {
        directTo("../../../index.php");
    }

?>