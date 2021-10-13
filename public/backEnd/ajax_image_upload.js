 "use strict";
 

/* 
    <script src="{{ asset('/')}}public/backend/ajax_image_upload.js"></script>
*/
 function upload(img) {
        var form_data = new FormData();
        var token=$("input[name=_token]").val();
        form_data.append('file', img.files[0]);
        form_data.append('_token', token);
        form_data.append('editId', get_img_id);
        var url=$('#url').val();
        $('#loading').css('display', 'block');
        $.ajax({
            url: url+"/systemsetting/ajax-image-upload",
            data: form_data,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.fail) {
                    $('#preview_image').attr('src', url+'/public/images/noimage.jpg');
                    // alert(data.errors['file']);
                    //  setTimeout(function () {
                    //     toastr.error('Operation Success!', 'Error Alert', {
                    //         timeOut: 5000
                    //     });
                    // }, 500);

                    toastr.error(data.errors['file'], 'Error Alert', {
                            timeOut: 5000
                        });
                }
                else {
                    $('#file_name').val(data);
                    $('#preview_image').attr('src', url+'/public/uploads/' + data);
                }
                $('#loading').css('display', 'none');
                  location.reload();
                  
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
                $('#preview_image').attr('src', url+'/public/images/noimage.jpg');
            }
        });
    }



  var get_img_id;
    function lol(val) {
      get_img_id = val;
    }
    function changeProfile() {
        $('#bg_image').click();
        console.log('up clicked');
    }
    $('#bg_image').change(function () {
        console.log('image uploaded');
        if ($(this).val() != '') {
            upload(this);

        }
    });
