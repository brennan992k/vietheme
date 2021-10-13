
"use strict";

var url = $('.url').val();             
var user_id = $('.user_id').val(); 
$('#profile-tab').click(function(){
    window.location.href = url+'/user/portfolio/'+user_id;
});
$('#home-tab').click(function(){
    window.location.href = url+'/user/profile/'+user_id;
});
$('#contact-tab').click(function(){
    window.location.href = url+'/user/followers/'+user_id;
});
$('#Followings-tab').click(function(){
    window.location.href = url+'/user/followings/'+user_id;
});

$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#FollowUser').click(function(){           
        console.log("follow");
        $.ajax({
           type:'GET',
           url:url+'/user/follow/'+user_id,
           data:{user_id:user_id},
           success:function(data){
               console.log(data);
               
            if (data.success) {
                $('#FollowUser').text('Unfollow')
                $('#FollowUser').attr('id','UnfollowUser')
                toastr.success(data.success, 'Success');
            } else {
                toastr.error(data.error,'Error');
            }
        },
        error: function(error) {
            toastr.error('Something went wrong ! try again ','Error');
        }
        });
    });      
    $('#UnfollowUser').click(function(){    
         console.log(user_id);
        $.ajax({
           type:'GET',
           url:url+'/user/unfollow/'+user_id,
           data:{user_id:user_id},
           success:function(data){
             if (data.success) {
                $('#UnfollowUser').text('Follow')
                $('#UnfollowUser').attr('id','FollowUser')
                toastr.success(data.success, 'Success');
            } else {
                toastr.error(data.error,'Error');
                
            }
        },
        error: function(error) {
            toastr.error('Something went wrong ! try again ','Error');
        }
        });
    });      


});

function BuyNow(val){
    $(`#AddtoBuy${val}`).submit()
}