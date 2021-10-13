"use strict";
var url = $('.url').val(); 
var user_id = $('.id').val(); 
var coupon_id = $('.coupon_id').val(); 
$( "#couponStore" ).validate({
    rules: {
       min_price: {
                    required: true,
                    number:true,

             },
      discount: {
                    required: true,
                    number:true
             },
      coupon_code:{
          required:true,
          minlength:6,
        },     
        discount_type:{
          required:true,
        },     
        from:{
          required:true,
        },     
        to:{
          required:true,
        },     
        active_status:{
          required:true,
        }     
            
        },
   submitHandler: function(form) {
       form.submit();
   }
   });
   $('#profile-tab').click(function(){
       window.location.href = url+'/author/coupon-add';
   });
   $('#home-tab').click(function(){
       window.location.href = url+'/author/coupon/'+user_id;
   });
   $('#contact-tab').click(function(){
       window.location.href = url+'/author/coupon-delete/';
   });
   $('#expire-tab').click(function(){
       window.location.href = url+'/author/coupon-expire/';
   });
   $('#from').datepicker({
    format: 'yyyy-mm-dd',
    iconsLibrary: 'fontawesome',
    icons: {
    rightIcon: '<span class="fa fa-caret-down"></span>'
    }
  });
  $('#to').datepicker({
    format: 'yyyy-mm-dd',
    iconsLibrary: 'fontawesome',
    icons: {
    rightIcon: '<span class="fa fa-caret-down"></span>'
    }

  });
  $(document).ready(function() {
      $("#percent").click(function() {
        $(this).prop("checked", true);
        $("#fixed").prop("checked", false);
        $("#discountfixed").attr('placeholder','Enter percent discount');
      })
      $("#fixed").click(function() {
        $(this).prop("checked", true);
        $("#percent").prop("checked", false);
        $("#discountfixed").attr('placeholder','Enter fix discount');
      })
  });