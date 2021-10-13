  
  "use strict"; 


  
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

$('#become_author_summernote').summernote({
            height:400,
   });

