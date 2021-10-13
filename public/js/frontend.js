/* 
    
    <script src="{{asset('public/js/frontend.js')}}"></script>
    
    */

(function($) {
    "use strict";
});

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