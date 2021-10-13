"use strict";

var url = $('.url').val();   
$(document).ready(function () {

    $("select[name='country_id']").change(function () {
        var ca = $("select[name='country_id']").val();  
        console.log(ca);
        
        $.ajax({
            url: url + '/user/state/' + ca,
            method: 'GET',
            success:function (data) {               
                
                $("#state").empty();
                $(".state > ul").empty();
                data.forEach((files,key) => { 
                    if ( key == 0) {
                        $(".state > span").text(files.name)
                    } 
                    $("select[name='state_id']").append(`<option value="${files.id}" ${key == 0?'selected':''} >${files.name}</option>`);

                    $(".state > ul").append(`<li data-value="${files.id}" ${key == 0?'selected':''} data-display="${files.name}" class="option opdel${files.id}"> ${files.name}</li>`);
                });

               
            }
        });
    });
    $("select[name='state_id']").change(function () {
        var ca = $("select[name='state_id']").val();  
        $.ajax({
            url: url + '/user/city/' + ca,
            method: 'GET',
            success:function (data) {

                $("#city").empty();
                $(".city > ul").empty();
                data.forEach((files,key) => {
                    if ( key == 0) {
                        $(".city > span").text(files.name)
                    } 
                    $("select[name='city_id']").append(`<option value="${files.id}" ${key == 0?'selected':''} >${files.name}</option>`);
                    $(".city > ul").append(`<li data-value="${files.id}" ${key == 0?'selected':''} data-display="${files.name}" class="option opdel${files.id}"> ${files.name}</li>`);
                });
               
            }
        });
    });

});
   