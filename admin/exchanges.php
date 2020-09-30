<?php
    $pagetitle = "Exchanges Page"; 
    include("../includes/template/admin_header.php");


    /*==========================================================================
    ======================= Start Pagination  =================================*/
    if( isset($_GET["page"]) && is_numeric($_GET["page"]) ){
        $page = intval( $_GET["page"] );
    }else{
        $page = "1";
    }
    $limit = 50 ;
    $strat =  ( $page - 1 ) * $limit  ;
    
    if( ceil( countExchanges() / $limit ) == "0"){
        $pages = '1' ;
    }else{
        $pages = ceil( countExchanges() / $limit ) ;
    }
    
    if( $page > $pages ||  $page <= 0 ){
        header("Location: ../index.php");
        exit();
    }
    /*======================== End  Pagination =================================
    /*=========================================================================*/  
?>

    <div class="container" id="exchanges-page" >
        
        <h4> <i class="fas fa-sync-alt"></i> Exchanges</h4>
        <hr>
        <?php
        /*========== sessions_messeges ============*/
        include "../includes/components/sessions_messeges.php";
        if( countExchanges() == 0){
            ?>
                <div class="no-data">
                    <img src="../assets/images/img/empty.png" alt="" class="empty">
                    <h2 class="text-center">No Data Available</h2>
                    <p class="text-center">There is no data to show you right now .</p>
                </div>
            <?php
        }else{
            ?>
            <div class="table-responsive-sm table-content">
                <table class="table text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"> <i class="fas fa-user"></i> 1st Email</th>
                            <th scope="col"> <i class="fas fa-user"></i> 2nd Email</th>
                            <th scope="col"> <i class="fas fa-sliders-h"></i> Status</th>
                            <th scope="col"> <i class="fas fa-wrench"></i> Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $rows = getAllExchanges();
                            foreach( $rows as $row){
                                ?>
                                <?php
                                echo '<tr>';
                                    echo '<th scope="row">'. $row["id"] .'</th>';
                                    echo '<td>' . $row["email_1"] . '</td>';
                                    echo '<td>' . $row["email_2"] . '</td>';
                                    if( $row["status"] == 0 ){
                                        echo '<td> <div class="pendding"> <i class="fas fa-spinner"></i> Pendding </div> </td>';
                                    }elseif( $row["status"] == 1 ){
                                        echo '<td> <div class="success"> <i class="fas fa-check"></i> Success </div> </td>';
                                    }elseif( $row["status"] == 2 ){
                                        echo '<td> <div class="reject"> <i class="fas fa-times"></i> Reject </div> </td>';
                                    }
                                    echo ' <td> <a href="exchange.php?transferid='. $row["transfer_id"] .'" class="btn view-btn"> <i class="fas fa-eye"></i> View </a> </td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php    
        }
        ?>
        <!------------------------------------------------------------->
        <!-------------- Start Pagination ----------------------------->
        <nav aria-label="Page navigation example ">
            <ul class="pagination justify-content-center">
                <?php
                    if( $pages > 1 ){

                        if( $page !== 1 && isset($_GET["page"])  ){
                            echo '  <li class="page-item"><a class="page-link" href="comments.php?page='. ($page - 1)  .'">Previous</a></li> ';
                        }
                        
                        if( $pages > 5 ){
                            $num = 5;
                        }else{
                            $num =  $pages;
                        }

                        for ($i = 1; $i <= $num ; $i++) {
                            ?>
                                <li class="page-item">
                                    <a class="page-link <?php  if( $i == $page ){ echo"current"; }?>" href="comments.php?page=<?php echo  $i ; ?>"><?php echo  $i ; ?> </a>
                                </li>
                            <?php
                        }
                        if( $page > $num ){
                            ?>
                                <li class="page-item">
                                    <a class="page-link current" href="comments.php?page=<?php echo  $page ; ?>"><?php echo  $page ; ?> </a>
                                </li>
                            <?php
                        }
                        if( $page != $pages ){
                            echo '  <li class="page-item"><a class="page-link" href="comments.php?page='. ($page + 1)  .'">Next</a></li> ';
                        }

                    }
                ?>
            </ul>
        </nav>
        <!-------------- End Pagination ------------------------------->
        <!------------------------------------------------------------->
    </div>

<?php
    include("../includes/template/admin_footer.php");
?>
