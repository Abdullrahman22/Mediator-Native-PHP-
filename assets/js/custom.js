

/* ====================================================================================
|   |   |   |   |   |   |    Libararies
=====================================================================================*/

$(document).ready( function (){
    "use strict";

    /*======== WOW Libarary ===========*/ 
    new WOW().init();

    /*======== Counter Libarary ===========*/ 
    $('.counter').counterUp({
        delay: 10,
        time: 2000
    });

    /*======== Owl-carousel Libarary for testmonials ===========*/ 
    $("#customers-testimonials ").owlCarousel({
        items: 1,
        autoplay: true,
        smartSpeed: 700,
        loop: true,
        autoplayHoverPause: true
    });
    /*======== Owl-carousel Libarary for porduct-card ===========*/ 
    $("#porduct-card").owlCarousel({
        responsive:{
            300:{
                items: 1
            },
            577:{
                items: 2
            },
            960:{
                items: 3
            },
            1200:{
                items: 4
            }
        },
        margin: 10,
        nav: true,
        loop: true,
        autoplayHoverPause: true,
        autoplay: true,
        smartSpeed: 900,
        autoplayTimeout: 3500,
    });


    /*======== combostar ===========*/ 
    $('#combostar').on('change', function () {
        var rating = $(this).val()
        if( rating  == 1 ){
            $('#transfer-done .rating').text("Bad");
        }else if( rating  == 2 ){
            $('#transfer-done .rating').text("Acceptable");
        }else if( rating  == 3 ){
            $('#transfer-done .rating').text("Good");
        }else if( rating  == 4 ){
            $('#transfer-done .rating').text("Very Good");
        }else if( rating  == 5 ){
            $('#transfer-done .rating').text("Exellant");
        }
    });
    $('#combostar').combostars({
        starUrl:'assets/images/icons/rating.png',
        starHeight: 38,

    });	
    



});
/* ====================================================================================
|   |   |   |   |   |   |    Global Properties
=====================================================================================*/
$(document).ready( function (){
    "use strict";

    /*======== box shadow for Navbar ===========*/ 

    $(window).scroll(function() {
        if ($(window).scrollTop() > 20) {
            $("#home nav.navbar").css("box-shadow" , "0px 0px 2px 2px #717171cc")
        } else {
            $("#home nav.navbar").css("box-shadow" , "none")
        }
    });

    $(" button.navbar-toggler").click( function (){
        $("#home nav.navbar").css("box-shadow" , "0px 0px 2px 2px #717171cc")
    }); 

    /*======== show / hidden  eye password ===========*/ 

    $(" i.fa-eye-slash").click( function (){
        $(this).hide();
        $(this).siblings("i.fa-eye").show();
        $(this).siblings(".form_control").attr("type" , "text");
    });

    $("i.fa-eye").click( function (){
        $(this).hide();
        $(this).siblings("i.fa-eye-slash").show();
        $(this).siblings(".form_control").attr("type" , "password");
    });



    /*======== Hide / show placeholder ===========*/ 

    //  Hide placeholder
    $("[placeholder]").focus(function(){
        $(this).attr("data-type", $(this).attr('placeholder'));
        $(this).attr("placeholder","");
    });
    //  show placeholder
    $("[placeholder]").blur(function(){
        $(this).attr("placeholder", $(this).attr('data-type'));
    });

    /*======== create session for Languages ===========*/ 
    $(".dropdown-menu .dropdown-item.choose-lang").click(function (e) { 


        var lang = $(this).attr("lang");  
        $.ajax({
            type: "POST",
            url: "includes/ajax/client/lang_session.php",
            data: { "lang" : lang },
            success: function (feedback) {
                if( feedback = 'success' ){
                    location.reload();
                }
            }
        });
    });

    /*======== upload-input get file name ===========  */
    $(".upload-input input").on( "change" , function(){
        
        var filename = this.files[0].name;
        $(this).siblings("label").html( ' <i class="fas fa-cloud-upload-alt"></i> &nbsp; ' + filename );

    });


    
    

});


/* ====================================================================================
|   |   |   |   |   |   |   Home page
=====================================================================================*/
$(document).ready( function (){
    "use strict";

    /*======== create exchange_request  ===========*/ 
    $(".navbar .dropdown-item a.exchange_request").click(function (e) { 
        
        var  exchange_request = true 
        $.ajax({

            type: "POST",
            url: "includes/ajax/client/exchange_request.php",
            data: { "exchange_request" : exchange_request },
            
            
        });

    });

    /*======== create purchase_request  ===========*/ 
    $(" .dropdown-item a.purchase_request").click(function (e) { 
        
        var  purchase_request = true 
        $.ajax({

            type: "POST",
            url: "includes/ajax/client/purchase_request.php",
            data: { "purchase_request" : purchase_request },
            
            
        });

    });


    /*======== create reject-request  ===========*/ 
    $(" .dropdown-item a.reject-request").click(function (e) { 
        
        var  transferId = $(this).attr('tid');
        
        $.ajax({


            type: "POST",
            url: "includes/ajax/client/reject_request.php",
            data: { "transferId" : transferId },
            success: function (feedback) {
                if( feedback == 'reload' || feedback == 'error' ){
                    location.reload();
                }
            }
            
        });
        
    });

    /*======== transfer info hover  ===========*/ 
    $("#my-transfer table .fa-info-circle").hover(function(){
        $(this).siblings(".transfer-info").css("display", "block");
        }, function(){
        $(this).siblings(".transfer-info").css("display", "none");
    });



});

/* ====================================================================================
|   |   |   |   |   |   |   profile page
=====================================================================================*/
$(document).ready( function (){
    "use strict";


    /*======== contentHeight ===========*/ 
    var profileHeight = $("#profile-page").height() + 140 ;
    $("#profile-page .popup-form").css("height" , profileHeight)

    
    /*======== popup edit-info ===========*/ 
    $("#profile-page .header .fa-pen-square").click( function (){
        $("#profile-page .edit-info").fadeIn();
    });
    $("#profile-page .edit-info").click( function () {
        $(this).fadeOut();
    });
    $("#profile-page .edit-info .inner").click( function (e){
        e.stopPropagation();
    });

    
    /*======== popup edit-details ===========*/ 
    $(".content .details h5 i.fa-pen-square").click( function (){
        $("#profile-page .edit-details").fadeIn();
    });
    $("#profile-page .edit-details").click( function () {
        $(this).fadeOut();
    });
    $("#profile-page .edit-details .inner").click( function (e){
        e.stopPropagation();
    });

        
    /*======== popup Add-product ===========*/ 
    $("#profile-page .header .fa-plus-circle").click( function (){
        $("#profile-page .add-product").fadeIn();
    });
    $("#profile-page .add-product").click( function () {
        $(this).fadeOut();
    });
    $("#profile-page .add-product .inner").click( function (e){
        e.stopPropagation();
    });


    /*======== popup delete-product ===========*/ 
    $("#profile-page .product-card .delete-project").click( function (){
        
        var  productId = $(this).attr('productId');
        
        $.ajax({

            type: "POST",
            url: "includes/ajax/client/delete_product.php",
            data: { "productId" : productId },
            success: function (feedback) {
                if( feedback == "deleted"){
                    
                    $(".overlay-white-loading").css("display", "block");
                    setTimeout(function(){
                        $(".overlay-white-loading").css("display", "none");
                        location.reload();
                    }, 2000);


                }if( feedback == "error"){

                    alert( "Error !!" );
                    
                }if( feedback == "not_found"){
                    window.location="index.php";
                }
            }
            
        });

    }); 




    /*======== Accepted checkBox ===========*/ 
    var limit = 3;
    $(' #profile-page .add-product input[type=checkbox] ').on('change', function(evt) {
       if($(this).siblings(':checked').length >= limit) {
            this.checked = false;
       }
    });

    $('#profile-page button[name=add_product_btn]').click(function() {

        
        var checked = $("#profile-page .add-product input[type=checkbox]:checked").length;
        if(!checked) {
            $(".error_messege.error-checkbox").css("display" , "block" );
            return false;
        }else{
            $(".error_messege.error-checkbox").css("display" , "none" ); 
        }
        
        
    });


});

/* ====================================================================================
|   |   |   |   |   |   |    exchange-step2 page
=====================================================================================*/

$(document).ready( function (){
    "use strict";


    /*============== search-input ===============*/ 
    function searchUserForNotiy(){

        var search_content = $("#exchange-step2 .search-input input").val();
        if( search_content != ""){
            
            $.ajax({

                type: "GET",
                url: "includes/ajax/client/users_search.php",
                data: { "search_content" : search_content },
                success: function (feedback) {

                    $(".search-input img").css("display", "block");
                    setTimeout(function(){
                        $(".search-input img").css("display", "none");
                    }, 1000);
                    $("#exchange-step2 .exchange-info .resulte-box").html(feedback);

                }
                
            });

        }

    }
    $("#exchange-step2 .search-input .fa-search").click(function (e) { 
        searchUserForNotiy();        
    });
    $("#exchange-step2 .search-input input").keypress(function (e) { 
        if(e.keyCode == 13){
            searchUserForNotiy();        
        }
    });
     

    /*============== notify user ===============*/ 
    $("#exchange-step2 .notify-user").click(function (e) { 
       
        var friendid = $("#exchange-step2 input.friendID").val();

        $.ajax({
            type: "POST",
            url: "includes/ajax/client/notify_user.php",
            data: { "friendid" : friendid },
            success: function (feedback) {

                if( feedback == "request_isset"){
                    alert("Request Already Exist Please Contact With him to Accept ");
                    window.location.href = 'index.php';
                }
                if( feedback == "request_sent"){
                    $("#exchange-step2 .notify-user").css("display" , "none");
                    $("#exchange-step2 .notify-done").css("display" , "block");
                }
                
            }
        });
    });


    /*=======================  info-content height ===========================*/
    var boxHeight = $("#exchange-step2 .info-content").innerHeight();
    if( boxHeight == 400){
        $("#exchange-step2 span.notify-user").css("top" , "35%")
        $("#exchange-step2 span.notify-done").css("top" , "35%")
    }else{
        $("#exchange-step2 span.notify-user").css("top" , "41%")
        $("#exchange-step2 span.notify-done").css("top" , "41%")
    }

});
/* ====================================================================================
|   |   |   |   |   |   |    Inbox page
=====================================================================================*/
$(document).ready( function () {
    "use strict";

    /* ================ fixed menu ===============*/
    $(".right-section .top-bar i.fa-bars").click(function (){
        $("#inbox-page .fixed-menu").animate({ left : "0px"} , 200);
        $(".right-section > .overlay").fadeIn();
    });
    $(".right-section > .overlay").click(function (){
        $("#inbox-page .fixed-menu").animate({ left : "-270px"}  , 300 );
        $(".right-section > .overlay").fadeOut();
    });


    /*================ userimg  ===============*/

    $("#inbox-page form.userimg input").change( function (){
        var file_name = $(this).val();
        if( file_name.length != "" ){

            $.ajax({
                type: "POST",
                url: "includes/ajax/client/user_img.php",
                data: new FormData( $(" #inbox-page form.userimg ")[0] ),
                contentType: false,
                processData: false,
                success: function (feedback) {

                    if( feedback == "unvalidate_img" ){
                        alert("You must upload only photos");
                    }else{
                        location.reload();
                    }
                   
                }
            });

        }
    });
    

    /* ============ show or hidden emojis-box  ==============*/
    $(".keyboard-section i.fa-smile").click(function(){
        $(".emojis-box").css("display" , "block");
    });
    $(".emojis-box img , .chat-area , .fixed-menu , .left-navbar").click(function(){
        $(".emojis-box").css("display" , "none");
    });

    /*============ show or hidden Search result =============*/
    $(".slider-container .search-input input").focus(function(){
        $(".freinds-messages .slider-container ").fadeOut();
        $(".search-box").fadeIn();

    });
    $("#inbox-page .right-section").click(function(){
        $(".freinds-messages .slider-container ").fadeIn();
        $(".search-box").fadeOut();

    });

    /*============ search user =============*/
    $(".slider-container .search-input input").keypress(function (e) { 
        if(e.keyCode == 13){

            var search_content = $(".slider-container .search-input input").val();
            if( search_content != ""){
                
                $.ajax({

                    type: "GET",
                    url: "includes/ajax/client/inbox_search.php",
                    data: { "search_content" : search_content},
                    success: function (feedback) {
                        $(".slider-container .search-input img").css("display", "block");
                        setTimeout(function(){
                            $(".slider-container .search-input img").css("display", "none");
                        }, 1000);
                        $(".search-box .slider-container").html(feedback);
                    }

                });


            }

        }
    });

    /* ================= Change Like Button at writing ==============*/
    $(document).ready( function () {
        "use strict";
        $('.keyboard-section input').on("focus keyup",function() {
            if ($(this).val() == '') { // check if value changed
                $(".keyboard-section .fa-paper-plane").css("display", "none");
                $(".keyboard-section .fa-thumbs-up").css("display", "inline");
            }
        });
        $('.keyboard-section input').on("keyup",function() {
            if ($(this).val() !== '') { // check if value changed
                $(".keyboard-section .fa-paper-plane").css("display", "inline");
                $(".keyboard-section .fa-thumbs-up").css("display", "none");
            }
        });

    });
});
/* ====================================================================================
|   |   |   |   |   |   |   purchase page
=====================================================================================*/
$(document).ready( function () {
    "use strict";

    $("#purchase-page .form-content select").on("change" , function (){
        var value = $(this).val();
        $.ajax({

            type: "GET",
            url: "includes/ajax/client/get_our_account.php",
            data: { "value" : value},
            success: function (feedback) {
                $("#purchase-page .complete-step .form-content .ourAccount-content").html(feedback);
            }

        });
    });

});
