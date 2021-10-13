"use strict";

var url = $('.url').val();

$(document).ready(function() {
     
    $('.js-example-basic-multiple').select2({
    
        placeholder: "Please select",
        tags: true,
        allowClear: true
    });
});

$('.single_upload_area').show();

jQuery.validator.setDefaults({
    debug: true,
    success: "valid"
    });
    $( "#select_content" ).validate({
        
        rules: {
        category: {
                    required: true,
                },
            },
    submitHandler: function(form) {
    var data= $('#select_category').find('option:selected').val()
   // console.log(data);
    
        if (data != 'Select Category' && $.isNumeric(data))  {
            form.submit();
        }else
        {
            $("#category_select").text('Please select category')
        }
    }
    });

$(document).ready(function () {
    
                  
        $.ajax({
            url: url + '/admin/' + 'file-view',
            method: 'GET',
            success:function (data) {
                //$(".fileSelect").children().first().remove();
                        data.forEach(files => {
                
                        $(".fileAdd").append(`<div class="single_up_preview file_del${files.id} plus_padding"><div class="row align-items-center">
                                                                <div class="col-xl-6 col-md-7 ">
                                                                    <div class="preview_wrap d-flex align-items-center">
                                                                        <span><i class="ti-check"></i></span>
                                                                        <div class="preview_heading">
                                                                            <h4>`+files.file_name+`</h4>
                                                                            <span>saved</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6 col-md-5">
                                                                    <div class="remove_btn text-right">
                                                                        <a  onClick="onDeleteClick(${files.id})" class="boxed_btn_red">Remove</a>
                                                                    </div>
                                                                </div>
                                                            </div></div>`);

                                   

                                    $('select.fileSelect').append($('<option>', {
                                        value: files.file_name,
                                        text: files.file_name
                                    }));
                                    $(".fileSelect > ul").append(`<li data-value="${files.file_name}" data-display="${files.file_name}" class="option opdel${files.id}"> ${files.file_name}</li>`);
                              
                         
               });
            }
        });

});

$('#file_upload_js').change(function(){
    var fileInput = document.getElementById('file_upload_js');
    var file = fileInput.files[0];
    //console.log(file);
    
    var formData = new FormData();
    formData.append('file', file);
    formData.append('id', $('.id').val());

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            });
    
    $.ajax({
            type:'POST',
            enctype: 'multipart/form-data',
            url: url + '/admin/' + 'files',
            data:formData,
            processData: false,
            contentType: false,
            success:function(data){
                console.log(data);
                
               var input =  $("#file_upload_js");
               input.replaceWith(input.val('').clone(true));
                if (data.error) {
                    $("#file_upload_js_error").text(data.error['file'][0])
                } else { 
                                   
                const files = JSON.parse(data.files);
                    $(".fileAdd").append(`<div class="single_up_preview file_del${files.id} plus_padding"><div class="row align-items-center">
                                                        <div class="col-xl-6 col-md-7 ">
                                                            <div class="preview_wrap d-flex align-items-center">
                                                                <span><i class="ti-check"></i></span>
                                                                <div class="preview_heading">
                                                                    <h4>`+files.file_name+`</h4>
                                                                    <span>saved</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6 col-md-5">
                                                            <div class="remove_btn text-right">
                                                                <a onClick="onDeleteClick(${files.id})" class="boxed_btn_red">Remove</a>
                                                            </div>
                                                        </div>
                                                    </div></div>`);
                                                    $('select.fileSelect').append($('<option>', {
                                                        value: files.file_name,
                                                        text: files.file_name
                                                    }));
                     $('.fileSelect > ul').append(`<li data-value="${files.file_name}" data-display="${files.file_name}" class="option opdel${files.id}">`+files.file_name+`*</li>`)                            
					
             }
            }

        });
});

function onDeleteClick(i) {
  //  alert('Are you sure');
   
    var formData = new FormData();
    formData.append('id',i);
    var id=$('.id').val();
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            });
            console.log(url);
    $.ajax({
            type:'GET',
            url: url + '/admin/' + 'files-delete/'+id,
            // data:formData,
            processData: false,
            contentType: false,
            success:function(data){
               
                
                $(`.file_del${i}`).remove();
                $(`.opdel${i}`).remove();
            }

        });

    
};

function regular(item){
   var Re_item = parseFloat($('#Re_item').val());
   var Re_buyer = parseFloat($('#Re_buyer').val());

   if (Re_item.length != 0) {
       var item = Re_item;
   }else{
    var item = 0;
   }
   var total =parseFloat(item) + parseFloat(Re_buyer);
   $('#Reg_total').val(total);
   $('#Re_total').attr("placeholder",'$'+total);

}
function Extended(item){
   var E_item = parseFloat($('#E_item').val());
   var buyer = parseFloat($('#E_buyer').val());

   if (E_item.length > 0) {
       var item = E_item;
   }else{
    var item = 0;
   }
   var total =parseFloat(item) + parseFloat(buyer);
   $('#E_total').attr("placeholder",'$'+total);
   $('#Ex_total').val(total);

}
function Commercial(item){
   var C_item = parseFloat($('#C_item').val());
   var buyer = parseFloat($('#C_buyer').val());
console.log(buyer);
   if (C_item.length > 0) {
       var item = C_item;
   }else{
    var item = 0;
   }
   var total =parseFloat(item) + parseFloat(buyer);
   $('#C_total').attr("placeholder",'$'+total);
   $('#Co_total').val(total);
   $('#c_price').val(total);

}
jQuery.validator.setDefaults({
    debug: true,
    success: "valid"
    });
    console.log('validation start');
    $( "#file_up" ).validate({
     ignore: [],
     rules: {
             password: {
                     required: true,
                 },
             title:{
                 required: true,
             },
            //  feature1:{
            //      required: true,
            //  },
            //  description:{
            //      required: true,
            //  },
             Re_item:{
                 required: true,
             },
             E_item:{
                 required: true,
             },
             tags:{
                 required: true,
             },
             demo_url:{
                 required: true,
                 url: true
             },
             user_msg:{
                 required: true,
             }
             
         },
    submitHandler: function(form) {
       
    console.log('form submit from file upload js');
        form.submit();
    }
    });
    

    // start coupon


    


