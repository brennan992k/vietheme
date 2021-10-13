"use strict";

$(document).ready(function() {
    $(".lol").magnificPopup({
        type: "inline",
        preloader: false,
        focus: "#name",
        // When elemened is focused, some mobile browsers in some cases zoom in
        // It looks not nice, so we disable it:
        callbacks: {
            beforeOpen: function() {
                if ($(window).width() < 700) {
                    this.st.focus = false;
                } else {
                    this.st.focus = "#name";
                }
            },
        },
    });
});

function refreshModalContent() {
    location.reload();
    // $("#test-form2").close();
}

function Rates(val, id, order_id) {
    //  console.log($('.lol').val());
    console.log(val);

    console.log(id);
    $(".starRate").empty();

    $("#RatVAl").val(id);
    $("#order_id").val(order_id);
    //$("#star5").attr('checked', true);
    if (val == 0.5) {
        // $('#half5').attr('checked', '');
        document.getElementById("starS.5").setAttribute("checked", "");
        document.getElementById("starS1").removeAttribute("checked", "");
        document.getElementById("starS1.5").removeAttribute("checked", "");
        document.getElementById("starS2").removeAttribute("checked", "");
        document.getElementById("starS2.5").removeAttribute("checked", "");
        document.getElementById("starS3").removeAttribute("checked", "");
        document.getElementById("starS3.5").removeAttribute("checked", "");
        document.getElementById("starS4").removeAttribute("checked", "");
        document.getElementById("starS4.5").removeAttribute("checked", "");
        document.getElementById("starS5").removeAttribute("checked", "");

        document.getElementById("final_rating").value = ".5";
    }
    if (val == 1) {
        // $("#star1").attr('checked', '');
        document.getElementById("starS.5").setAttribute("checked", "");
        document.getElementById("starS1").setAttribute("checked", "");
        document.getElementById("starS1.5").removeAttribute("checked", "");
        document.getElementById("starS2").removeAttribute("checked", "");
        document.getElementById("starS2.5").removeAttribute("checked", "");
        document.getElementById("starS3").removeAttribute("checked", "");
        document.getElementById("starS3.5").removeAttribute("checked", "");
        document.getElementById("starS4").removeAttribute("checked", "");
        document.getElementById("starS4.5").removeAttribute("checked", "");
        document.getElementById("starS5").removeAttribute("checked", "");

        document.getElementById("final_rating").value = "1";
    }
    if (val == 1.5) {
        // $("#star1.5").attr('checked', '');
        document.getElementById("starS.5").setAttribute("checked", "");
        document.getElementById("starS1").setAttribute("checked", "");
        document.getElementById("starS1.5").setAttribute("checked", "");
        document.getElementById("starS2").removeAttribute("checked", "");
        document.getElementById("starS2.5").removeAttribute("checked", "");
        document.getElementById("starS3").removeAttribute("checked", "");
        document.getElementById("starS3.5").removeAttribute("checked", "");
        document.getElementById("starS4").removeAttribute("checked", "");
        document.getElementById("starS4.5").removeAttribute("checked", "");
        document.getElementById("starS5").removeAttribute("checked", "");

        document.getElementById("final_rating").value = "1.5";
    }
    if (val == 2) {
        // $("#star2").attr('checked', '');
        document.getElementById("starS.5").setAttribute("checked", "");
        document.getElementById("starS1").setAttribute("checked", "");
        document.getElementById("starS1.5").setAttribute("checked", "");
        document.getElementById("starS2").setAttribute("checked", "");
        document.getElementById("starS2.5").removeAttribute("checked", "");
        document.getElementById("starS3").removeAttribute("checked", "");
        document.getElementById("starS3.5").removeAttribute("checked", "");
        document.getElementById("starS4").removeAttribute("checked", "");
        document.getElementById("starS4.5").removeAttribute("checked", "");
        document.getElementById("starS5").removeAttribute("checked", "");

        document.getElementById("final_rating").value = "2";
    }
    if (val == 2.5) {
        // $("#star2.5").attr('checked', '');
        document.getElementById("starS.5").setAttribute("checked", "");
        document.getElementById("starS1").setAttribute("checked", "");
        document.getElementById("starS1.5").setAttribute("checked", "");
        document.getElementById("starS2").setAttribute("checked", "");
        document.getElementById("starS2.5").setAttribute("checked", "");
        document.getElementById("starS3").removeAttribute("checked", "");
        document.getElementById("starS3.5").removeAttribute("checked", "");
        document.getElementById("starS4").removeAttribute("checked", "");
        document.getElementById("starS4.5").removeAttribute("checked", "");
        document.getElementById("starS5").removeAttribute("checked", "");

        document.getElementById("final_rating").value = "2.5";
    }
    if (val == 3) {
        document.getElementById("starS.5").setAttribute("checked", "");
        document.getElementById("starS1").setAttribute("checked", "");
        document.getElementById("starS1.5").setAttribute("checked", "");
        document.getElementById("starS2").setAttribute("checked", "");
        document.getElementById("starS2.5").setAttribute("checked", "");
        document.getElementById("starS3").setAttribute("checked", "");
        document.getElementById("starS3.5").removeAttribute("checked", "");
        document.getElementById("starS4").removeAttribute("checked", "");
        document.getElementById("starS4.5").removeAttribute("checked", "");
        document.getElementById("starS5").removeAttribute("checked", "");

        document.getElementById("final_rating").value = "3";
    }
    if (val == 3.5) {
        // $("#star3.5").attr('checked', '');
        document.getElementById("starS.5").setAttribute("checked", "");
        document.getElementById("starS1").setAttribute("checked", "");
        document.getElementById("starS1.5").setAttribute("checked", "");
        document.getElementById("starS2").setAttribute("checked", "");
        document.getElementById("starS2.5").setAttribute("checked", "");
        document.getElementById("starS3").setAttribute("checked", "");
        document.getElementById("starS3.5").setAttribute("checked", "");
        document.getElementById("starS4").removeAttribute("checked", "");
        document.getElementById("starS4.5").removeAttribute("checked", "");
        document.getElementById("starS5").removeAttribute("checked", "");

        document.getElementById("final_rating").value = "3.5";
    }
    if (val == 4) {
        // $("#star4").attr('checked', '');
        document.getElementById("starS.5").setAttribute("checked", "");
        document.getElementById("starS1").setAttribute("checked", "");
        document.getElementById("starS1.5").setAttribute("checked", "");
        document.getElementById("starS2").setAttribute("checked", "");
        document.getElementById("starS2.5").setAttribute("checked", "");
        document.getElementById("starS3").setAttribute("checked", "");
        document.getElementById("starS3.5").setAttribute("checked", "");
        document.getElementById("starS4").setAttribute("checked", "");
        document.getElementById("starS4.5").removeAttribute("checked", "");
        document.getElementById("starS5").removeAttribute("checked", "");

        document.getElementById("final_rating").value = "4";
    }
    if (val == 4.5) {
        // $("#star4.5").attr('checked', '');
        document.getElementById("starS.5").setAttribute("checked", "");
        document.getElementById("starS1").setAttribute("checked", "");
        document.getElementById("starS1.5").setAttribute("checked", "");
        document.getElementById("starS2").setAttribute("checked", "");
        document.getElementById("starS2.5").setAttribute("checked", "");
        document.getElementById("starS3").setAttribute("checked", "");
        document.getElementById("starS3.5").setAttribute("checked", "");
        document.getElementById("starS4").setAttribute("checked", "");
        document.getElementById("starS4.5").setAttribute("checked", "");
        document.getElementById("starS5").removeAttribute("checked", "");

        document.getElementById("final_rating").value = "4.5";
    }
    if (val == 5) {
        // $("#star5").attr('checked', '');
        document.getElementById("starS.5").setAttribute("checked", "");
        document.getElementById("starS1").setAttribute("checked", "");
        document.getElementById("starS1.5").setAttribute("checked", "");
        document.getElementById("starS2").setAttribute("checked", "");
        document.getElementById("starS2.5").setAttribute("checked", "");
        document.getElementById("starS3").setAttribute("checked", "");
        document.getElementById("starS3.5").setAttribute("checked", "");
        document.getElementById("starS4").setAttribute("checked", "");
        document.getElementById("starS4.5").setAttribute("checked", "");
        document.getElementById("starS5").setAttribute("checked", "");

        document.getElementById("final_rating").value = "5";
    }
}
$("#test-form2").validate({
    rules: {
        comment: {
            required: true,
        },
        rating: {
            required: true,
        },
        review_type: {
            required: true,
        },
    },
    submitHandler: function(form) {
        var data = $("#review_type").find("option:selected").val();
        if (data != "Select" && $.isNumeric(data)) {
            form.submit();
        } else {
            // document.getElementById('review_type_msg');
            $("#review_type_msg").html("Please select review type");
            //  alert('Please Review Type');
        }
    },
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $("#pro_pic").attr("src", e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
    $("#Propic_chng").text(input.files[0].name);
}

function BackImg(input) {
    $("#back_pic").text(input.files[0].name);
}

function NotifyUpdate(id) {
    var url = document.getElementById("url").value;
    $.ajax({
        type: "GET",
        dataType: "json",
        url: url + "/" + "user-update-item-email/" + id,
        success: function(data) {
            if (data.success) {
                toastr.success(data.success);
            }
            if (data.error) {
                toastr.error(data.error);
            }
        },
        error: function(data) {
            //  console.log('Error:', data);
        },
    });
}
