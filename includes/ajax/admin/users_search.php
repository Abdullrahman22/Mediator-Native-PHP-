<?php

    include("../../../init.php");

        
    if( isset( $_GET["search_content"] ) ){


        $search_content = $_GET["search_content"] ; 


        $stmt = $con->prepare(" SELECT * FROM `users` WHERE `Email` = ? AND GroupID = ? LIMIT 1");
        $stmt->execute(array( $search_content , "1" ));
        $user = $stmt->fetch();
        $count = $stmt->rowCount();

        if( $count == 1 ){
            ?>
            <div class="table-responsive-sm table-content">

                <table class="table text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#id</th>
                            <th scope="col"> <i class="fas fa-user"></i> Username</th>
                            <th scope="col"> <i class="fas fa-envelope"></i> Email</th>
                            <th scope="col"> <i class="fas fa-question-circle"></i>  Status </th>
                            <th scope="col"> <i class="fas fa-wrench"></i> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th> <?php echo $user["UserID"] ; ?> </th>
                            <th> <?php echo $user["Username"] ; ?> </th>
                            <th> <?php echo $user["Email"] ; ?> </th>
                            <th> 
                                <?php
                                    if( $user["Status"] == 0 ){
                                        echo ' <span class="pendding">  <i class="fas fa-spinner"> </i> Pendding </span>  ';
                                    }else{
                                        echo ' <span class="active">  <i class="fas fa-check-circle"></i>  Active </span> ';
                                    }
                                ?>
                            </th>
                            <th> <a href="seller.php?id=<?php echo $user["UserID"] ; ?>" class="btn view-btn"> <i class="fas fa-eye"></i> View </a>  </th>
                        </tr>
                    </tbody>
                </table>
                
            </div>

            <?php  
        }else{
            ?>
            
                <div class="no-data">
                    <img src="../assets/images/img/empty.png" alt="" class="empty">
                    <h2 class="text-center"> <i class="fas fa-envelope"></i> Email not found</h2>
                    <p class="text-center">There is no data to show you right now .</p>
                </div>

            <?php
        }




    }else {
        directTo("../../../index.php");
    }
