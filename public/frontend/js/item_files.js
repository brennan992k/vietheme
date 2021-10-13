"use strict";

function thembnailUpload() {
    var file = document.getElementById("thembnails_upload").files[0];
    if (file) {
        if (file.type == "image/jpeg" || file.type == "image/png") {
            var img = new Image();

            img.src = window.URL.createObjectURL(file);

            img.onload = function() {
                var width = img.naturalWidth,
                    height = img.naturalHeight;
                window.URL.revokeObjectURL(img.src);

                if (width == 80 && height == 80) {
                    document.getElementById("thumbneils_title").style.color = "black";
                    document.getElementById("thumbneils_title").innerHTML = file.name;
                } else {
                    document.getElementById("thumbneils_title").style.color = "red";
                    document.getElementById("thumbneils_title").innerHTML =
                        "Invalid image dimension";
                    document.getElementById("thembnails_upload").value = null;
                }
            };
        } else {
            document.getElementById("thumbneils_title").style.color = "red";
            document.getElementById("thumbneils_title").innerHTML =
                "Invalid file type";
            document.getElementById("thembnails_upload").value = null;
        }
    }
}

function previewUpload() {
    // console.log('up');

    var file = document.getElementById("preview_upload").files[0];
    if (file) {
        if (file.type.indexOf('zip') > -1) {
            document.getElementById("preview_file").innerHTML = file.name;
        } else {
            document.getElementById("preview_file").style.color = "red";
            document.getElementById("preview_file").innerHTML = "Invalid file type";
            document.getElementById("preview_upload").value = null;
        }
    }
}

function mainFileUpload() {
    // console.log('up');

    var file = document.getElementById("mail_file_upload").files[0];
    if (file) {
        if (file.type.indexOf('zip') > -1) {
            document.getElementById("main_file_title").innerHTML = file.name;
        } else {
            document.getElementById("main_file_title").style.color = "red";
            document.getElementById("main_file_title").innerHTML =
                "Invalid file type";
            document.getElementById("mail_file_upload").value = null;
        }
    }
}

function fileUpload() {
    // console.log('up');

    var file = document.getElementById("file_upload").files[0];
    if (file) {
        if (file.type.indexOf('zip') > -1) {
            document.getElementById("file_title").innerHTML = file.name;
        } else {
            document.getElementById("file_title").style.color = "red";
            document.getElementById("file_title").innerHTML = "Invalid file type";
            document.getElementById("file_upload").value = null;
        }
    }
}