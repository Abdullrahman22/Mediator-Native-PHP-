
/* ====================================================================================
|   |   |   |   |   |   |    Global Properties
=====================================================================================*/
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


    /*======== admin-nav ===========*/ 
    $(".admin-nav .nav-item a").hover(function(){

        $(this).siblings(".absolute").fadeIn();

    }, function(){

        $(this).siblings(".absolute").fadeOut();

    });


}); 
/* ====================================================================================
|   |   |   |   |   |   |   Users / user page 
=====================================================================================*/
$(document).ready( function (){
    "use strict";


    /*======== search-sellers ===========*/ 

    $("input.search-sellers").keypress(function (e) { 
        if(e.keyCode == 13){

            var search_content = $(this).val();
            if( search_content != ""){
                
                
                
                $.ajax({

                    type: "GET",
                    url: "../includes/ajax/admin/sellers_search.php",
                    data: { "search_content" : search_content },
                    success: function (feedback) {

                        $(".search-input img").css("display", "block");
                        setTimeout(function(){
                            $(".search-input img").css("display", "none");
                        }, 1000);
                        $(".search-content").html(feedback);
                        $("#users-page .table-responsive-sm.sellers-table").css("display", "none");
                    }
                    
                });
                


            }

        }
    });


    /*======== search-users ===========*/ 

    $("input.search-users").keypress(function (e) { 
        if(e.keyCode == 13){

            var search_content = $(this).val();
            if( search_content != ""){
                
                
                
                $.ajax({

                    type: "GET",
                    url: "../includes/ajax/admin/users_search.php",
                    data: { "search_content" : search_content },
                    success: function (feedback) {

                        $(".search-input img").css("display", "block");
                        setTimeout(function(){
                            $(".search-input img").css("display", "none");
                        }, 1000);
                        $(".search-content").html(feedback);
                        $("#users-page .table-responsive-sm.users-table").css("display", "none");
                    }
                    
                });
                


            }

        }
    });

    /*======== activate user ===========*/ 
    $("#user-page .activate-user").click( function (){
        var userid = $("#user-page input.userid").val();

        $.ajax({

            type: "POST",
            url: "../includes/ajax/admin/activate_user.php",
            data: { "userid" : userid },
            dataType: "JSON",
            success: function (feedback) {
                location.reload();
            }
            
        });
    });

    /*======== deactivate user ===========*/ 
    $("#user-page .deactivate-user").click( function (){
        var userid = $("#user-page input.userid").val();

        $.ajax({

            type: "POST",
            url: "../includes/ajax/admin/deactivate_user.php",
            data: { "userid" : userid },
            dataType: "JSON",
            success: function (feedback) {
                location.reload();
            }
            
            
        });
    });






}); 
/* ====================================================================================
|   |   |   |   |   |   |   Exchanges page 
=====================================================================================*/
$(document).ready(function (){
    "use strict";


    /*======== panel Slider ===========*/ 
    $("#exchange-page .panel-heading.1st").click(function(){
        $("#exchange-page .panel-body.1st").slideToggle("slow");
        $("#exchange-page .panel-heading.1st i").fadeToggle();
    });
    $("#exchange-page .panel-heading.2nd").click(function(){
        $("#exchange-page .panel-body.2nd").slideToggle("slow");
        $("#exchange-page .panel-heading.2nd i").fadeToggle();
    });
    
   
    
}); 
/* ====================================================================================
|   |   |   |   |   |   |   Payment page
=====================================================================================*/
$(document).ready(function (){
    "use strict";


    /*======== popup add-payment ===========*/ 
    $(".add-payment-btn").click( function (){
        $("#payments-page .add-payment").fadeIn();
    });
    $("#payments-page .add-payment").click( function () {
        $(this).fadeOut();
    });
    $("#payments-page .add-payment .inner").click( function (e){
        e.stopPropagation();
    });

    /*======== Delete Payment ===========*/ 

    $("#payments-page td a.delete-btn").click(function (e) { 

        var id = $(this).parent("td").siblings(".payment-id").val();
        $.ajax({

            type: "POST",
            url: "../includes/ajax/admin/delete_payment.php",
            data: { "id" : id },
            success: function (feedback) {
                location.reload();
            }
        });

    });

    
    /*========  confirm delete ===========*/ 
    $(".delete-btn").click(function (){
        return confirm("Are you Sure ?");
    });



}); 

/* ====================================================================================
|   |   |   |   |   |   |   Products/Product page 
=====================================================================================*/
$(document).ready(function (){
    "use strict";


    /*======== accept-product ===========*/ 
    $("#product-page .btn.accept-product").click( function (){
        var productid = $("#product-page input.productid").val();

        $.ajax({

            type: "POST",
            url: "../includes/ajax/admin/accept_product.php",
            data: { "productid" : productid },
            dataType: "JSON",
            success: function (feedback) {
                location.reload();
            }
            
        });
    });

    /*======== reject-product ===========*/ 
    $("#product-page .btn.reject-product").click( function (){
        var productid = $("#product-page input.productid").val();

        $.ajax({

            type: "POST",
            url: "../includes/ajax/admin/reject_product.php",
            data: { "productid" : productid },
            dataType: "JSON",
            success: function (feedback) {
                location.reload();
            }
            
        });
    });

}); 