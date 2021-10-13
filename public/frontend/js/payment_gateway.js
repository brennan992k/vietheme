
"use strict";

jQuery.validator.setDefaults({
    debug: true,
    success: "valid"
    });

$( "#payment-form" ).validate({       
    rules: {
        email: {
                required: true,
                email: true,
            },
            username: {
                required: true,
            },
            zipcode: {
                required: true,
            },
            address: {
                required: true,
            },
            card_name: {
                required: true,
            },
            exp: {
                required: true,
            },
            card_number: {
                required: true,
                number:true,
            },
            cvc: {
                required: true,
                number:true,
            },
            country_id: {
                required: true,
                number: true,
            },
            state_id: {
                required: true,
                number: true,
            },
            city_id: {
                required: true,
                number: true,
            }
        },
});
$( "#payment-form_checkout" ).validate({       
    rules: {
        email: {
                required: true,
                email: true,
            },
           
            confirm_email_address: {
                required: true,
                email: true,
            }
        },
});
$( "#paypal_payment_form" ).validate({       
    rules: {
        email: {
                required: true,
                email: true,
            },
            username: {
                required: true,
            },
            zipcode: {
                required: true,
            },
            address: {
                required: true,
            },
            card_name: {
                required: true,
            },
            exp: {
                required: true,
            },
            card_number: {
                required: true,
                number:true,
            },
            cvc: {
                required: true,
                number:true,
            },
            country_id: {
                required: true,
                number: true,
            },
            state_id: {
                required: true,
                number: true,
            },
            city_id: {
                required: true,
                number: true,
            }
        },
});


$(function() {
    $('form.require-validation').bind('submit', function(e) {
      var $form         = $(e.target).closest('form'),
          inputSelector = ['input[type=email]', 'input[type=password]',
                           'input[type=text]', 'input[type=file]',
                           'textarea'].join(', '),
          $inputs       = $form.find('.required').find(inputSelector),
          $errorMessage = $form.find('div.error'),
          valid         = true;
      $errorMessage.addClass('hide');
      $('.has-error').removeClass('has-error');
      $inputs.each(function(i, el) {
        var $input = $(el);
        if ($input.val() === '') {
          $input.parent().addClass('has-error');
          $errorMessage.removeClass('hide');
          e.preventDefault(); // cancel on first error
        }
      });
    });
  });
  $(function() {
    var $form = $("#payment-form");
    $form.on('submit', function(e) {
      if (!$form.data('cc-on-file')) {
        e.preventDefault();
        Stripe.setPublishableKey($form.data('stripe-publishable-key'));
        Stripe.createToken({
          number: $('.card_number').val(),
          cvc: $('.cvc').val(),
          exp_month:parseInt( $('.exp_mm').val()),
          exp_year: parseInt($('.exp_yy').val())
        }, stripeResponseHandler);
      }
    });
    function stripeResponseHandler(status, response) {
      if (response.error) {
        $('.error')
          .removeClass('d-none')
          .find('.alert')
          .text(response.error.message);
      } else {
        // token contains id, last4, and card type
        var token = response['id'];
        // insert the token into the form so it gets submitted to the server
        $form.find('input[type=text]').empty();
        $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
        $form.get(0).submit();
      }
    }
  })

  $( "#select_content" ).validate({
        
    rules: {
    category: {
                required: true,
            },
        },
submitHandler: function(form) {
var data= $('#select_category').find('option:selected').val()
// console.log(data);

    if (data != 'Select Category' && $.isNumeric(data))  {
        form.submit();
    }else
    {
        alert('Please select category')
    }
}
});
  $( "#customer_save_card" ).validate({
        
    rules: {
      name: {
        required: true,
    },
    exp: {
        required: true,
    },
    card_number: {
        required: true,
        number:true,
    },
    cvc: {
        required: true,
        number:true,
    },
        },
submitHandler: function(form) {
        form.submit();
}
});


