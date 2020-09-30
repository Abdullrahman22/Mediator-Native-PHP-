<?php


    

    
if( isset( $_GET["value"] ) && isset( $_GET["cat"] ) ){

        
    $value  = security( $_GET["value"] );
    $cat    = security( $_GET["cat"] );

    $value_status = $cat_status = 1 ; 

    //===================== value Validation ==============================
    if( empty( $value ) ){
        header("Location: index.php");
        $cat_status = "";
    }

    function repeatLikeForDb( $value ){
        if( $value != 'all_products' ){
            return " AND `name` LIKE '%" .$value . "%' ";
        }
    }

   //===================== cat Validation ==============================
    if( $cat == "0" || $cat == ""  ){
        header("Location: index.php");
    }else {
        if( $cat != 'all_cats' ){
            if( checkRecord( "id" , "payment_methods" , $cat ) == 0  ){
                header("Location: index.php");
            }
        }
    }
      
    function findCat( $cat ){
        if( $cat != 'all_cats' ){
            return  ' AND `category` = ' . $cat . ' ';
        }
    }


            
    //===================== Get search Results  ==============================
    if( !empty($value_status) && !empty($cat_status) ){


        if( $cat == 'all_cats' &&  $value == 'all_products'  ){

            $payment = getFirstpayment();
            header("Location: categories.php?id=" . $payment["id"]);

        }else{

            $stmt = $con->prepare( "SELECT * FROM `products` WHERE `status` = 1 " .findCat( $cat ) . repeatLikeForDb( $value ) );
            $stmt->execute();
            $count    =  $stmt->rowCount();
            $products = $stmt->fetchAll();


        }




    }


}else{

    header("Location: index.php");

}


?>