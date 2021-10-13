"use strict";
var url = $('.url').val();
$(document).ready(function () {

    $("select[name='package_plan']").change(function () {
        var ca = $("select[name='package_plan']").val();  
        $("#package_plan_id").val(ca);
        $.ajax({
            url: url + '/package/' + ca,
            method: 'GET',
            success:function (data) {
                 //console.log(ca);
                 $(".package_price").find('option').remove();
                 $(".package_price").find('li').remove();
                  $(".package_price").find('span').text(data.month)
                    $("select[name='package_price']").append($('<option>', {
                        value: data.month,
                        text: data.month
                    }));
                    $("select[name='package_price']").append($('<option>', {
                        value: data.half_year,
                        text: data.half_year
                    }));
                    $("select[name='package_price']").append($('<option>', {
                        value: data.year,
                        text: data.year
                    }));

                    $(".package_price > ul").append(`<li data-value="${data.month}" data-display="${data.month}" class="option opdel${data.month}"> ${data.month}</li>`);
                    $(".package_price > ul").append(`<li data-value="${data.half_year}" data-display="${data.half_year}" class="option opdel${data.half_year}"> ${data.half_year}</li>`);
                    $(".package_price > ul").append(`<li data-value="${data.year}" data-display="${data.year}" class="option opdel${data.year}"> ${data.year}</li>`);
               
            }
        });
    });



    $("select[name='package_price']").change(function () {       
        var ca = $("select[name='package_price']").val();  
        // console.log(ca);
         $("#total_p").text('$'+ca);
         $("#amount_due").text('$'+ca);
         $("input[name='total']").val(ca);  
         $("input[name='amount]").val(ca);  
    });
});

  $("#Paid_main_balance").on("click", function () {
       var price = $("#_package_price_payment").val(); 
       $.ajax({
           url:url + '/payment-main-balance/'+price,
           method:'GET',
           success:function (data) {
            toastr.success(data);
            window.location.reload()
               //console.log(data);
               
           },
           error:function (error) {
            toastr.error(error.responseJSON);
              //console.log(error.responseJSON);               
           }
       })
       
  })

    $("select[name='package_plan']").change(function () {
        var ca = $("select[name='package_plan']").val();  
        $("#package_plan_id").val(ca);
        $.ajax({
            url: url + '/package/' + ca,
            method: 'GET',
            success:function (data) {
                 //console.log(ca);
                 $(".package_price").find('option').remove();
                 $(".package_price").find('li').remove();
                  $(".package_price").find('span').text(data.month)
                    $("select[name='package_price']").append($('<option>', {
                        value: data.month,
                        text: data.month
                    }));
                    $("select[name='package_price']").append($('<option>', {
                        value: data.half_year,
                        text: data.half_year
                    }));
                    $("select[name='package_price']").append($('<option>', {
                        value: data.year,
                        text: data.year
                    }));

                    $(".package_price > ul").append(`<li data-value="${data.month}" data-display="${data.month}" class="option opdel${data.month}"> ${data.month}</li>`);
                    $(".package_price > ul").append(`<li data-value="${data.half_year}" data-display="${data.half_year}" class="option opdel${data.half_year}"> ${data.half_year}</li>`);
                    $(".package_price > ul").append(`<li data-value="${data.year}" data-display="${data.year}" class="option opdel${data.year}"> ${data.year}</li>`);
               
            }
        });



    $("select[name='package_price']").change(function () {       
        var ca = $("select[name='package_price']").val();  
        // console.log(ca);
         $("#total_p").text('$'+ca);
         $("#amount_due").text('$'+ca);
         $("input[name='total']").val(ca);  
         $("input[name='amount]").val(ca);  
    });
});

jQuery.validator.setDefaults({
    debug: true,
    success: "valid"
    });
    $( "#Pricing_pan_Buy" ).validate({       
        rules: {
            package_plan: {
                    required: true,
                    number: true,
                },
                package_price: {
                    required: true,
                    number: true,
                },
                first_name: {
                    required: true,
                },
                last_name: {
                    required: true,
                },
                company_name: {
                    required: true,
                },
                address: {
                    required: true,
                },
                country_id: {
                    required: true,
                    number: true,
                },
                state_id: {
                    required: true,
                    number: true,
                },
                city_id: {
                    required: true,
                    number: true,
                },
                zipcode: {
                    required: true,
                },
            },
    submitHandler: function(form) {
        form.submit();
    }
    });


    $(document).ready(function() {
        $("#_main_balance").on("click", function () {
            $("#main_balance_on").removeClass("d-none");
            $("#Online_payment").addClass("d-none");
        })
        $("#_Online").on("click", function () {
            $("#Online_payment").removeClass("d-none");
            $("#main_balance_on").addClass("d-none");
        })
    })

    function StripePayment(){
        var ca = $("select[name='package_price']").val();   
        console.log(ca);
        $("#stripe-button").click();
        $("#amount").val(ca);  
       // return submitpayment()
    }