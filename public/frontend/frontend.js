"use strict";

/* 

<script src="{{asset('public/frontend/frontend.js')}}"></script>

 */
$(document).ready(function() {
    $("#btnsubmit1").on("click", function() {
        $(this).html("Please wait ...").attr("disabled", "disabled");
        $("#cust_login").submit();
    });
});

jQuery.validator.setDefaults({
    debug: true,
    success: "valid",
});
$("#password_registration").validate({
    rules: {
        password: {
            required: true,
            minlength: 8,
        },
    },
    submitHandler: function(form) {
        form.submit();
    },
});

//refund

//  $(document).ready(function() {
//       console.log('roled')
//     $(".popover").css("display","none");
//      $('#summernote').summernote(
//          {
//             height: 250,
//             focus: true
//          }
//      );

//   });
// $(".toast-success").css("background","#7c32ff");
//     OnScroll = () => {
//         $(".features_item_modal").empty();
//     };

//Google

window.dataLayer = window.dataLayer || [];

function gtag() {
    dataLayer.push(arguments);
}
gtag("js", new Date());

gtag("config", "UA-162089702-1");

$(document).ready(function() {
    $(".set > a").on("click", function() {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $(this).siblings(".content").slideUp(200);
            $(".set > a i").removeClass("fa-minus").addClass("fa-plus");
        } else {
            $(".set > a i").removeClass("fa-minus").addClass("fa-plus");
            $(this).find("i").removeClass("fa-plus").addClass("fa-minus");
            $(".set > a").removeClass("active");
            $(this).addClass("active");
            $(".content").slideUp(500);
            $(this).siblings(".content").slideDown(500);
        }
    });
});