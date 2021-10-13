"use strict";

jQuery.validator.setDefaults({
    debug: true,
    success: "valid"
    });
    $( "#cust_login" ).validate({
        
        rules: {
            email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength : 8,
                }
            },
    submitHandler: function(form) {
        form.submit();
    }
    });

    jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
        });
        $( "#cus_registration" ).validate({
            
            rules: {
                   email: {
                        required: true,
                        email: true
                    },
                 password : {
                     minlength : 8
                   },
                   password_confirmation : {
                     minlength : 8,
                     equalTo : '[name="password"]'
                 }
                },
        submitHandler: function(form) {
         var recaptcha_check = $("#recaptcha_check").val()
            if (recaptcha_check == 1) {               
                FormSubmit(form)
            }else{
             form.submit(); 
            }
        }
        });
 
        function FormSubmit(form){
         if (grecaptcha.getResponse()) {
             form.submit();            
             } else {
                 alert('Please confirm captcha to proceed')
                 }
        }

   
        $( "#cust_reset_password" ).validate({
            
            rules: {
                   email: {
                        required: true,
                         email: true
                    },
                 password : {
                     minlength : 8
                   },
                   password_confirmation : {
                     minlength : 8,
                     equalTo : '[name="password"]'
                 }
                },
        submitHandler: function(form) {
             form.submit(); 
        }
    });