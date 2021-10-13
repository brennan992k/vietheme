// "use strict";

var url = $('.url').val();
$('.licenseShow').click(function(){
     $('#isence-wrap').toggleClass('lol')
})

$(document).on("click", function(e) {

    if (!$(e.target).closest('.licenseShow').length)  {
        $('#isence-wrap').removeClass('lol')
    }
   
});
function ImgShow(){
     $('.hit').click();
}
 $('#ServiceAdd').click(function () {
   var x=$('#ServiceAdd').is(":checked");       
   if (x) {
        var supportFee = $(this).val();
        var _total = $("#_total").val();
        var totalVal =parseFloat($("#totalVal").val()).toFixed(2);
        var extra_price = $("#extra_price").val();
        var supportFee=parseFloat(_total).toFixed(2)*parseFloat(supportFee)/100;
        // console.log(_total);
        // console.log(supportFee);
        var service_price = parseFloat(supportFee) + parseFloat(_total);
        currency_symbol=document.getElementById('currency_symbol').value;
        _total = document.getElementById('_total').value = service_price;
        document.getElementById('pop_support_time').value = "2";
        reg_total=document.getElementById('Reg_total').innerHTML=currency_symbol+service_price.toFixed(2)
        document.getElementById('totalVal').value=service_price.toFixed(2)
        $('._mod_total').text(_total);
        document.getElementById('item_price').value=_total;
        document.getElementById('extra_price').value=supportFee;
        document.getElementById('support_tym').innerHTML='12 Months Support';
       var status = 'on';


       $(' .Selectsupport >.current').html('12 Months Support');
       $(' .Selectsupport > .list').empty();
       $(" .Selectsupport > .list").append('<li data-value="1"  class="option focus">6 Months Support</li>');
       $(" .Selectsupport > .list").append('<li data-value="2" data-display="12 months support" class="option selected">12 Months Support</li>');

   } else {            
        var supportFee = $(this).val();
        var _total = $("#_total").val();
        var totalVal =$("#totalVal").val();
        var extra_price = $("#extra_price").val();
        //  var supportFee=parseFloat(_total)*parseFloat(supportFee)/100;
        //  var totalVal = parseFloat(totalVal);
         var extra_price = parseFloat(extra_price);
        //  console.log(totalVal);
        //  console.log(extra_price);
        //  console.log(extra_price);
        var service_price =totalVal - extra_price;
        console.log(service_price);
        /*var service_price =parseFloat(_total)- parseFloat(supportFee);*/
        currency_symbol=document.getElementById('currency_symbol').value;
        _total = document.getElementById('_total').value = service_price;
        document.getElementById('pop_support_time').value = "1";
        reg_total = document.getElementById('Reg_total').innerHTML = currency_symbol + service_price.toFixed(2)
        document.getElementById('totalVal').value=service_price.toFixed(2)
        $('._mod_total').text(_total);
        document.getElementById('item_price').value=_total;
         document.getElementById('extra_price').value=supportFee;
        document.getElementById('support_tym').innerHTML='6 Months Support';
        var status = 'off';

        $(' .Selectsupport >.current').html('6 Months Support');
        $(' .Selectsupport > .list').empty();
        $(" .Selectsupport > .list").append('<li data-value="1" data-display="6 months support" class="option selected">6 Months Support</li>');
        $(" .Selectsupport > .list").append('<li data-value="2" class="option focus">12 Months Support</li>');
 
   }
    // console.log(_total);
    
 });
//  $('#ServiceAdd').click(function () {
//     var supportFee=$(this).val();
//     var total=$('#totalVal').val();
//     var ex_total=$('._total').val()
//     var final=parseFloat(supportFee)+parseFloat(total); 
//     $('#BuyerFee').val(supportFee)
//     if (ex_total != final) {
//         $('.Reg_total').text('$'+final)
//         $('._total').val(final)
//         $('._mod_total').text(final)

//         $("#twelve").attr('selected','selected');
//         $("#support_tym").text('12 months support');
//         $("#support_text").text('Regular');
//         $(".Selectsupport span").text('12 months support');
        
//     }else{
//        $('.Reg_total').text('$'+total)
//        $('._total').val(total)
//        $('._mod_total').text(total)
//     }
    
//  });
/*  $("#AddToCart").click((e)=> {

   var _total = $("._total").val();

 }) */
 
 $(document).ready(function() {
	$('.popup-with-form').magnificPopup({
		type: 'inline',
		preloader: false,
		focus: '#name',

		// When elemened is focused, some mobile browsers in some cases zoom in
		// It looks not nice, so we disable it:
		callbacks: {
			beforeOpen: function() {
				if($(window).width() < 700) {
					this.st.focus = false;
				} else {
					this.st.focus = '#name';
				}
			}
		}
	});
});

$(".SelectLicense").change(function(){
    var total=$('#totalVal').val();
    var license= $('#SelectLicense').find('option:selected').val()
    var support= $('#Selectsupport').find('option:selected').val()    
    var Extd_total=$("#Extd_total").val();
    var Extd_percent=$("#Extd_percent").val();
    if (license == 2) {
        if (support ==2) {
            var final =parseFloat(Extd_percent)*parseFloat(Extd_total)+parseFloat(Extd_total);
            $("#support_tym").text('12 months support');
            $("#item_price").val(Extd_total); 
            $("#BuyerFee").val(parseFloat(Extd_percent)*parseFloat(Extd_total)); 
            
        }
        else{
          var final =Extd_total;  
          $("#item_price").val(Extd_total); 
          $("#support_tym").text('6 months support');
        }
      $('._mod_total').text(final);
      $("#support_text").text('Extended');
      
    }
    else{
        if (support == 2) {              
            var final =parseFloat(Extd_percent)*parseFloat(total)+parseFloat(total); 
            $("#support_tym").text('12 months support');
            $("#item_price").val(total); 
            $("#BuyerFee").val(parseFloat(Extd_percent)*parseFloat(total)); 
        }else{
          var final =total; 
          $("#item_price").val(total); 
          $("#support_tym").text('6 months support');
        }
      $('._mod_total').text(final)
      $("#support_text").text('Regular');
    }
      
   
    //var _total = $("._total").val();
   
    
})
$(".Selectsupport").change(function(){
  console.log('clicked');
    var final;
    var total=$('#totalVal').val();
    var license= $('#SelectLicense').find('option:selected').val()
    var support= $('#Selectsupport').find('option:selected').val()
    var Extd_total=$("#Extd_total").val();
    var Extd_percent=$("#Extd_percent").val();
      if (license == 2) {
          if (support ==2) {
              var final =parseFloat(Extd_percent)*parseFloat(Extd_total)+parseFloat(Extd_total);
              $("#support_tym").text('12 months support'); 
              $("#item_price").val(Extd_total); 
              $("#BuyerFee").val(parseFloat(Extd_percent)*parseFloat(Extd_total)); 
          }
          else{
            var final =Extd_total;  
            $("#item_price").val(Extd_total); 
            $("#support_tym").text('6 months support');
          }
        $('._mod_total').text(final);
        $('#_mod_total').val(final);
        $("#support_text").text('Extended');
        
      }
      else{
          if (support == 2) {    
            $("#item_price").val(total);           
              var final =parseFloat(Extd_percent)*parseFloat(total)+parseFloat(total); 
              $("#BuyerFee").val(parseFloat(Extd_percent)*parseFloat(total)); 
              $("#support_tym").text('12 months support');
          }else{
            $("#item_price").val(total); 
            var final =total; 
            $("#support_tym").text('6 months support');
          }
        $('._mod_total').text(final)
        $('#_mod_total').val(final)
        $("#support_text").text('Regular');
      }
    
})
$("#").click(function(){
  var id = $("#item_id").val();
  //console.log(id);
  var item_price = $("#item_price").val();
  var item = $("#totalCartItem").val();
  var total = $("#_mod_total").val();
  var license= $('#SelectLicense').find('option:selected').val();
  var support= $('#Selectsupport').find('option:selected').val();
 /*  if (item_id) {
    var total=parseInt(item)+1
    $("#ti_Shop").append(`<span class="badge_icon" id="cartItem">${total}</span>`)
    $("#cartItem").text(total);
    $("#totalCartItem").val(total);
  } */
    
    var formData = new FormData();
    formData.append('id', id);
    formData.append('total', total);
    formData.append('license_type', license);
    formData.append('support_time', support);
    formData.append('item_price', item_price);

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            });
    
    $.ajax({
            type:'POST',
            enctype: 'multipart/form-data',
            url: url + '/item/cart',
            data:formData,
            processData: false,
            contentType: false,
            success:function(data){
             // console.log(data);
              
                const files = JSON.parse(data.files);
                    $(".fileAdd").append(``)                            
					
            }

        });
  
})

function ChangeItem(params) {
  var license_type ='';
  var support_time ='';
  var subtotal = $("#subtotal").val();    
  var support_charge = $(`.support_charge${params}`).val();      
  var total = $(`.total${params}`).val(); 
  
  var rowId = $(`.rowId${params}`).val();   
  var Extd_percent = $(".Extd_percent").val();

    if (support_charge == 0 ) {
      var support_time = 2;
      var item_price=parseFloat(total)*parseFloat(Extd_percent)+parseFloat(total);
      var charge =parseFloat(total)*parseFloat(Extd_percent);
      
    }else{
      var support_time = 1;
      var item_price=parseInt(total) - parseInt(support_charge);
      var charge = 0
      
    }
    
  var formData = new FormData();
  formData.append('rowId', rowId);
  formData.append('total', item_price);
  formData.append('support_time', support_time);
  formData.append('support_charge', charge);
  formData.append('Extd_percent', Extd_percent);
      $.ajaxSetup({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
          });
  
  $.ajax({
          type:'POST',
          enctype: 'multipart/form-data',
          url: url + '/cart/update/'+rowId,
          data:formData,
          processData: false,
          contentType: false,
          success:function(data){
            var all_item=data.all_item  
          //  console.log(data);
                      
            var  data=data.item;            
            $(`.rowId${params}`).val(data.rowId);  
            //$(".totalPrice").text(data.price);
            $(`.totalP${params}`).text('$'+parseFloat(data.price).toFixed(2));
            $(`.total${params}`).val(data.price); 
            if (data.options['support_time']== 2) {              
              $(`.support${params}`).attr("checked");
              $(`.support_time${params}`).text('12');
            }else{
              $(`.support_time${params}`).text('06');
            }
            if (data.options['support_charge'] == 0) {
              $(`.support_charge${params}`).val(0); 
            }else{
              $(`.support_charge${params}`).val(data.options['support_charge']); 
            }
            var total=0;
           Object.keys(all_item).map(function(key) {
             
               total=parseFloat(all_item[key].price) + parseFloat(total)
            });
            
            $(".totalPrice").text('$'+parseFloat(total).toFixed(2))
          }

      });
  
}
/* $("#CouponCode").click(function(){
  
}) */

jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
  });
  $( "#couponForm" ).validate({         
      rules: {
        coupon_code: {
                  required: true,
              },
          },
  submitHandler: function(form) {
    var coupon_code = $("#coupon_code").val();  
   // console.log(coupon_code);
    
   var formData = new FormData();
   formData.append('coupon_code', coupon_code);
 
       $.ajaxSetup({
           headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
           }
           });
 
   $.ajax({
       url: url + '/customer/coupon/check',
       method: 'POST',
       data:formData,
       dataType: 'json',
       processData: false,
       contentType: false,
       success:function (data) {
        console.log(data);
         var total = 0;
         if (!data.error) { 
          var  dat=data.item;          
          var all_item=data.all_item           
          $(`.totalP${dat.id}`).text('$'+parseFloat(dat.price).toFixed(2));
          Object.keys(all_item).map(function(key) {
             
            total=parseFloat(all_item[key].price) + parseFloat(total)
         });
         $(".totalPrice").text('$'+parseFloat(total).toFixed(2)) 
         $("#copon_applied").text('Coupon Applied');
         var coup_notice=document.getElementById('coupon_notice');
         coup_notice.style.display = 'block';
         }
         if (data.error) {
           toastr.error(data.error);
         }
         
          
       },
       error: function(error) {
           console.log(error);
           
           toastr.error('Something went wrong ! try again ','Error');
       }
   });
  }
  });

  $( "#commentID" ).validate({         
      rules: {
        body: {
                  required: true,
              },
          },
  submitHandler: function(form) {
    form.submit();
  }
  });
  $( "#ReplyID" ).validate({         
      rules: {
        body: {
                  required: true,
              },
          },
  submitHandler: function(form) {
    form.submit();
  }
  });
  $( "#Text_support" ).validate({         
      rules: {
        message: {
                  required: true,
              },
          },
  submitHandler: function(form) {
    form.submit();
  }
  });

        function regularLicence() {
          reguler_price=document.getElementById('reguler_price').innerHTML;
          currency_symbol=document.getElementById('currency_symbol').value;
          document.getElementById("ServiceAdd").checked = false;
          reguler_price = reguler_price.substring(1);
          reguler_price = parseFloat(reguler_price);
          reg_total=document.getElementById('Reg_total').innerHTML=currency_symbol+reguler_price;
          license_type=document.getElementById('license_type').innerHTML="Regular License";
          document.getElementById('support_text').innerHTML='Regular';
          _total=document.getElementById('_total').value=reguler_price;
          $('._mod_total').text(_total)
          document.getElementById("reg_val").selected = true;

          $(' .SelectLicense >.current').html('Regular');
          $(' .SelectLicense > .list').empty();
          $(" .SelectLicense > .list").append('<li data-value="1" data-display="Regular" class="option selected focus">Regular</li>');
          $(" .SelectLicense > .list").append('<li data-value="2" class="option">Extended</li>');

        document.getElementById('totalVal').value = reguler_price;
        document.getElementById('item_price').value = reguler_price;
        document.getElementById('pop_license_type').value = "1";
      }
      function extendedLicence() {
        extended_price=document.getElementById('extended_price').innerHTML;
        currency_symbol=document.getElementById('currency_symbol').value;
        document.getElementById("ServiceAdd").checked = false;
        extended_price = extended_price.substring(1);
          extended_price = parseFloat(extended_price);
          reg_total=document.getElementById('Reg_total').innerHTML=currency_symbol+extended_price;
          _total=document.getElementById('_total').value=extended_price;
          document.getElementById("support_text").innerHTML = "Extended";
          license_type=document.getElementById('license_type').innerHTML="Extended License";
        $('._mod_total').text(_total);
        $("#Ex_val").attr('selected', 'selected');
        // alert('clicked');




        //test
        $(' .SelectLicense >.current').html('Extended');
        $('.SelectLicense > .list').empty();
        $(".SelectLicense > .list").append('<li data-value="1"  class="option">Regular</li>');
        $(".SelectLicense > .list").append('<li data-value="2" data-display="Extended"  class="option selected focus" >Extended</li>');

        
        document.getElementById('totalVal').value = extended_price;
        document.getElementById('item_price').value = extended_price;
        document.getElementById('pop_license_type').value = "2";
      }
      _total=document.getElementById('_total').value;
