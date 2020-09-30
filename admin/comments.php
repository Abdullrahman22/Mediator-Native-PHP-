<?php
    $pagetitle = "Comments Page"; 
    include("../includes/template/admin_header.php");


    
        
    $do = "";
    if( isset($_GET["do"]) ){
        $do = $_GET["do"];
    }else{
        $do = "manage";
    }

    /*=================================================================================================
    ===================================================================================================
    ================================ Manage Page ====================================================*/
    if ($do == "manage") {



            /*==========================================================================
            ==============    Pagination        =======================================*/

            if( isset($_GET["page"]) && is_numeric($_GET["page"]) ){
                $page = intval( $_GET["page"] );
            }else{
                $page = "1";
            }
            $limit = 50 ;
            $strat =  ( $page - 1 ) * $limit  ;
            
            if( ceil( countComments() / $limit ) == "0"){
                $pages = '1' ;
            }else{
                $pages = ceil( countComments() / $limit ) ;
            }
            
            if( $page > $pages ||  $page <= 0 ){
                header("Location: ../index.php");
                exit();
            }
            
        
            
            ?>
            
            
            <div class="container" id="comments-page" >
                
                <h4> <i class="fas fa-comment"></i> Comments </h4>
                <hr>
            <?php
            
            /*===== sessions_messeges ========*/
            include "../includes/components/sessions_messeges.php";

            if( countComments() == 0){
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
                                <th scope="col">#id</th>
                                <th scope="col"> <i class="fas fa-user"></i>  Email </th>
                                <th scope="col"> <i class="fas fa-comment"></i>  Comment</th>
                                <th scope="col"> <i class="fas fa-star"></i> Rating </th>
                                <th scope="col"> <i class="far fa-clock"></i> Date </th>
                                <th scope="col"> <i class="fas fa-wrench"></i> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php
                                    $rows = getAllComments( $strat , $limit);
                                    foreach( $rows as $row ){
                                        ?>
                                        <tr> 
                                            <td> <?php echo $row["comment_ID"] ;?> </td>
                                            <td> <?php echo $row["Email"] ;?> </td>
                                            <td> <?php echo $row["comment"] ;?> </td>
                                            <td> 
                                                <?php
                                                    for ( $i = 1; $i <= $row["rating"] ; $i++) {
                                                        echo '<img src="../assets/images/icons/star.png" alt="rating-img" class="rating-img"> ';
                                                    }
                                                ?>
                                            </td>
                                            <td> <?php echo date( 'j M  Y', strtotime( $row["date"] ) )  ;?> </td>
                                            <td>
                                                <a href="comments.php?do=delete&id=<?php echo $row["comment_ID"] ; ?>" class="btn btn-danger delete-btn"> <i class="far fa-trash-alt"></i> Delete </a> 
                                            </td>
                                                     
                                        </tr> 
                                        <?php
                                    }
                                ?>
                        </tbody>
                    </table>
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
                </div>
            </div>
            <?php
            }
        /*============================== Manage Comments Method ============================================
        =================================================================================================
        ================================ Delete Comments Method =========================================*/ 
    }elseif($do == "delete"){
 
        if( isset($_GET["id"]) && is_numeric($_GET["id"]) ){
            $id = intval( $_GET["id"] );
        }else{
            $id = 0;
        }
        $check = checkRecord("comment_ID", "comments", $id) ;
        if( $check > 0){ 
            $stmt = $con->prepare("DELETE FROM 
                                            comments 
                                        WHERE 
                                        comment_ID = ?"); 
            $stmt->execute(array(  $id )); // execute the statment 
            $count = $stmt->rowCount();
            if( $count > 0){ 
                header("Location: comments.php");
                create_session( "success_messege" , " <i class='fas fa-check'></i> &nbsp; successfuly delete Comments :) " );
                exit();

            }else{
                header("Location: comments.php");
                create_session( "success_messege" , " <i class='fas fa-times'></i>  &nbsp; Failed to delete Comments :( " );
                exit();
            }
        }else{
            header("Location: comments.php");
            exit();
        }

        

    }








    include("../includes/template/admin_footer.php");
    
?>
