<?php
    $pagetitle = "View Product"; 
    include("includes/template/header.php"); 
    include "includes/handlers/view.php"; 


    ?>
    <div id="view-page">
    
        <?php include "includes/components/navbar.php";  ?>
    
        
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-img">
                            <img src="assets/images/payment-methods/cards/<?php echo $product["img"];?>" alt="product-img" >
                            <span class="amount"> <?php echo $product['amount'];?>$ </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product-info">
                            <p class="title"> <?php echo $product["name"];?> </p>
                            <hr>
                            <p class="desc">
                                <span class="text"> <i class="fas fa-quote-left"></i> <?php echo lang("Description")?>  : &nbsp </span>
                                <span> <?php echo $product["description"];?> </span> 
                            </p>
                            <hr>
                            <p class="seller">
                                <span class="text">  <i class="fas fa-user"></i> <?php echo lang("Seller")?> : &nbsp </span>
                                <img src="assets/images/users-img/<?php echo $sellerImg ;?>" alt="seller-img" class="seller-img"> <a href="profile.php?sellerid=<?php echo $seller["UserID"]; ?>"> <?php echo $seller["Email"];?> </a> 
                            </p>
                            <p class="category"> 
                                <span class="text">  <i class="fas fa-list-ul"></i> <?php echo lang("Category")?> : &nbsp</span>
                                <a href="categories.php?id=<?php echo $category["id"];?>"> <?php echo $category["name"];?> </a> 
                            </p>
                            <p class="sales">
                                <span class="text">  <i class="fas fa-shopping-cart"></i> <?php echo lang("Sales")?> : &nbsp </span>
                                <?php echo countProductSales( $product["id"] ); ?>  
                            </p>
                            <p class="price">
                                <span class="text">  <i class="fas fa-dollar-sign"></i> <?php echo lang("Price")?> : &nbsp </span>
                                <?php echo $product["amount_paid"]; ?> USD 
                            </p>
                            <p class="accepted">
                                <span class="text"><i class="fas fa-shopping-cart"></i>  <?php echo lang("Accepted")?> : &nbsp </span>
                                <?php  
                                    $acceptedMethods = $product["accepted"] ;
                                    $acceptedMethods = json_decode( $acceptedMethods ); 

                                    foreach( $acceptedMethods as $value ){
                                        echo  "<span class='accepted-methods'>" . $value . ",</span> &nbsp";
                                    }

                                    

                                ?>
                            </p>
                            <p class="date"> 
                                <span class="text">  <i class="fas fa-clock"></i> <?php echo lang("Date")?>  : &nbsp   </span>
                                <?php  echo date( 'j M  Y', strtotime( $product["date"] ) ); ?> 
                            </p>
                            <div class="buttons">
                                <form action="<?php echo $_SERVER['PHP_SELF'] ."?id=". $product["id"] ; ?>" method="POST" >

                                    <?php
                                        if( isset( $_SESSION["loginUserID"] )  ){
                                            if( $_SESSION["loginUserID"] == $seller["UserID"] ){
                                                if( $product['status'] == 0 ){
                                                    echo '<span class="status pendding">' . lang('<i class="fas fa-spinner"></i> Pendding')  . '</span>';
                                                }elseif(  $product['status'] == 1 ){
                                                    echo '<span class="status accepted"> ' . lang('<i class="fas fa-check"></i> Accepted')  . '  </span>';
                                                }elseif(  $product['status'] == 2 ){
                                                    echo '<span class="status rejected">  ' . lang('<i class="fas fa-times"></i> Reject')  . ' </span>';
                                                }
                                            }else{
                                                echo '<a href="inbox.php?do=chat&receiver='.$seller["UserID"].'" class="btn" >  ' . lang('<i class="fab fa-facebook-messenger"></i> Contact')  . ' </a>';
                                                echo '<button type="submit" name="buy_btn" class="btn"> ' . lang('<i class="fas fa-shopping-cart"></i> Buy Now!')  . ' </button>';
                                            }
                                        }else{
                                            echo '<a href="inbox.php?do=chat&receiver='.$seller["UserID"].'" class="btn" > ' . lang('<i class="fab fa-facebook-messenger"></i> Contact')  . ' </a>';
                                            echo '<button type="submit" name="buy_btn" class="btn"> ' . lang('<i class="fas fa-shopping-cart"></i> Buy Now!')  . ' </button>';
                                        }
                                    ?>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>








    </div>
    
    <?php include("includes/template/footer.php");



