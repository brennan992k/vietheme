"use strict";

var url = $('.url').val();   
$(document).ready(function () {

    $("select[name='country_id']").change(function () {
        var ca = $("select[name='country_id']").val();  
        console.log(ca);
        $('#state')
        .empty()
        .append('<option selected="selected" value="">Select</option>');
        $(".state > ul").append(`<li data-value=""  data-display="Select" class="option opdel"> Select</li>`);

        $('#city')
        .empty()
        .append('<option selected="selected" value="">Select</option>');
        $(".city > ul").append(`<li data-value=""  data-display="Select" class="option opdel"> Select</li>`);
             

        $.ajax({
            url: url + '/user/state/' + ca,
            method: 'GET',
            success:function (data) {               
                // console.log(data);
                $("#state").empty();
                $(".state > ul").empty();
                data.forEach((files,key) => { 
                    if ( key == 0) {
                        $(".state > span").text(files.name)
                    } 
                    $("select[name='state_id']").append(`<option value="${files.id}" ${key == 0?'selected':''} >${files.name}</option>`);

                    $(".state > ul").append(`<li data-value="${files.id}" ${key == 0?'selected':''} data-display="${files.name}" class="option opdel${files.id}"> ${files.name}</li>`);
                });

               
            }
        });
    });
    $("select[name='state_id']").change(function () {
        var ca = $("select[name='state_id']").val();  
        $('#city')
    .empty()
    .append('<option selected="selected" value="">Select</option>');
        
        $.ajax({
            url: url + '/user/city/' + ca,
            method: 'GET',
            success:function (data) {
                console.log(data);
                $("#city").empty();
                $(".city > ul").empty();
                data.forEach((files,key) => {
                    if ( key == 0) {
                        $(".city > span").text(files.name)
                    } 
                    $("select[name='city_id']").append(`<option value="${files.id}" ${key == 0?'selected':''} >${files.name}</option>`);
                    $(".city > ul").append(`<li data-value="${files.id}" ${key == 0?'selected':''} data-display="${files.name}" class="option opdel${files.id}"> ${files.name}</li>`);
                });
               
            }
        });
    });

});

jQuery.validator.setDefaults({
    debug: true,
    success: "valid"
    });
    $( "#checkout_store" ).validate({
     ignore: [],
     rules: {
            first_name: {
                     required: true,
                 },
            last_name:{
                 required: true,
             },
            company_name:{
                 required: false,
             },
             country_id:{
                 required: true,
             },
            //  zipcode:{
            //      required: true,
            //      number:true,
            //  },
             address:{
                 required: true,
             },
             
         },
    submitHandler: function(form) {
        var country= $('#country').find('option:selected').val()
        var state= $('#state').find('option:selected').val()
        var city= $('#city').find('option:selected').val()
    //    if (city =='Select' && state == 'Select' && country =='Select') {
       if (country =='Select') {
           alert('Please select country')
       }else{
           form.submit();
       }
    }
    });
    $(".stripe-button-el").remove();


    $(document).ready(function() {
        $("#_main_balance").on("click", function () {
            $("#_main_balance_on").removeClass("d-none");
            $("#Online_payment").addClass("d-none");
        })
        $("#_Online").on("click", function () {
            $("#Online_payment").removeClass("d-none");
            $("#_main_balance_on").addClass("d-none");
        })
    })

    $("#PackageCheck").on("click", function () {
      //alert($(this).val())
        var price = $("#_package_price_payment").val(); 
      /*   $.ajax({
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
        }) */
        
   })

   document.getElementById('con_balance_pay').style.display = "none";
    function showPayOption (box) {
        console.log(box);
    var chboxs = document.getElementById("con_balance_pay").style.display;
    var vis = "none";
        if(chboxs=="none"){
            vis = "block"; }
        if(chboxs=="block"){
            vis = "none"; }
    document.getElementById(box).style.display = vis;
}