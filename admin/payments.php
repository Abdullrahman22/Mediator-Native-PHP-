<?php
    $pagetitle = "Payments Page"; 
    include("../includes/template/admin_header.php");

    


    $do = "";
    if(isset($_GET["do"])){
        $do = $_GET["do"];
    }else{
        $do = "manage";
    }

    if($do == "manage"){ 

    
?>
    
    <div class="container" id="payments-page" >
        
        <h4> <i class="fas fa-money-check-alt"></i> Payments <button class="blue-btn add-payment-btn"> <i class="fas fa-plus"></i> Add New Payment </button></h4>
        
        <hr>
        <?php
            /*===== sessions_messeges ========*/
            include "../includes/components/sessions_messeges.php";

            /*===============================================================================================
            =================================================================================================
            ================================ Table Payment Methods =========================================*/ 

            if( countRecords( "id" , "payment_methods" ) == 0){
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
                                    <th scope="col"> <i class="fas fa-images"></i> Icon</th>
                                    <th scope="col"> <i class="fas fa-money-check-alt"></i> Payment Name </th>
                                    <th scope="col"> <i class="fas fa-user-circle"></i> Our Account</th>
                                    <th scope="col"> <i class="fas fa-sort-amount-down"></i> Minimum</th>
                                    <th scope="col"> <i class="fas fa-wrench"></i> Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php
                                    $rows = getAllPayments();
                                    foreach( $rows as $row ){
                                        echo '<tr id="5">';
                                            echo '<input type="hidden" value="'. $row["id"]  .'" class="payment-id" />';
                                            echo '<td> <img class="payment-img" src="../assets/images/payment-methods/icons/'. $row["icon"] .'" alt=""> </td>';
                                            echo '<td>'. $row["name"] .'</td>';
                                            echo '<td>'. $row["our_account"] .'</td>';
                                            echo '<td>'. $row["minimum"] .'$</td>';
                                            echo '<td>
                                                    <a href="payments.php?do=edit&id='. $row["id"] .'" class="btn btn-primary edit-btn"> <i class="fas fa-pencil-alt"></i>  </a> 
                                                    <a href="" class="btn btn-danger delete-btn"> <i class="far fa-trash-alt"></i>  </a> 
                                                  </td>';
                                            
                                        echo '</tr>';
                                    }
                                ?>
                                
                                
                            </tbody>
                        </table>
                    </div>
                <?php
            }
            /*============================== Table Payment Methods ============================================
            =================================================================================================
            ================================ Add Payment Method =========================================*/ 

            ?>
            <div class="add-payment popup-section">
                <div class="inner">
                    <?php
                        include "../includes/handlers/add_payment.php";
                    ?>
                    <h4> <i class="fas fa-plus-circle"></i> New Payment</h4>
                    <hr>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">

                        <!--paymentName Field-->
                        <div class="form-group">
                            <label for="paymentName"> <i class="fas fa-money-check-alt"></i>  Payment Name :</label>
                            <input type="text"  name="paymentName" placeholder="Type Name.." class="form-control" value="<?php  echo getInputValue("paymentName");  ?>" required="required" autocomplete="off" minlength="4" maxlength="30" />
                            <?php
                                if( isset( $paymentName_error ) ){
                                    echo '<p class="error-messege">' . $paymentName_error . '</p>'; 
                                }
                            ?>
                        </div>
                        <hr>

                        <!--ourAccount Field-->
                        <div class="form-group">
                            <label for="ourAccount">  <i class="fas fa-user-circle"></i> Our Account :</label>
                            <input type="text"  name="ourAccount" placeholder="Type Account.." class="form-control" value="<?php  echo getInputValue("ourAccount");  ?>" required="required" autocomplete="off"  minlength="4" maxlength="30"  />
                            <?php
                                if( isset( $ourAccount_error ) ){
                                    echo '<p class="error-messege">' . $ourAccount_error . '</p>'; 
                                }
                            ?>
                        </div>
                        <hr>

                        <!--minimum Field-->
                        <div class="form-group">
                            <label for="minimum">  <i class="fas fa-sort-amount-down"></i> Minimum Amount :</label>
                            <input type="number"  name="minimum" placeholder="Type Amount.." class="form-control" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" value="<?php  echo getInputValue("minimum");  ?>" required="required" autocomplete="off" maxlength="8"  />
                            <?php
                                if( isset( $minimum_error ) ){
                                    echo '<p class="error-messege">' . $minimum_error . '</p>'; 
                                }
                            ?>
                        </div>
                        <hr>

                        <!--upload-input-->
                        <div class="upload-input">
                            <label for="file" id="file-label">  <i class="fas fa-cloud-upload-alt"></i> &nbsp; Choose image...  <span style="font-size: 13px">icon img</span>  </label>
                            <input type="file" class="file form-control" id="file" name="img" required = 'required' /> 
                            <?php
                                if( isset( $img_error ) ){
                                    echo '<p class="error-messege">' . $img_error . '</p>'; 
                                }
                            ?>
                        </div>

                        <button name="addPaymentBtn" class="btn btn-primary"> <i class="fas fa-plus"></i> Add Now!</button>

                    </form>
                </div>
            </div>

    </div>
<?php
            /*============================== Add Payment Methods ============================================
            =================================================================================================
            ================================ Edit Payment Method =========================================*/ 
        }elseif($do == "edit"){

            if( isset($_GET["id"]) && is_numeric($_GET["id"]) ){
                $id = intval( $_GET["id"] );
            }else{
                $id = 0;
            }
            $check = checkRecord("id", "payment_methods", $id) ;
            if( $check > 0){ 
                
                ?>

                    <div id="payments-page">
                        <div class="edit-payment popup-section">
                            <div class="inner">
                                <?php
                                    $row = getPaymentInfo( $id ) ;
                                    include "../includes/handlers/edit_payment.php";
                                ?>
                                <h4> <i class="fas fa-plus-circle"></i> Edit Payment</h4>
                                <hr>
                                <form action="?do=edit&id=<?php echo $id ;?>" method="POST" enctype="multipart/form-data">

                                    <!-- id Field-->
                                    <input type="hidden" value="<?php echo $id ;?>" name="payment_id">

                                    <!--paymentName Field-->
                                    <div class="form-group">
                                        <label for="paymentName"> <i class="fas fa-money-check-alt"></i>  Payment Name :</label>
                                        <input type="text"  name="paymentName" placeholder="Type Name.." class="form-control" value="<?php  echo $row["name"] ;  ?>" required="required" autocomplete="off" minlength="4" maxlength="30" />
                                        <?php
                                            if( isset( $paymentName_error ) ){
                                                echo '<p class="error-messege">' . $paymentName_error . '</p>'; 
                                            }
                                        ?>
                                    </div>
                                    <hr>

                                    <!--ourAccount Field-->
                                    <div class="form-group">
                                        <label for="ourAccount">  <i class="fas fa-user-circle"></i> Our Account :</label>
                                        <input type="text"  name="ourAccount" placeholder="Type Account.." class="form-control" value="<?php  echo $row["our_account"] ;  ?>" required="required" autocomplete="off"  minlength="4" maxlength="30"  />
                                        <?php
                                            if( isset( $ourAccount_error ) ){
                                                echo '<p class="error-messege">' . $ourAccount_error . '</p>'; 
                                            }
                                        ?>
                                    </div>
                                    <hr>

                                    <!--minimum Field-->
                                    <div class="form-group">
                                        <label for="minimum">  <i class="fas fa-sort-amount-down"></i> Minimum Amount :</label>
                                        <input type="number"  name="minimum" placeholder="Type Amount.." class="form-control" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" value="<?php  echo $row["minimum"];  ?>" required="required" autocomplete="off" maxlength="8"  />
                                        <?php
                                            if( isset( $minimum_error ) ){
                                                echo '<p class="error-messege">' . $minimum_error . '</p>'; 
                                            }
                                        ?>
                                    </div>
                                    <hr>

                                    <!--upload-input-->
                                    <div class="upload-input">
                                        <img src="../assets/images/payment-methods/icons/<?php echo $row["icon"] ; ?>" alt="payment-icon" class="payment-icon" >
                                        <label for="file" id="file-label">  <i class="fas fa-cloud-upload-alt"></i> &nbsp; Change image...  <span style="font-size: 13px">icon img</span>  </label>
                                        <input type="file" class="file form-control" id="file" name="img" /> 
                                        <?php
                                            if( isset( $img_error ) ){
                                                echo '<p class="error-messege">' . $img_error . '</p>'; 
                                            }
                                        ?>
                                    </div>

                                    <button name="editPaymentBtn" class="btn btn-primary"> <i class="fas fa-pencil-alt"></i>  Edit Now! </button>

                                </form>
                            </div>
                        </div>

                    </div>
                    

                <?php
            }else{
                header("Location: payments.php");
                exit();
            }

        }

    include("../includes/template/admin_footer.php");
    
?>
