// "use strict";
function submit_comment(id) {
    // console.log(id);

    $(".comment").css("display", "none");
    $("#t").css("display", "inline");
    $(".displaynone").css("display", "inline");
    $(".submit_comment" + id).css("display", "none");
    $(".submit_comment" + id).addClass("displaynone");
    $(".comment_id").val(id);
    $(".submit_com").css("display", "none");
    $(this).css("display", "block");
    $(".reply_Tox").css("display", "none");
    $("#" + id).css("display", "block");

    //   $('.current').css("display","block")
}
var url = $(".url").val();
$(".reply_Tox").css("display", "none");
// console.log(url);

BeAuthor = () => {
    var checkBox = document.getElementById("tearms_");
    console.log(checkBox);
    if (checkBox.checked == true) {
        $("#become_form").attr("action", "" + url + "/become/author");
    } else {
        $("#become_form").attr("action", "javascript:;");
        $("#Selectterms").text("Select this terms and condition");
    }
};
// $(document).ready(function() {
//   $('#ticket_summernote').summernote();
// });

// CKEDITOR.replace( 'ticket_summernote' );
CKEDITOR.replace("comment_text");

function AttachFile1(input) {
    $("#attach_file1").text(input.files[0].name);
}

function AttachFile2(input) {
    $("#attach_file2").text(input.files[0].name);
}

function AttachFile3(input) {
    $("#attach_file3").text(input.files[0].name);
}

// function AttachFile4(input) {
//     console.log(input);
//     $("#attach_file4").text(input.files[0].name);
// }