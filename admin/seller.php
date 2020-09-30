<?php
    $pagetitle = "View Seller"; 
    include("../includes/template/admin_header.php");

   

    if( isset($_GET["id"]) && is_numeric($_GET["id"]) ){
        $id = intval( $_GET["id"] );
    }else{
        $id = "0";
    }

    if( checkSellerIdExist( $id ) == 0 ){
        header("Location: ../index.php");
    }else {
        $seller = getUserInfo( $id );
        ?>
        <div id="user-page" class="container">
            
            <h4 class="title"> <i class="fas fa-info-circle"></i> Account Info </h4>
            <hr>
            <?php

              /*===== sessions_messeges ========*/
              include "../includes/components/sessions_messeges.php";




            ?>
            <table class="table table-striped ">
                <tbody>
                    <tr>
                        <td> User ID  </td>
                        <td> <?php echo $seller["UserID"]; ?> </td>
                        <input type="hidden" value="<?php echo $seller["UserID"]; ?>" class="userid"/>
                    </tr>
                    <tr>
                        <td> Status </td>
                        <?php
                            if( $seller["Status"] == 0 ){
                                echo ' <td> <span class="deactive">  <i class="fas fa-spinner"> </i> Deactive </span> </td> ';
                            }else if( $seller["Status"] == 1 ) {
                                echo '<td> <span class="active">  <i class="fas fa-check"></i>  Active </span> </td>';
                            }
                        ?>
                    </tr>
                    <tr>
                        <td> First Name </td>
                        <td> <?php echo ucfirst($seller["firstName"]) ; ?> </td>
                    </tr>
                    <tr>
                        <td> Last Name </td>
                        <td> <?php echo ucfirst($seller["lastName"]) ; ?> </td>
                    </tr>
                    <tr>
                        <td> Username </td>
                        <td> <?php echo ucfirst($seller["Username"]); ?> </td>
                    </tr>
                    <tr>
                        <td> Email  </td>
                        <td> <?php echo $seller["Email"]; ?> </td>
                    </tr>
                    
                    <tr>
                        <td> Image  </td>
                        <td>  
                            <?php
                                if( $seller["image"] == '' ){
                                    echo '<i class="fas fa-user"></i>';
                                }else {
                                    echo '<img src="../assets/images/users-img/'. $seller["image"]  .'" alt="" class="user-img">';
                                }
                            ?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td> Num </td>
                        <td>  
                            <?php
                                if( $seller["num"] == '' ){
                                    echo '<i class="fas fa-question-circle"></i>';
                                }else {
                                    echo $seller["num"] ;
                                }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td> Member Since  </td>
                        <td>  
                            <?php
                                echo date( 'j M  Y', strtotime( $seller["register_date"] ) );
                            ?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td> Address  </td>
                        <td>  
                            <?php
                                if( $seller["address"] == '' ){
                                    echo '<i class="fas fa-question-circle"></i>';
                                }else {
                                    echo $seller["address"];
                                }
                            ?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td> Availability  </td>
                        <td>  
                            <?php
                                if( $seller["availability"] == '' ){
                                    echo '<i class="fas fa-question-circle"></i>';
                                }else {

                                    if(  $seller["availability"] == '1' ){
                                        echo ' 5-10 hrs/week';
                                    }elseif(  $seller["availability"] == '2' ){
                                        echo ' 10-20 hrs/week ';
                                    }elseif(  $seller["availability"] == '3' ){
                                        echo ' 20-30 hrs/week ';
                                    }

                                }
                            ?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td> About  </td>
                        <td>  
                            <?php
                                if( $seller["about"] == '' ){
                                    echo '<i class="fas fa-question-circle"></i>';
                                }else {
                                    echo $seller["about"];
                                }
                            ?>
                        </td>
                    </tr>

                </tbody>
            </table>
            
            <?php
                if( $seller["Status"] == 0  ){  
                    echo '<a href="" class="btn activate-user"> <i class="fas fa-check"></i> Activate </a>';
                }
                if( $seller["Status"] == 1 ){ 
                    echo '<a href="" class="btn deactivate-user"> <i class="fas fa-lock"></i> Block </a>';
                }
            ?>
            
            

                 
        </div>
            
        <?php
    }
    include("../includes/template/admin_footer.php");
    
?>
