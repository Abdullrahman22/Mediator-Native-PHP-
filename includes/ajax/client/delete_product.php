<?php

    include("../../../init.php");


    if( isset( $_POST["productId"] ) && is_numeric($_POST["productId"]) ){

        $productId = security( $_POST["productId"] ) ; 

        $stmt = $con->prepare("SELECT * FROM products WHERE id = ?  ");
        $stmt->execute( array( $productId ) );
        if( $stmt->rowCount() > 0 ){

            $stmt2 = $con->prepare(" DELETE FROM products WHERE id = ?  ");
            $stmt2->execute( array( $productId ) );
            if( $stmt2->rowCount() > 0 ){
                echo "deleted";
            }else{
                echo "error";
            }

        }else{
            echo "not_found";
        }


    }else{
        header("Location: ../../../index.php");
        exit();
    }
