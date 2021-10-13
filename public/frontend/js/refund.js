// "use strict";

jQuery.validator.setDefaults({
    debug: true,
    success: "valid"
    });
    $( "#refund_store" ).validate({
         ignore: [],
        rules: {
               item_id: {
                    required: true,
                    number:true
                },
                ref_id: {
                    required: true,
                    number:true
                }
            },
    submitHandler: function(form) {        
        form.submit();
    }
    });

jQuery.validator.setDefaults({
    debug: true,
    success: "valid"
    });
    $( ".comnts" ).validate({
         ignore: [],
        rules: {
            refund_comment: {
                    required: true,
                },
            },
    submitHandler: function(form) {        
        form.submit();
    }
    });

    function decLine(id) {
        swal({
                title: 'Are you sure?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Decline',
                cancelButtonText: 'Cancel',
                confirmButtonClass: 'boxed-btn',
                cancelButtonClass: 'boxed-btn-gray',
                buttonsStyling: false,
                reverseButtons: true
        }).then((result) => {
                if (result.value) {
                        event.preventDefault();
                        document.getElementById('decline-'+id).click();
                } else if (
                        result.dismiss === swal.DismissReason.cancel
                ) {
                        swal(
                                'Cancelled',
                                'Your data is safe :)',
                                'error'
                        )
                }
        })
    }
    function Approve(id) {
        swal({
                title: 'Are you want to refund?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Approve',
                cancelButtonText: 'Cancel',
                confirmButtonClass: 'boxed-btn',
                cancelButtonClass: 'boxed-btn-gray',
                buttonsStyling: false,
                reverseButtons: true
        }).then((result) => {
                if (result.value) {
                        event.preventDefault();
                        document.getElementById('Approve-'+id).click();
                } else if (
                        result.dismiss === swal.DismissReason.cancel
                ) {
                        swal(
                                'Cancelled',
                                'Your data is safe :)',
                                'error'
                        )
                }
        })
    };

//       $(document).ready(function() {
//       $(".popover").css("display","none");
//        $('#summernote').summernote(
//            {
//               height: 250,
//               focus: true
//            }
//        );
      
//     });
