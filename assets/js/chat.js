
$(document).ready( function (){
    "use strict";

    var URL = window.location.href;
    if( URL.includes("chat&receiver") ){


        //============ check receiver || sessionId Admin =================
        if( receiver == "admin" ){
            var chat_Link = "admin_" + sessionId;
        }else if( sessionId == "admin" ){
            var chat_Link = "admin_" + receiver;
        }else{
            if( sessionId > receiver ){
                var chat_Link = sessionId + "_" + receiver;
            }else{
                var chat_Link = receiver +  "_" + sessionId;
            }
        }

        /*======== start connection ============*/   
        var conn = new WebSocket('ws://localhost:8080');
        
        conn.onopen = function(e) {
            console.log("Connection established!");
        };

        conn.onmessage = function(e) {
            console.log(e.data);
        };

        /*===================================================================================
        |   |   |   |   |   |   |   Send Message text
        =====================================================================================*/
        function sendText(){
            var msg_type = "text";
            var msg = $("#send-messege").val();
            if( msg != ""){
                var data = {
                    msg       : msg ,
                    msg_type  : msg_type ,
                    receiver    : receiver ,
                    sessionId : sessionId ,
                    chat_Link : chat_Link ,
                }
                conn.send(JSON.stringify( data ));
                $("#send-messege").val('');
            }
        }

        $("#send-messege").keypress(function (e) { 
            if(e.keyCode == 13){   
                sendText();       
            }
        });
        $(".fa-paper-plane").click(function () { 
            sendText();  
        });      

        /* ====================================================================================
        |   |   |   |   |   |   |   Send Emojis 
        =====================================================================================*/
        $(".emojis-box .emojis").click(function () {

            var msg = $(this).attr("src"); // make emoji is the msg
            var msg_type = "emoji";

            if( msg.length != "" ){

                var data = {
                    msg       : msg ,
                    msg_type  : msg_type ,
                    receiver    : receiver ,
                    sessionId : sessionId ,
                    chat_Link : chat_Link ,
                }
                conn.send(JSON.stringify( data ));
                $("#send-messege").val('');

            }
        });
        /* ====================================================================================
        |   |   |   |   |   |   |   Send Like 
        =====================================================================================*/
        $(".keyboard-section .fa-thumbs-up").click(function () {

            var msg = $(this).attr("class"); // make like is the msg
            var msg_type = "like";

            var data = {
                msg       : msg ,
                msg_type  : msg_type ,
                receiver    : receiver ,
                sessionId : sessionId ,
                chat_Link : chat_Link ,
            }
            conn.send(JSON.stringify( data ));
            $("#send-messege").val('');

        });

        /* ====================================================================================
        |   |   |   |   |   |   |   Send Files 
        =====================================================================================
        $(".content-icon #file ").change( function (){
            var file_name = $(".content-icon #file").val();
            if( file_name.length != "" ){

                $.ajax({
                    type: "POST",
                    url: "includes/ajax/client/send_files.php",
                    data: new FormData( $(" .content-icon ")[0] ),
                    contentType: false,
                    processData: false,
                    success: function (feedback) {
                        if( feedback == "Unvalidate file"){
                            alert("Unvalidate file");
                        }
                        if( feedback == "error connection"){
                            alert("error connection");
                        }
                        if( feedback == "file sent"){

                            $('#inbox-page .chat-area .custom-container').append( "hello"  );
                            $(".chat-area").animate({scrollTop :  $(".chat-area")[0].scrollHeight } , 1000);
                        }
                    }
                });

            }
        });
        */



        /* ====================================================================================
        |   |   |   |   |   |   |   Show Messages 
        =====================================================================================*/
        conn.onmessage = function(e) {

            var data = JSON.parse(e.data);

            /*============= my messeges =================*/
            var myMessegeText     = '<div class="my-message"> <div class="my-message-inner"> <div class="my-message-content">  <div class="message"> <span class="triangle"></span> ' + data.msg + ' </div> </div> </div> </div> '; 
            var myMessegeLike     = '<div class="my-message my_like"> <div class="my-message-inner"> <div class="my-message-content">   <div class="message"> <i class="fas fa-thumbs-up"></i> </div> </div> </div> </div> ';
            var myMessegeEmoji    = '<div class="my-message my_emoji"> <div class="my-message-inner">  <div class="my-message-content">   <div class="message"> <img src=" ' + data.msg +' "  alt=""/> </div> </div> </div> </div> ';

            /*============= friend messeges =================*/
            var friendMessegeText  = '<div class="friend-messege"> <div class="friend-messege-content"> <div class="friend-info">   </div> <div class="message"> <span class="triangle"></span> '+ data.msg +' </div>  </div> </div>';
            var friendMessegeLike  =  '<div class="friend-messege friend_like">  <div class="friend-messege-content"> <div class="friend-info">    </div> <div class="message"> <i class="fas fa-thumbs-up"></i>  </div> </div> </div>';
            var friendMessegeEmoji = '<div class="friend-messege friend_emoji">  <div class="friend-messege-content"> <div class="friend-info">  </div>  <div class="message">   <img src=" ' + data.msg + ' "  alt=""/> </div> </div>   </div>';
            
            if( data.sessionId === sessionId ){
                if( data.msg_type == "text" ){
                    $('#inbox-page .chat-area .custom-container').append( myMessegeText  );
                    $(".chat-area").animate({scrollTop :  $(".chat-area")[0].scrollHeight } , 1000);
                }if( data.msg_type == "like" ){
                    $('#inbox-page .chat-area .custom-container').append( myMessegeLike  );
                    $(".chat-area").animate({scrollTop :  $(".chat-area")[0].scrollHeight } , 1000);
                }if( data.msg_type == "emoji" ){
                    $('#inbox-page .chat-area .custom-container').append( myMessegeEmoji  );
                    $(".chat-area").animate({scrollTop :  $(".chat-area")[0].scrollHeight } , 1000);
                }
            }

            if( data.receiver === sessionId ){
                if( data.msg_type == "text" ){
                    $('#inbox-page .chat-area .custom-container').append( friendMessegeText  );
                    $(".chat-area").animate({scrollTop :  $(".chat-area")[0].scrollHeight } , 1000);
                }if( data.msg_type == "like" ){
                    $('#inbox-page .chat-area .custom-container').append( friendMessegeLike  );
                    $(".chat-area").animate({scrollTop :  $(".chat-area")[0].scrollHeight } , 1000);
                }if( data.msg_type == "emoji" ){
                    $('#inbox-page .chat-area .custom-container').append( friendMessegeEmoji  );
                    $(".chat-area").animate({scrollTop :  $(".chat-area")[0].scrollHeight } , 1000);
                }
            }

        };



    }
});




  