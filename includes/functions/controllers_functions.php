<?php

    function getInputValue($name){
        if (isset($_POST[$name])){
            echo $_POST[$name];
        }
    }

    
    function security( $data ){
        $data = strip_tags($data); // to remove tags from inputs
        return ltrim( $data, " " ); // to remove spaces after string
    }

    function create_session( $session_name , $session_value ){
        $_SESSION["$session_name"] = "$session_value" ;
    }
    
    function directTo( $page ){
        header("Location: $page");
        exit();
    }

    function fix_rotate_jpg_image( $tmp_name ){
        
        $exif = exif_read_data( $tmp_name );
        if (!empty($exif['Orientation'])) {
            $imageResource = imagecreatefromjpeg($tmp_name); // provided that the image is jpeg. Use relevant function otherwise
            switch ($exif['Orientation']) {
                case 3:
                $image = imagerotate($imageResource, 180, 0);
                break;
                case 6:
                $image = imagerotate($imageResource, -90, 0);
                break;
                case 8:
                $image = imagerotate($imageResource, 90, 0);
                break;
                default:
                $image = $imageResource;
            } 
        }
        imagejpeg($image, $tmp_name, 90);

    }



    
        
    function time_ago( $db_msg_time ){

        $db_time      = strtotime( $db_msg_time );

        date_default_timezone_set('Africa/Cairo');

        $current_time = time();
        $seconds = $current_time - $db_time ;

        $minutes = floor($seconds / 60); // 60
        $hours   = floor($seconds / 3600); // 60 *60
        $days    = floor($seconds / 86400); // 60 *60 * 24
        $weeks   = floor($seconds / 604800); // 60 *60 * 24 * 7
        $months  = floor($seconds / 2592000); // 60 *60 * 24 * 30
        $years   = floor($seconds / 31536000); // 60 *60 * 24 * 30 *12


        if( $seconds <= 60 ){
            return "Just Now";
        }
        elseif( $minutes <= 60 ){

            if( $minutes == 1 ){
                return "1 minute ago";
            }else{
                return $minutes . " minutes ago";
            }

        }
        elseif( $hours <= 24 ){

            if( $hours == 1 ){
                return "1 hour ago";
            }else{
                return $hours . " hours ago";
            }

        }
        elseif( $days <= 7 ){

            if( $days == 1 ){
                return "1 day ago";
            }else{
                return $days . " days ago";

            }

        }
        elseif( $weeks <= 4.3 ){

            if( $weeks == 1 ){
                return "1 week ago";
            }else{
                return $weeks . " weeks ago";

            }

        }
        elseif( $months <= 12 ){

            if( $months == 1 ){
                return "1 month ago";
            }else{
                return $months . " months ago";

            }

        }
        else{
            if( $years == 1 ){
                return "1 year ago";
            }else{
                return $years . " years ago";

            }
        }


    }



?>
