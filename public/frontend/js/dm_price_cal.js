// $("input[name='list_item_price'").change(function({

// });

$(document).ready(function(){
    $("input[name='list_item_price'").change(function(){

      $('#SupportAdd').prop('checked', false);

        var support_fees=$('#support_fees').val();
        var item_support_fees=support_fees/100*this.value;
        var item_support_fees=item_support_fees.toFixed(2);

        $('#show_support_price').text(item_support_fees);
        $('#SupportAdd').val(item_support_fees);

        var get_selected_license=$('input[name=list_item_price]:checked', '#license_list').attr("data-type");

        $('._mod_total').text(this.value);
        $('#item_price').val(this.value);
        if (get_selected_license=='regular_license_price') {
          $('#pop_license_type').val(1);
          $('#support_text').text('Regular');

        }
        if (get_selected_license=='extended_license_price') {
          $('#pop_license_type').val(2);
          $('#support_text').text('Extended');
        }
        if (get_selected_license=='commercial_license_price') {
          $('#pop_license_type').val(3);
          $('#support_text').text('Commercial');
        }
        console.log(get_selected_license);
    });

    $("#SupportAdd").change(function(){
       var item_support_fees=$('#SupportAdd').val();
       var select_license_price=$('input[name=list_item_price]:checked', '#license_list').val();

       var itm_and_support_price=parseFloat(select_license_price)+parseFloat(item_support_fees);
       var show_price=$('input[name=list_item_price]:checked', '#license_list').attr("data-type");
       var normal_price=$('input[name=list_item_price]:checked', '#license_list').attr("data-normal");
       var normal_price=$('#'+normal_price).val();
        
       if(this.checked) {
        
          $('input[name=list_item_price]:checked', '#license_list').val(itm_and_support_price);
          $('#'+show_price).text(itm_and_support_price);
          $('._mod_total').text(itm_and_support_price);
          $('#item_price').val(itm_and_support_price);
          $('#pop_support_time').val(2);
          $('#support_tym').html('12 Months Support');

        }else{
             $('input[name=list_item_price]:checked', '#license_list').val(normal_price);
            $('#'+show_price).text(normal_price);
            $('._mod_total').text(normal_price);
            $('#item_price').val(normal_price);
            $('#pop_support_time').val(1);
            $('#support_tym').html('6 Months Support');
        }
    });
  });