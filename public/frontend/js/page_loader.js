
$(document).ready(function() {
    $("#itemSubmit").on("click", function() {
        $(this).html("Uploading ...");
        $("#file_up").submit();
    });
});
$(document).ready(function() {
    $("#itemSubmit").on("click", function() {
        $(this).html("Uploading ...");
        $('#page_loader').style.display = "block"; 
        // document.querySelector(".loader").style.display = "block";
        $("#file_update").submit();
    });
});

// document.onreadystatechange = function() { 
//     console.log(document.readyState);
//     if (document.readyState !== "complete") { 
//         document.querySelector("body").style.visibility = "hidden"; 
//         document.querySelector(".loader").style.visibility = "visible"; 
//     } else { 
//         document.querySelector("body").style.visibility = "visible"; 
//         document.querySelector(".loader").style.display = "none"; 
//     } 
// }; 