<?php

    include("../../../init.php");

        
    if( isset( $_POST["productid"] ) ){

        $productid = $_POST["productid"] ; 

        $stmt = $con->prepare("UPDATE products SET `status` = 1 WHERE id = ? LIMIT 1");
        $stmt->execute( array( $productid ) );
        $count = $stmt->rowCount();
        if( $count > 0){ 
            create_session( "success_messege" , " <i class='fas fa-check'></i> Accept Product successfully");
        }else{
            create_session( "failed_messege" , " <i class='fas fa-times'></i> Accept Product failed");
        }

    }else {
        directTo("../../../index.php");
    }

?>