// "use strict"; 

/* 

@section('script')
      
<script src="{{asset('public/backend/backend.js')}}"></script>
@endsection


 */


//header

 window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-162089702-1');

  //=======

    $(document).ready(function () {
        console.log('selected');
        $('#languageChangeMenu').on('change', function () {
        var str = $('#languageChangeMenu').val();
        var url = $('#url').val();
        var formData = {
            id: $(this).val()
        };
        // get section for student
        $.ajax({
            type: "GET",
            data: formData,
            dataType: 'json',
            url: url + '/' + 'systemsetting/language-change',
            success: function (data) {
                url= url + '/' + 'systemsetting/locale'+ '/' + data[0].language_universal;
                window.location.href = url;
                //   console.log(data);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});

  //menu 
    // $('#languageChange').on('change', function() {
    //     var str = $('#languageChange').val();
    //     window.location.href =str;
    // });

    //===

    $(".popover-content").css("display","none"); 
    $(document).ready(function() {
    $(".popover-content").css("display","none");
    $('#summernote').summernote(
    {
        height: 250,
        focus: true
    }
    );

    });



   ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );

    CKEDITOR.replace('#editor', { 
      height: 500
    });

    //  $('#languageChange').on('change', function () {
    //     var str = $('#languageChange').val();
    //     console.log(str);

    // });
//footer


 $('#modalAddBrand').on('shown.bs.modal', function() {
         $('#summernoteError').summernote({
            height:300,
         });
});

 $('#modalLogin').on('shown.bs.modal', function() {
         $('#summernoteLogin').summernote({
            height:300,
         });
});

  // for select2 multiple dropdown in send email/Sms in Individual Tab
    // $("#selectStaffss").select2();
    // $("#checkbox").click(function () {
    //     if ($("#checkbox").is(':checked')) {
    //         $("#selectStaffss > option").prop("selected", "selected");
    //         $("#selectStaffss").trigger("change");
    //     } else {
    //         $("#selectStaffss > option").removeAttr("selected");
    //         $("#selectStaffss").trigger("change");
    //     }
    // });


    // // for select2 multiple dropdown in send email/Sms in Class tab
    // $("#selectSectionss").select2();
    // $("#checkbox_section").click(function () {
    //     if ($("#checkbox_section").is(':checked')) {
    //         $("#selectSectionss > option").prop("selected", "selected");
    //         $("#selectSectionss").trigger("change");
    //     } else {
    //         $("#selectSectionss > option").removeAttr("selected");
    //         $("#selectSectionss").trigger("change");
    //     }
    // });

//category add
    function changeOrder() {

    var category_status=document.getElementById("category_status");
    var category_status_value = category_status.options[category_status.selectedIndex].value;
    var x = document.getElementById("position_div");

    if (category_status_value==1) {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}


// pending product

     $(".popover").css("display","none"); 
          $(document).ready(function() {
            $(".popover").css("display","none");
            $('.summernote').summernote(
                {
                    height: 250,
                    focus: true
                }
            );
            
            });

//========


//Report

   function setDate(sel) {
        var selected_option= sel.value;
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; 
        var yyyy = today.getFullYear();
            if(dd<10) 
            {
                dd='0'+dd;
            } 
            if(mm<10) 
            {
                mm='0'+mm;
            } 

            today = mm+'/'+dd+'/'+yyyy;
            if (selected_option==1) {
                document.getElementById('startDate').value=today;
                document.getElementById('endDate').value=today;
                console.log(today);
                
            }
            if (selected_option==2) {
                var days=1; // Days you want to subtract
                var date = new Date();
                var last = new Date(date.getTime() - (days * 24 * 60 * 60 * 1000));
                var day =last.getDate();
                var month=last.getMonth()+1;
                var year=last.getFullYear();
                if(day<10) 
                {
                    day='0'+day;
                } 
                if(month<10) 
                {
                    month='0'+month;
                } 
                var second_date= month+'/'+day+'/'+year;
                var date_string=second_date+' To '+today;
                document.getElementById('startDate').value=second_date;
                document.getElementById('endDate').value=second_date;
                console.log(date_string);
                
            }
            if (selected_option==3) {
                var days=7; // Days you want to subtract
                var date = new Date();
                var last = new Date(date.getTime() - (days * 24 * 60 * 60 * 1000));
                var day =last.getDate();
                var month=last.getMonth()+1;
                var year=last.getFullYear();
                if(day<10) 
                {
                    day='0'+day;
                } 
                if(month<10) 
                {
                    month='0'+month;
                } 
                var second_date= month+'/'+day+'/'+year;
                var date_string=second_date+' To '+today;
                document.getElementById('startDate').value=second_date;
                document.getElementById('endDate').value=today;
                console.log(date_string);
                
            }
            if (selected_option==4) {
                var days=30; // Days you want to subtract
                var date = new Date();
                var last = new Date(date.getTime() - (days * 24 * 60 * 60 * 1000));
                var day =last.getDate();
                var month=last.getMonth()+1;
                var year=last.getFullYear();
                if(day<10) 
                {
                    day='0'+day;
                } 
                if(month<10) 
                {
                    month='0'+month;
                } 
                var second_date= month+'/'+day+'/'+year;
                var date_string=second_date+' To '+today;
                document.getElementById('startDate').value=second_date;
                document.getElementById('endDate').value=today;
                console.log(date_string);
                
            }
            if (selected_option==5) {
                var date = new Date(), year = date.getFullYear(), month = date.getMonth()+1;
               
                if(month<10) 
                {
                    month='0'+month;
                } 
                var firstDay =month+'/'+'01'+'/'+year;
                var last_day=new Date(year, month, 0).getDate();
                var lastDay = month+'/'+last_day+'/'+year;
                document.getElementById('startDate').value=firstDay;
                document.getElementById('endDate').value=lastDay;
                console.log(last_day);
                
            }
            var lastday = function(y,m){
                 return  new Date(y, m, 0).getDate();
            }
            if (selected_option==6) {
                var date = new Date(), year = date.getFullYear(), month = date.getMonth();
               console.log('month '+month);
               
                if(month<10) 
                {
                    month='0'+month;
                } 
                var firstDay =month+'/'+'01'+'/'+year;
                var last_day=lastday(year,month);
                var lastDay = month+'/'+last_day+'/'+year;
                document.getElementById('startDate').value=firstDay;
                document.getElementById('endDate').value=lastDay;
                console.log(last_day);
                
            }
            if (selected_option==7) {
                document.getElementById('startDate').focus();
                // document.getElementById('endDate').focus();
                // document.getElementById('startDate').value=firstDay;
                // document.getElementById('endDate').value=lastDay;
                
            }
            if (selected_option==8) {
                var date = new Date(), year = date.getFullYear(), month = date.getMonth();
               console.log('month '+month);
               
                if(month<10) 
                {
                    month='0'+month;
                } 
                var firstDay ='01'+'/'+'01'+'/'+year;
                var last_day=lastday(year,month);
                var lastDay = '12'+'/'+'31'+'/'+year;
                document.getElementById('startDate').value=firstDay;
                document.getElementById('endDate').value=lastDay;
                
            }
        
    }

    //====

    //Role Permission

        // Fees Assign 
    $('.permission-checkAll').on('click', function () {

        //$('.module_id_'+$(this).val()).prop('checked', this.checked);


       if($(this).is(":checked")){
            $( '.module_id_'+$(this).val() ).each(function() {
              $(this).prop('checked', true);
            });
       }else{
            $( '.module_id_'+$(this).val() ).each(function() {
              $(this).prop('checked', false);
            });
       }
    });



    $('.module_link').on('click', function () {

       var module_id = $(this).parents('.single_permission').attr("id");
       var module_link_id = $(this).val();


       if($(this).is(":checked")){
            $(".module_option_"+module_id+'_'+module_link_id).prop('checked', true);
        }else{
            $(".module_option_"+module_id+'_'+module_link_id).prop('checked', false);
        }

       var checked = 0;
       $( '.module_id_'+module_id ).each(function() {
          if($(this).is(":checked")){
            checked++;
          }
        });

        if(checked > 0){
            $(".main_module_id_"+module_id).prop('checked', true);
        }else{
            $(".main_module_id_"+module_id).prop('checked', false);
        }
     });




    $('.module_link_option').on('click', function () {

       var module_id = $(this).parents('.single_permission').attr("id");
       var module_link = $(this).parents('.module_link_option_div').attr("id");




       // module link check

        var link_checked = 0;

       $( '.module_option_'+module_id+'_'+ module_link).each(function() {
          if($(this).is(":checked")){
            link_checked++;
          }
        });

        if(link_checked > 0){
            $("#Sub_Module_"+module_link).prop('checked', true);
        }else{
            $("#Sub_Module_"+module_link).prop('checked', false);
        }

       // module check
       var checked = 0;

       $( '.module_id_'+module_id ).each(function() {
          if($(this).is(":checked")){
            checked++;
          }
        });


        if(checked > 0){
            $(".main_module_id_"+module_id).prop('checked', true);
        }else{
            $(".main_module_id_"+module_id).prop('checked', false);
        }
     });

     $(document).ready(function () {

$('#infix_payment_btn').on('click',function()
{
$(this).html('Please wait ...')
 .attr('disabled','disabled');
$('#infix_payment_form').submit();
});


});

$(document).ready(function () {
            $(".set > a").on("click", function () {
                if ($(this).hasClass("active")) {
                    $(this).removeClass("active");
                    $(this)
                        .siblings(".content")
                        .slideUp(200);
                    $(".set > a i")
                        .removeClass("fa-minus")
                        .addClass("fa-plus");
                } else {
                    $(".set > a i")
                        .removeClass("fa-minus")
                        .addClass("fa-plus");
                    $(this)
                        .find("i")
                        .removeClass("fa-plus")
                        .addClass("fa-minus");
                    $(".set > a").removeClass("active");
                    $(this).addClass("active");
                    $(".content").slideUp(500);
                    $(this)
                        .siblings(".content")
                        .slideDown(500);
                }
            });
        });

        $('.search__field').prop('readonly', true);

    


     $('#summernote').summernote({
        placeholder: 'Write here',
        tabsize: 2,
        height: 200
      });
      $('.popover').css("display","none")





    CKEDITOR.replace( 'blog_description' );

    