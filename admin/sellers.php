<?php
    $pagetitle = "Sellers Page"; 
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
    
    if( ceil( countUsers( '2' ) / $limit ) == "0"){
        $pages = '1' ;
    }else{
        $pages = ceil( countUsers( '2' ) / $limit ) ;
    }
    
    if( $page > $pages ||  $page <= 0 ){
        header("Location: ../index.php");
        exit();
    }
    


    
    ?>
        <div class="container" id="users-page" >
            <h4 class="title">
                <i class="fas fa-user-tie"></i> Sellers 
                <?php
                    if( countUsers( '2' ) != 0){
                        ?>
                        <span class="search-input ">
                            <i class="fas fa-search"></i>
                            <input type="text" class="form-control search-sellers" placeholder="Search for Sellers..." >
                            <img src="../assets/images/icons/loading.gif" alt="">
                        </span>
                        <?php
                    }
                ?>
            </h4>
            <hr>
            <?php

            if( countUsers( '2' ) == 0){
                ?>
                    <div class="no-data">
                        <img src="../assets/images/img/empty.png" alt="" class="empty">
                        <h2 class="text-center">No Data Available</h2>
                        <p class="text-center">There is no data to show you right now .</p>
                    </div>

                <?php
            }else{
                ?>
                    <div class="search-content"></div>
                    <div class="table-responsive-sm table-content sellers-table">
                        <table class="table text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#id</th>
                                    <th scope="col"> <i class="fas fa-user"></i> Username</th>
                                    <th scope="col"> <i class="fas fa-envelope"></i> Email</th>
                                    <th scope="col"> <i class="fas fa-wrench"></i> Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $rows = getAllUsers("2" , $strat , $limit);
                                    foreach( $rows as $row ){
                                        echo '<tr>';
                                            echo '<td>'. $row["UserID"] .'</td>';
                                            echo '<td>'. $row["Username"] .'</td>';
                                            echo '<td>'. $row["Email"] .'</td>';
                                            echo '<td> <a href="seller.php?id='.$row["UserID"].'" class="btn view-btn"> <i class="fas fa-eye"></i> View </a> </td>';
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
                                            echo '  <li class="page-item"><a class="page-link" href="sellers.php?page='. ($page - 1)  .'">Previous</a></li> ';
                                        }
                                        
                                        if( $pages > 5 ){
                                            $num = 5;
                                        }else{
                                            $num =  $pages;
                                        }

                                        for ($i = 1; $i <= $num ; $i++) {
                                            ?>
                                                <li class="page-item">
                                                    <a class="page-link <?php  if( $i == $page ){ echo"current"; }?>" href="sellers.php?page=<?php echo  $i ; ?>"><?php echo  $i ; ?> </a>
                                                </li>
                                            <?php
                                        }
                                        if( $page > $num ){
                                            ?>
                                                <li class="page-item">
                                                    <a class="page-link current" href="sellers.php?page=<?php echo  $page ; ?>"><?php echo  $page ; ?> </a>
                                                </li>
                                            <?php
                                        }
                                        if( $page != $pages ){
                                            echo '  <li class="page-item"><a class="page-link" href="sellers.php?page='. ($page + 1)  .'">Next</a></li> ';
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
