<?php
    $pagetitle = "My Transfers"; 
    include("includes/template/header.php"); 
    include("includes/handlers/mytransfers.php"); 
    
    


?>

<div id="my-transfer">

    <?php include "includes/components/navbar.php";  ?>


    <div id="page-content">
        <div class="container">

            <div class="container">
                <p class="title"> <i class="fas fa-money-bill-wave"></i> <?php echo lang("My Transfers"); ?> </p>
                <hr>
                <p class="desc" > <?php echo lang("Hello,") ; ?> <br> <span class="bold"> <?php echo ucfirst( $user["Username"] ); ?> </span> <?php echo lang(". You are currently signed in, you can start Exchanges!"); ?> </p>
                <div class="row" style="padding: 60px 0px">

                    <div class="col-xl-7 table-section">
                        <h5> <i class="fas fa-sync-alt"></i> <?php echo lang("Lasted 10 transfers"); ?>  </h5>
                        <?php

                            if( countMyTransfersByEmail( $user["Email"] ) == 0 ){
                                ?>
                                    <div class="no-transfers ">
                                        <i class="fas fa-question-circle"></i> <?php echo lang("You don't have transfers yet!"); ?>
                                    </div>
                                <?php
                            }else{

                                ?>
                                <div class="table-responsive-sm table-content ">
                                    <table class="table table-striped text-center">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col"> <?php echo lang("Transfer ID")?>  </th>
                                                <th scope="col"> <?php echo lang("Date")?> </th>
                                                <th scope="col"> <span class="arrangement"> <?php echo lang("1st </span> user")?>  </th>
                                                <th scope="col"> <span class="arrangement"> <?php echo lang("2nd </span> user")?>  </th>
                                                <th scope="col"> <?php echo lang("Status") ; ?> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $transfers = getMyTransfersByEmail( $user["Email"] );
                                            foreach( $transfers as $transfer ){
                                            ?>
                                                <tr>
                                                    <th scope="row"> <?php echo  $transfer["transfer_id"] ; ?> </th>
                                                    <td> <?php echo date( 'j M  Y', strtotime( $transfer["date"] ) ) ; ?> </td>
                                                    <td>
                                                        <?php echo  $transfer["email_1"] ; ?> <br>
                                                        <span class="money"> <?php echo  $transfer["money_1"] ; ?>$  </span>    
                                                    </td>
                                                    <td>
                                                        <?php echo  $transfer["email_2"] ; ?> <br>
                                                        <span class="money"> <?php echo  $transfer["money_2"] ; ?>$ </span>    
                                                    </td>
                                                    <td class="status"> 
                                                        <?php
                                                            if( $transfer["status"] == '0' ){
                                                                echo '<span class="status pendding">' . lang('<i class="fas fa-spinner"></i> Pendding')  . '</span>';
                                                            }elseif( $transfer["status"] == '1' ){
                                                                echo '<span class="status done"> ' . lang('<i class="fas fa-check"></i> Done')  . ' </span>';
                                                            }elseif( $transfer["status"] == '2' ){
                                                                echo '<span class="status reject"> ' . lang('<i class="fas fa-times"></i> Reject')  . '</span>';
                                                            }
                                                            //=============== Admin Comment =====================
                                                            if( $transfer["comment"] != '' ){
                                                                ?>
                                                                    <i class="fas fa-info-circle"></i>
                                                                    <div class="transfer-info">
                                                                        <?php echo  $transfer["comment"] ; ?> 
                                                                    </div>
                                                                <?php
                                                            }
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                            }
                        ?>
                    </div>

                    <div class="col-xl-5 statistics">
                        <h5>
                            <i class="fas fa-user-circle"></i>
                            <span class="bold">  <?php echo ucfirst( $user["Username"] ); ?>  </span> <?php echo lang("Statistics") ;?>
                        </h5>
                        <div class="statistics-inner">
                            <div class="row text-center">
                                <div class="col-md-3"> 
                                    <div class="num">
                                        <?php echo  countMyTransfersByEmail( $user["Email"] ) ; ?>
                                    </div>
                                    <p> <i class="fas fa-sync-alt"></i> <?php echo lang("Transfers") ;?>  </p>
                                </div>
                                <div class="col-md-3 reviews"> 
                                    <div class="num">
                                        <?php echo  countPenddingTransfers( $user["Email"] ) ; ?>
                                    </div>
                                    <p> <i class="fas fa-search-dollar"></i> <?php echo lang("Reviews") ;?>  </p>
                                </div>
                                <div class="col-md-3 success"> 
                                    <div class="num">
                                        <?php echo  countSuccessTransfers( $user["Email"] ) ; ?>
                                    </div>
                                    <p> <i class="fas fa-clipboard-check"></i> <?php echo lang("Successful") ;?> </p>
                                </div>
                                <div class="col-md-3 rejected"> 
                                    <div class="num">
                                        <?php echo  countFailedTransfers( $user["Email"] ) ; ?>
                                    </div>
                                    <p> <i class="fas fa-times"></i> <?php echo lang("Rejected") ;?>  </p>
                                     
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            



        </div>
    </div>

</div>



<?php
    include("includes/template/footer.php");
?>
