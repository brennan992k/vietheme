"use strict";
// select item name from selecting item category name
$(document).ready(function() {
    $("#infix_theme_rtl").change(function() {
        var url = $("#url").val();
        var formData = {
            id: $(this).val(),
        };
        console.log(formData);
        $.ajax({
            type: "GET",
            data: formData,
            dataType: "json",
            url: url + "/" + "systemsetting/theme-style-rtl",
            success: function(data) {
                location.reload();
                console.log(data);
            },
        });
    });
});

// select item name from selecting item category name
$(document).ready(function() {
    $("#infix_theme_style").change(function() {
        var url = $("#url").val();
        var formData = {
            id: $(this).val(),
        };
        console.log(formData);
        $.ajax({
            type: "GET",
            data: formData,
            dataType: "json",
            url: url + "/" + "systemsetting/theme-style-active",
            success: function(data) {
                location.reload();
                console.log(data);
            },
        });
    });
});
// select staff name from selecting role name
$(document).ready(function() {
    $("#staffsByRoleCommunication").on("change", function() {
        $("#checkbox").prop("checked", false);
        var url = $("#url").val();
        console.log($(this).val());

        var formData = {
            id: $(this).val(),
        };
        $("#selectStaffss").select2("val", "");
        // get section for student
        $.ajax({
            type: "GET",
            data: formData,
            dataType: "json",
            url: url + "/" + "admin/studStaffByRole",
            success: function(data) {
                // console.log(data);
                var a = "";
                $.each(data, function(i, item) {
                    if (item.length) {
                        $("#selectStaffss").find("option").remove();
                        $("#selectStaffsDiv ul").find("li").not(":first").remove();

                        $.each(item, function(i, students) {
                            $("#selectStaffss").append(
                                $("<option>", {
                                    value: students.email,
                                    text: students.full_name,
                                })
                            );
                        });
                    } else {
                        $("#selectStaffsDiv .current").html("SELECT *");
                        $("#selectStaffss").find("option").not(":first").remove();
                        $("#selectStaffsDiv ul").find("li").not(":first").remove();
                    }
                });
            },
            error: function(data) {
                console.log("Error:", data);
            },
        });
    });
});

//Hold scroll postion after reloading or changeing another page START
let container = $("#sidebar");
let node = $("#sidebar ul .show");
if (node.length > 0) {
    let scrollPosition =
        node.offset().top - container.offset().top + container.scrollTop();
    scrollPosition -= 200;
    container.scrollTop(scrollPosition);
}

function isNumberKey(evt) {
    var charCode = evt.which ? evt.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

//Hold scroll postion after reloading or changeing another page END

// //image upload
// function changeProfile() {
//     $('#file').click();

// }
// $('#file').change(function () {

//     if ($(this).val() != '') {
//         upload(this);

//     }
// });

// function upload(img) {
//     var form_data = new FormData();
//     form_data.append('file', img.files[0]);
//     form_data.append('_token', '{{csrf_token()}}');
//     $('#loading').css('display', 'block');
//     $.ajax({
//         url: "{{url('systemsetting/ajax-image-upload')}}",
//         data: form_data,
//         type: 'POST',
//         contentType: false,
//         processData: false,
//         success: function (data) {
//             if (data.fail) {
//                 $('#preview_image').attr('src', '{{asset('public / uploads / noimage.jpg')}}');
//                 alert(data.errors['file']);
//             }
//             else {
//                 $('#file_name').val(data);
//                 $('#preview_image').attr('src', '{{asset('public / uploads')}}/' + data);
//             }
//             $('#loading').css('display', 'none');
//         },
//         error: function (xhr, status, error) {
//             alert(xhr.responseText);
//             $('#preview_image').attr('src', '{{asset('public / uploads / noimage.jpg')}}');
//         }
//     });
// }
// function removeFile() {
//     if ($('#file_name').val() != '')
//         if (confirm('Are you sure want to remove profile picture?')) {
//             $('#loading').css('display', 'block');
//             var form_data = new FormData();
//             form_data.append('_method', 'DELETE');
//             form_data.append('_token', '{{csrf_token()}}');
//             $.ajax({
//                 url: "systemsetting/ajax-remove-image/" + $('#file_name').val(),
//                 data: form_data,
//                 type: 'POST',
//                 contentType: false,
//                 processData: false,
//                 success: function (data) {
//                     $('#preview_image').attr('src', '{{asset('public / uploads / noimage.jpg')}}');
//                     $('#file_name').val('');
//                     $('#loading').css('display', 'none');
//                 },
//                 error: function (xhr, status, error) {
//                     alert(xhr.responseText);
//                 }
//             });
//         }
// }