<?php

    ob_start();
    session_start();


    /*============== DB file  ===============*/
    include "includes/config/db.php";


    /*============== Functions  ===============*/
    include "includes/functions/modulus_functions.php";
    include "includes/functions/controllers_functions.php";

    
    /*============== Languages  ===============*/
    if( !isset( $_SESSION["language"] ) || $_SESSION["language"] == "en"  ){
        include "includes/languages/english.php";
    }else{
        if( $_SESSION["language"] == "fr"  ){
            include "includes/languages/french.php";
        }elseif( $_SESSION["language"] == "ar"  ){
            include "includes/languages/arabic.php";
        }
    }




?>