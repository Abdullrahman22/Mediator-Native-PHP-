<?php
    $pagetitle = "View User"; 
    include("../includes/template/admin_header.php");

   

    if( isset($_GET["id"]) && is_numeric($_GET["id"]) ){
        $id = intval( $_GET["id"] );
    }else{
        $id = "0";
    }

    if( checkUserIdExist( $id ) == 0 ){
        header("Location: ../index.php");
    }else {
        $user = getUserInfo( $id );
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
                        <td> <?php echo $user["UserID"]; ?> </td>
                        <input type="hidden" value="<?php echo $user["UserID"]; ?>" class="userid"/>
                    </tr>
                    <tr>
                        <td> Status </td>
                        <?php
                            if( $user["Status"] == 0 ){
                                echo ' <td> <span class="deactive">  <i class="fas fa-spinner"> </i> Deactive </span> </td> ';
                            }else if( $user["Status"] == 1 ) {
                                echo '<td> <span class="active">  <i class="fas fa-check"></i>  Active </span> </td>';
                            }
                        ?>
                    </tr>
                    <tr>
                        <td> First Name </td>
                        <td> <?php echo ucfirst($user["firstName"]) ; ?> </td>
                    </tr>
                    <tr>
                        <td> Last Name </td>
                        <td> <?php echo ucfirst($user["lastName"]) ; ?> </td>
                    </tr>
                    <tr>
                        <td> Username </td>
                        <td> <?php echo ucfirst($user["Username"]); ?> </td>
                    </tr>
                    <tr>
                        <td> Email  </td>
                        <td> <?php echo $user["Email"]; ?> </td>
                    </tr>
                    
                    <tr>
                        <td> Image  </td>
                        <td>  
                            <?php
                                if( $user["image"] == '' ){
                                    echo '<i class="fas fa-question-circle"></i>';
                                }else {
                                    echo ' ';
                                }
                            ?>
                        </td>
                    </tr>
                    

                    <tr>
                        <td> Member Since  </td>
                        <td>  
                            <?php
                                echo date( 'j M  Y', strtotime( $user["register_date"] ) );
                            ?>
                        </td>
                    </tr>
                    
                   

                </tbody>
            </table>
            
            <?php
                if( $user["Status"] == 0  ){  
                    echo '<a href="" class="btn activate-user"> <i class="fas fa-check"></i> Activate </a>';
                }
                if( $user["Status"] == 1 ){ 
                    echo '<a href="" class="btn deactivate-user"> <i class="fas fa-lock"></i> Block </a>';
                }
            ?>
                 
        </div>
            
        <?php
    }
    include("../includes/template/admin_footer.php");
    
?>
