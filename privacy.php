<?php
    $pagetitle = "Privacy"; 
    include("includes/template/header.php"); 
?>

<div id="privacy">

    <?php include "includes/components/navbar.php";  ?>


    <div class="page-content ">
        <div class="container">

            <p class="title"> <?php echo lang('<i class="fas fa-gavel"></i> Privacy Policy'); ?> </p>
            <hr>
            <p>
                <?php echo lang("If you visit our login page, we will create a temporary cookie to determine if your browser accepts these cookies. This cookie does not contain any personal data and is destroyed when you close your browser."); ?>
            </p>
            <p>
                <?php echo lang('When you log in, we also configure several cookies to save your login information and your display options. Cookies for login information remain for two days, while cookies for display options remain for a year. Your login will continue for two weeks when you choose "Remember me", and if you log out of the account, the login cookies will be deleted.') ; ?>
            </p>

        </div>
    </div>


</div>



<?php
    include("includes/template/footer.php");
?>
