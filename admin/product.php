<?php
    $pagetitle = "View Product"; 
    include("../includes/template/admin_header.php");

   

    if( isset($_GET["id"]) && is_numeric($_GET["id"]) ){
        $id = intval( $_GET["id"] );
    }else{
        $id = "0";
    }

    if( checkProductExist( $id ) == 0 ){
        header("Location: ../index.php");
    }else {
        $product = getProductInfo( $id );


        //================= get Seller info by userid ==========================
        $user = getUserInfo( $product["UserID"] );


        //================= get category info by name  =========================
        $category = getPaymentInfo( $product["category"] );



        ?>
        <div id="product-page" class="container">
            
            <h4 class="title"> <i class="fas fa-info-circle"></i> Product Info </h4>
            <hr>
            <?php

              /*===== sessions_messeges ========*/
              include "../includes/components/sessions_messeges.php";



            ?>
            <table class="table table-striped ">
                <tbody>
                    <tr>
                        <td> Product ID  </td>
                        <td> <?php echo $product["id"]; ?> </td>
                        <input type="hidden" value="<?php echo $product["id"]; ?>" class="productid"/>
                    </tr>
                    <tr>
                        <td> Status </td>
                        <?php
                            if( $product["status"] == 0 ){
                                echo ' <td> <span class="pendding">  <i class="fas fa-spinner"> </i> Pendding </span> </td> ';
                            }else if( $product["status"] == 1 ) {
                                echo '<td> <span class="active">  <i class="fas fa-check"></i>  Accepted </span> </td>';
                            }else if( $product["status"] == 2 ) {
                                echo '<td> <span class="deactive">  <i class="fas fa-times"></i>  Rejected </span> </td>';
                            }
                        ?>
                    </tr>
                    <tr>
                        <td> Title  </td>
                        <td> <?php echo $product["name"] ; ?> </td>
                    </tr>

                    <tr>
                        <td> Add By   </td>
                        <td> <a href="seller.php?id=<?php echo $user["UserID"] ; ?>"> <?php echo $user["Email"] ; ?> </a> </td>
                    </tr>

                    <tr>
                        <td> Payment  </td>
                        <td> <img src="../assets/images/payment-methods/icons/<?php echo $category["icon"] ; ?>" alt="payment-icon" class="payment-icon" > <?php echo $category["name"] ; ?> </td>
                    </tr>

                    <tr>
                        <td> Amount  </td>
                        <td> <?php echo $product["amount"] ; ?>$ </td>
                    </tr>

                    <tr>
                        <td> Price  </td>
                        <td> <?php echo $product["amount_paid"] ; ?>$ </td>
                    </tr>
                    

                    <tr>
                        <td> Card Img  </td>
                        <td> <img src="../assets/images/payment-methods/cards/<?php echo $product["img"] ; ?> " alt="img-card" class="img-card"  > </td> 
                    </tr>
                    
                    <tr>
                        <td> Date  </td>
                        <td>  
                            <?php
                                echo date( 'j M  Y', strtotime( $product["date"] ) );
                            ?>
                        </td>
                    </tr>
                    
                    
                    <tr>
                        <td> Description  </td>
                        <td> <?php echo $product["description"] ; ?> </td>
                    </tr>
                    

                </tbody>
            </table>
            
            <?php
                if( $product["status"] == 0  ){  
                    echo '<a href="" class="btn accept-product"> <i class="fas fa-check"></i> Accept </a>';
                    echo '<a href="" class="btn reject-product"> <i class="fas fa-times"></i> Reject </a>';
                }
                elseif( $product["status"] == 1 ){ 
                    echo '<a href="" class="btn reject-product"> <i class="fas fa-times"></i> Reject </a>';
                }
                elseif( $product["status"] == 2 ){ 
                    echo '<a href="" class="btn accept-product"> <i class="fas fa-check"></i> Accept </a>';
                }
            ?>
            
            

                 
        </div>
            
        <?php
    }
    include("../includes/template/admin_footer.php");
    
?>
