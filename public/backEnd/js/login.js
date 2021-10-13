"use strict"; 

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });


});



$(document).ready(function () {
    $('.login-area p.get-login-access').click(function(){ 
        var abc = $(this).html(); 
        $( "p.get-login-access" ).each(function() {
            if($(this).html() == abc){
                $( this ).addClass( " login-area-button" );
            }else{
                $( this ).removeClass( " login-area-button" );
            } 
        }); 

	var value = $(this).text(); 
    var url = $('#url').val();

    var formData = {
        value : value
    };
    // get section for student
    $.ajax({
        type: "GET",
        data: formData,
        dataType: 'json',
        url: url + '/' + 'ajax-get-login-access',
        success: function (data) {
            console.log(data);

        	if(data != ""){
        		$('#email').val(data.email);
        		$('#password').val(123456);
        	}else{
        		$('#email').val('');
        		$('#password').val();
        	}

        },
        error: function (data) {
            console.log('Error:', data);
        }
    });

});
});


$('.primary-btn').on('click', function(e) {
		// Remove any old one
		$('.ripple').remove();

		// Setup
		var primaryBtnPosX = $(this).offset().left,
			primaryBtnPosY = $(this).offset().top,
			primaryBtnWidth = $(this).width(),
			primaryBtnHeight = $(this).height();

		// Add the element
		$(this).prepend("<span class='ripple'></span>");

		// Make it round!
		if (primaryBtnWidth >= primaryBtnHeight) {
			primaryBtnHeight = primaryBtnWidth;
		} else {
			primaryBtnWidth = primaryBtnHeight;
		}

		// Get the center of the element
		var x = e.pageX - primaryBtnPosX - primaryBtnWidth / 2;
		var y = e.pageY - primaryBtnPosY - primaryBtnHeight / 2;

		// Add the ripples CSS and start the animation
		$('.ripple')
			.css({
				width: primaryBtnWidth,
				height: primaryBtnHeight,
				top: y + 'px',
				left: x + 'px'
			})
			.addClass('rippleEffect');
		});


// $('.btn-group').on('click', '.p', function() {
//   $(this).addClass('fix-gr-bg').siblings().removeClass('fix-gr-bg');
// });
