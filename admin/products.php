<?php
    $pagetitle = "Products Page"; 
    include("../includes/template/admin_header.php");





    /*==========================================================================
    ============================================================================ 
    ==============    Pagination        =======================================*/

    if( isset($_GET["page"]) && is_numeric($_GET["page"]) ){
        $page = intval( $_GET["page"] );
    }else{
        $page = "1";
    }
    $limit = 50 ;
    $strat =  ( $page - 1 ) * $limit  ;
    
    if( ceil( countProducts() / $limit ) == "0"){
        $pages = '1' ;
    }else{
        $pages = ceil( countProducts() / $limit ) ;
    }
    
    if( $page > $pages ||  $page <= 0 ){
        header("Location: ../index.php");
        exit();
    }
    


    
    ?>
        <div class="container" id="products-page" >
            <h4 class="title">
                <i class="fas fa-list-ul"></i> Products 
            </h4>
            <hr>
            <?php

            if( countProducts() == 0){
                ?>
                    <div class="no-data">
                        <img src="../assets/images/img/empty.png" alt="" class="empty">
                        <h2 class="text-center">No Data Available</h2>
                        <p class="text-center">There is no data to show you right now .</p>
                    </div>

                <?php
            }else{
                ?>
                    <div class="table-responsive-sm table-content products-table">
                        <table class="table text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#id</th>
                                    <th scope="col"> <i class="fas fa-user"></i> Name</th>
                                    <th scope="col"> <i class="fas fa-question-circle"></i>  Status </th>
                                    <th scope="col"> <i class="fas fa-wrench"></i> Date</th>
                                    <th scope="col"> <i class="fas fa-wrench"></i> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $products = getAllProducts();
                                    foreach( $products as $product ){
                                        echo '<tr>';
                                            echo '<td>'. $product["id"] .'</td>';
                                            echo '<td>'. $product["name"] .'</td>';
                                            if( $product["status"] == 0 ){
                                                echo '<td> <div class="pendding">  <i class="fas fa-spinner"> </i> pendding </div>  </td>';
                                            }else if(  $product["status"] == 1 ){
                                                echo '<td> <div class="active">  <i class="fas fa-check-circle"></i>  Accepted </div> </td>';
                                            }else if(  $product["status"] == 2 ){
                                                echo '<td> <div class="deactive">  <i class="fas fa-times"></i>  Rejected </div> </td>';
                                            }
                                            echo '<td>'. date( 'j M  Y', strtotime( $product["date"] ) ) .'</td>';
                                            echo '<td> <a href="product.php?id='.$product["id"].'" class="btn view-btn"> <i class="fas fa-eye"></i> View </a> </td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example ">
                            <ul class="pagination justify-content-center">
                                <?php
                                    if( $pages > 1 ){

                                        if( $page !== 1 && isset($_GET["page"])  ){
                                            echo '  <li class="page-item"><a class="page-link" href="products.php?page='. ($page - 1)  .'">Previous</a></li> ';
                                        }
                                        
                                        if( $pages > 5 ){
                                            $num = 5;
                                        }else{
                                            $num =  $pages;
                                        }

                                        for ($i = 1; $i <= $num ; $i++) {
                                            ?>
                                                <li class="page-item">
                                                    <a class="page-link <?php  if( $i == $page ){ echo"current"; }?>" href="products.php?page=<?php echo  $i ; ?>"><?php echo  $i ; ?> </a>
                                                </li>
                                            <?php
                                        }
                                        if( $page > $num ){
                                            ?>
                                                <li class="page-item">
                                                    <a class="page-link current" href="products.php?page=<?php echo  $page ; ?>"><?php echo  $page ; ?> </a>
                                                </li>
                                            <?php
                                        }
                                        if( $page != $pages ){
                                            echo '  <li class="page-item"><a class="page-link" href="products.php?page='. ($page + 1)  .'">Next</a></li> ';
                                        }

                                    }
                                ?>
                            </ul>
                        </nav>
                    </div>
                <?php
            }
            ?>      
        </div>


<?php
    include("../includes/template/admin_footer.php");
?>
