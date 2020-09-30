<?php
    $pagetitle = "Categories"; 
    include("includes/template/header.php"); 

    if( isset($_GET["id"]) && is_numeric($_GET["id"]) ){
        $id = intval( $_GET["id"] );
    }else{
        $id = "0";
    }

    if( checkPaymentExist( $id ) == 0 ){
        header("Location: index.php");
    }else {


        //================= get payment info by id ==========================
        $payment = getPaymentInfo( $id );


        //================= get product info by payment id ==========================


        ?>

        <div id="category-page">
        
            <?php include "includes/components/navbar.php";  ?>

            <div class="content">

                <div class="fixed-menu">
                    <div class="inner text-left">
                        <h5> <i class="fas fa-list-ul"></i> <?php echo lang("All Categories") ;?> </h5>
                        <hr>
                        <?php
                            $cats = getAllPayments();
                            foreach( $cats as $cat ){
                                ?>
                                   <p class="<?php if($cat["id"] == $id ){ echo 'colored';} ?>"> <a href="categories.php?id=<?php echo $cat["id"]; ?>"> <img src="assets/images/payment-methods/icons/<?php echo $cat["icon"]; ?> " alt="cat-icon" class="cat-icon"> <?php echo $cat["name"]; ?> </a> </p> 
                                <?php
                            }
                        ?>
                    </div>
                </div>
                
                <div class="cards-content">
                    <?php
                        if( countCustomProducts( $payment["id"] ) == 0 ){
                            ?>
                                <div class="no-data text-center">
                                    <img src="assets/images/img/empty.png" alt="" class="empty">
                                    <h2 class="text-center"> <?php echo lang("No Data Available"); ?> </h2>
                                    <p class="text-center"> <?php echo lang("There is no data to show you right now."); ?> </p>
                                </div>
                            <?php
                        }else{
                            ?>
                            <div class="row products">

                                <?php
                                $products = getAllProductsByName(  $payment["id"]  );
                                foreach( $products as $product ){
                                    $seller = getUserInfo( $product["UserID"] );
                                    ?>
                                    
                                        <div class="col-md-4 col-sm-6 text-center text-center">
                                            <div class="product-card">
                                                <div class="product-img">
                                                    <img src="assets/images/payment-methods/cards/<?php echo $product['img'];?>" alt="product-img"  >
                                                    <span class="amount"> <?php echo $product['amount'];?>$ </span>
                                                </div>
                                                <div class="title "> <a href="view.php?id=<?php echo $product['id'] ; ?>"> <?php echo $product['name'];?> </a>  </div>
                                                <div class="price "> 
                                                    <span class="text"> <?php echo lang('price'); ?> : </span>
                                                    <span class="money"> <?php echo $product['amount_paid'];?> USD </span>
                                                </div>     
                                                <div class="buttons">
                                                    <a href="view.php?id=<?php echo $product['id'] ; ?>" class="btn"> <i class="fas fa-eye"></i>   <?php echo lang('view'); ?> </a>
                                                    <?php
                                                        if( isset( $_SESSION["loginUserID"] )  ){
                                                            if( $_SESSION["loginUserID"] == $seller["UserID"] ){
                                                                if( $product['status'] == 0 ){
                                                                    echo '<a class="btn status pendding">' . lang('<i class="fas fa-spinner"></i> Pendding')  . ' </a>';
                                                                }elseif(  $product['status'] == 1 ){
                                                                    echo '<a class="btn status accepted">' . lang('<i class="fas fa-check"></i> Accepted')  . '</a>';
                                                                }elseif(  $product['status'] == 2 ){
                                                                    echo '<a class="btn status rejected">  ' . lang('<i class="fas fa-times"></i> Reject')  . ' </a>';
                                                                }
                                                            }else{
                                                                echo '<a href="inbox.php?do=chat&receiver='.$seller["UserID"].'" class="btn" > <i class="fab fa-facebook-messenger"></i>  '. lang('Contact') .' </a>';
                                                            }
                                                        }else{
                                                            echo '<a href="inbox.php?do=chat&receiver='.$seller["UserID"].'" class="btn" > <i class="fab fa-facebook-messenger"></i>  '. lang('Contact') .' </a>';
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>

                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                        }
                    ?>
                </div>
            </div>


        </div>
       
       <?php include("includes/template/footer.php");
    }


