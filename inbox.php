<?php
    $pagetitle = "Inbox" ;
    include("includes/template/header.php"); 

    /*======= check user log in ========*/
    if( !isset( $_SESSION["loginUserID"] ) ){
        header("Location: login.php");
    }

    /*======= session ID ========*/
    $sessionId = $_SESSION["loginUserID"] ;

    
    /*======= destroy sessions  ========*/
    unset( $_SESSION["exchane_info"] );
    unset( $_SESSION["request_session"] );

    /*======= division page  ========*/
    $do = "";
    if(isset($_GET["do"])){
        $do = $_GET["do"];
    }else{
        $do = "inbox";
    }
    /*================================================================================================================
    ================================ Manage Page ====================================================================*/
    if($do == "inbox"){ 

        ?>
        <div id="inbox-page">

            <div class="left-navbar"> <?php include("includes/components/slider.php");?> </div> 
            <div class="fixed-menu">  <?php include("includes/components/slider.php");?> </div> 

            <div class="right-section">

                <div class="overlay"></div>
                <div class="top-bar">

                    <?php include("includes/components/inbox-navbar.php");?> 
                    
                </div>

                <div class="home-bg text-center">
                    <img src="assets/images/icons/Illustrations.png" alt="" />
                </div>
            </div>




        </div>
        <?php
    /*================================== Manage Page =================================================================
    ==================================================================================================================
    ================================ chat Page =====================================================================*/
    }elseif( $do == "chat" ){

        /*======= GET Receiver  ======== */
        if( isset($_GET["receiver"])   ){

            $receiver =   security( $_GET["receiver"] ) ; 

            if( $receiver == "admin" ){
                //=====================================================================
                $userPhoto = "admin-img.png";
                $userEmail = " Mediator.org Admins " ;
            }else{
                //=====================================================================
                if( InboxUserExist( $receiver ) == 0){
                    header("Location: index.php");
                }else {
                    if( $receiver == $sessionId ){
                        header("Location: index.php");
                    }
                }
                //=====================================================================
                $userRow  = getUserinfo( $receiver );
                $userEmail  = $userRow["Email"];
                $userPhoto = $userRow["image"];
                if( $userPhoto == "" ){
                    $userPhoto = 'user-img.png';
                }
            }
            

        }else{
            header("Location: index.php");
        }
         

        /*=======  create chat_Link var ========*/
        ?>

        <div id="inbox-page">


            <div class="left-navbar"> <?php include("includes/components/slider.php");?> </div> 
            <div class="fixed-menu">  <?php include("includes/components/slider.php");?> </div> 


        
            <div class="right-section">

                <div class="overlay"></div>

                <div class="top-bar">
                    <i class="fas fa-bars"></i>
                    <div class="friend-info-box">
                        <div class="friend-img">
                            <img src="assets/images/users-img/<?php  echo $userPhoto; ?>" alt="">
                        </div>
                        <div class="friend-info">
                            <div class="friend-name"> <?php echo ucfirst( $userEmail ); ?> </div>
                        </div>
                    </div>
                </div>

                <div class="chat-area">
                    <div class="custom-container">

                        <?php include("includes/components/show_messeges.php");?>
                        
                    </div>
                </div>

                <?php include("includes/components/emojis.php");?>
                <?php include("includes/components/keyboard-section.php");?>

            </div>



        </div>
        <?php
            if( userType( $sessionId ) == 3 ){
                $sessionId = "admin";
            }
        ?>
            <!---------- send var to js file ----------->
            <script>
                var sessionId = '<?php echo $sessionId ;?>';
                var receiver  = '<?php echo $receiver ;?>' 
            </script>
        <?php
        /*================================== chat Page ==================================================
        =================================================================================================*/
    }
    include("includes/template/footer.php");
?>
