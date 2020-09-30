<?php

    if( isset($_SESSION["success_messege"])){
        echo '<div class="popup-messege success"> ';
            echo '<p class="text-center">';
                echo $_SESSION["success_messege"] ;
            echo '</p>';
        echo '</div>';
    }
    elseif ( isset($_SESSION["failed_messege"]) ) {
        echo '<div class="popup-messege failed"> ';
            echo '<p class="text-center">';
                echo $_SESSION["failed_messege"] ;
            echo '</p>';
        echo '</div>';
    }
    unset( $_SESSION["success_messege"] );
    unset( $_SESSION["failed_messege"] );

?>