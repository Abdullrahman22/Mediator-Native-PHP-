
$(document).ready( function (){
    "use strict";



    
    /*======== admin ==> show / hidden  eye password ===========*/ 

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


});

