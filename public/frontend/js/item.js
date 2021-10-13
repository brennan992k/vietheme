"use strict";

var url = $('.url').val();             
var user_id = $('.user_id').val();  
           
$('#Hidden-tab').click(function(){
/*     $.ajax({
        url: url + '/author/' + 'hidden-item',
        method: 'GET',
        success:function (data) {
            
                    data.forEach(files => {
                       
            
                          
                     
           });
        }
    }); */
    window.location.href = url+'/author/hidden-item/'+user_id;
});
$('#profile-tab').click(function(){
    window.location.href = url+'/author/portfolio/'+user_id;
});
$('#home-tab').click(function(){
    window.location.href = url+'/author/profile/'+user_id;
});
$('#Dashboard-tab').click(function(){
    window.location.href = url+'/author/dashboard/'+user_id;
});
$('#contact-tab').click(function(){
    window.location.href = url+'/author/followers/'+user_id;
});
$('#Followings-tab').click(function(){
    window.location.href = url+'/author/followings/'+user_id;
});
$('#Settings-tab').click(function(){
    window.location.href = url+'/author/setting/'+user_id;
});
$('#Downloads-tab').click(function(){
    window.location.href = url+'/author/download/'+user_id;
});
$('#Reviews-tab').click(function(){
    window.location.href = url+'/author/reviews/'+user_id;
});
$('#refunds-tab').click(function(){
    window.location.href = url+'/author/refunds/'+user_id;
});
$('#payouts-tab').click(function(){
    window.location.href = url+'/author/payout/'+user_id;
});
$('#Followings-tab00').click(function(){
    window.location.href = url+'/author/earning/'+user_id;
});
$('#Statements-tab').click(function(){
    window.location.href = url+'/author/statement/'+user_id;
});

$(document).ready(function() {
    $('.login-nav-box .nav li').click(function() {
        id = $(this).attr('id');
        $('.login-nav-box .nav li.selected, .login-nav-box .both-form.selected').removeClass('selected');
        $('#' + id + ', .login-nav-box .both-form.' + id).addClass('selected');
    });
});

$(document).ready(function () {

    $(".country").change(function () {
        var ca = $(".country").val();  
        $.ajax({
            url: url + '/user/state/' + ca,
            method: 'GET',
            success:function (data) {
                // console.log(data);
                data.forEach(files => {

                    $(".state_id").append($('<option>', {
                        value: files.id,
                        text: files.name
                    }));
                    $(".state > ul").append(`<li data-value="${files.id}" data-display="${files.name}" class="option opdel${files.id}"> ${files.name}</li>`);
                });
               
            }
        });
    });
    $(".state_id").change(function () {
        var ca = $(".state_id").val();  
        $.ajax({
            url: url + '/user/city/' + ca,
            method: 'GET',
            success:function (data) {
                data.forEach(files => {

                    $(".city_id").append($('<option>', {
                        value: files.id,
                        text: files.name
                    }));
                    $(".city > ul").append(`<li data-value="${files.id}" data-display="${files.name}" class="option opdel${files.id}"> ${files.name}</li>`);
                });
               
            }
        });
    });

});

jQuery.validator.setDefaults({
    debug: true,
    success: "valid"
    });
    $( "#personal_infor" ).validate({
           
        rules: {
                mobile: {
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



    $(function() {
        var croppie = null;
        var el = document.getElementById('resizer');
    
        $.base64ImageToBlob = function(str) {
            // extract content type and base64 payload from original string
            var pos = str.indexOf(';base64,');
            var type = str.substring(5, pos);
            var b64 = str.substr(pos + 8);
          
            // decode base64
            var imageContent = atob(b64);
          
            // create an ArrayBuffer and a view (as unsigned 8-bit)
            var buffer = new ArrayBuffer(imageContent.length);
            var view = new Uint8Array(buffer);
          
            // fill the view, using the decoded base64
            for (var n = 0; n < imageContent.length; n++) {
              view[n] = imageContent.charCodeAt(n);
            }
          
            // convert ArrayBuffer to Blob
            var blob = new Blob([buffer], { type: type });
          
            return blob;
        }
    
        $.getImage = function(input, croppie) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {  
                    croppie.bind({
                        url: e.target.result,
                    });
                }
                reader.readAsDataURL(input.files[0]);
                var file = input.files[0];
                //console.log(file);
            }
        }
    
        $("#file-upload").on("change", function(event) {

            $("#myModal").modal();
            croppie = new Croppie(el, {
                    viewport: {
                        width: 200,
                        height: 200,
                        type: 'square'
                    },
                    boundary: {
                        width: 250,
                        height: 250
                    },
                    enableOrientation: true
                });
            $.getImage(event.target, croppie); 

           
        });
       
        $("#upload").on("click", function() {
            croppie.result('base64').then(function(base64) {
                $("#myModal").modal("hide"); 
              //  var t =$("#profile-pic").attr("src",`${url}/public/frontend/img/profile/1.png`); 
                
                //var url = "{{ url('/demos/jquery-image-upload') }}";
                console.log($.base64ImageToBlob(base64).type);
                
                var formData = new FormData();
                formData.append("profile_picture", $.base64ImageToBlob(base64));
    
                // This step is only needed if you are using Laravel
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
               // console.log(t);
             
                $.ajax({
                    type: 'POST',
                    url: url + '/author/profile-pic/' + user_id,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {                        
                        if (data == "success") {
                            toastr.success('Succsesfully profile picture updated', 'Success');
                            $("#profile-pic").attr("src", base64); 
                        } else {
                            //$("#profile-pic").attr("src",`${url}/public/frontend/img/profile/1.png`); 
                            
                        }
                    },
                    error: function(error) {
                        toastr.error('Something went wrong ! try again ','Error');
                       // $("#profile-pic").attr("src",`${url}/public/frontend/img/profile/1.png`); 
                    }
                });
            });
        });
    
        $(".rotate").on("click", function() {
            croppie.rotate(parseInt($(this).data('deg'))); 
        });
    
        $('#myModal').on('hidden.bs.modal', function (e) {
            setTimeout(function() { croppie.destroy(); }, 100);
        })
    
    });

    $(function() {
        var croppie = null;
        var el = document.getElementById('resize');
    
        $.base64ImageToBlob = function(str) {
            // extract content type and base64 payload from original string
            var pos = str.indexOf(';base64,');
            var type = str.substring(5, pos);
            var b64 = str.substr(pos + 8);
          
            // decode base64
            var imageContent = atob(b64);
          
            // create an ArrayBuffer and a view (as unsigned 8-bit)
            var buffer = new ArrayBuffer(imageContent.length);
            var view = new Uint8Array(buffer);
          
            // fill the view, using the decoded base64
            for (var n = 0; n < imageContent.length; n++) {
              view[n] = imageContent.charCodeAt(n);
            }
          
            // convert ArrayBuffer to Blob
            var blob = new Blob([buffer], { type: type });
          
            return blob;
        }
    
        $.getImage = function(input, croppie) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {  
                    croppie.bind({
                        url: e.target.result,
                    });
                }
                reader.readAsDataURL(input.files[0]);
                //var file = input.files[0];
                //console.log(file);
            }
        }
    
        $("#logo-upload").on("change", function(event) {

            $("#LogoPic").modal();
            croppie = new Croppie(el, {
                    viewport: {
                        width: 200,
                        height: 200,
                        type: 'square'
                    },
                    boundary: {
                        width: 250,
                        height: 250
                    },
                    enableOrientation: true
                });
            $.getImage(event.target, croppie); 

           
        });
       
        $("#upload_logo").on("click", function() {
            croppie.result('base64').then(function(base64) {
                $("#LogoPic").modal("hide"); 
              //  var t =$("#profile-pic").attr("src",`${url}/public/frontend/img/profile/1.png`); 
                
                //var url = "{{ url('/demos/jquery-image-upload') }}";
                console.log($.base64ImageToBlob(base64).type);
                
                var formData = new FormData();
                formData.append("logo_pic", $.base64ImageToBlob(base64));
    
                // This step is only needed if you are using Laravel
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
               // console.log(t);
             
                $.ajax({
                    type: 'POST',
                    url: url + '/author/profile-pic/' + user_id,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {                        
                        if (data == "success") {
                            toastr.success('Succsesfully logo picture updated', 'Success');
                            //$("#profile-pic").attr("src", base64); 
                        } else {
                            //$("#profile-pic").attr("src",`${url}/public/frontend/img/profile/1.png`); 
                            
                        }
                    },
                    error: function(error) {
                        toastr.error('Something went wrong ! try again ','Error');
                       // $("#profile-pic").attr("src",`${url}/public/frontend/img/profile/1.png`); 
                    }
                });
            });
        });
    
        $(".rotate").on("click", function() {
            croppie.rotate(parseInt($(this).data('deg'))); 
        });
    
        $('#LogoPic').on('hidden.bs.modal', function (e) {
            setTimeout(function() { croppie.destroy(); }, 100);
        })
    
    });

    

    $(document).ready(function() {
        $('#About_up').click(function(){
            var about = $("#aboutTex").val();
            var formData = new FormData();
            formData.append('about',about);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: url + '/author/profile-pic/' + user_id,
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    console.log(data);
                                            
                    if (data == "success") {
                        toastr.success('Succsesfully profile updated', 'Success');
                    } else {
                        toastr.error('Something went wrong ! try again ','Error');
                        
                    }
                },
                error: function(error) {
                    toastr.error('Something went wrong ! try again ','Error');
                }
            });
        });
    });
    