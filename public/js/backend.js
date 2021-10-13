
    /* 
    
    <script src="{{asset('public/js/backend.js')}}"></script>
    
    */


   (function ($) {
	'use strict';
});


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