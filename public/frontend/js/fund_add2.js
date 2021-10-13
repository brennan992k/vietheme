//  "use strict";
 
  function showProcessing() {
        $('.subscribe-process').show();
    }
    function hideProcessing() {
        $('.subscribe-process').hide();
    }

        // Handling and displaying error during form submit.
    function subscribeErrorHandler(jqXHR, textStatus, errorThrown) {
        try {
            var resp = JSON.parse(jqXHR.responseText);
            if ('error_param' in resp) {
                var errorMap = {};
                var errParam = resp.error_param;
                var errMsg = resp.error_msg;
                errorMap[errParam] = errMsg;
            } else {
                var errMsg = resp.error_msg;
                
                $("#alert-danger").addClass('alert alert-danger').removeClass('d-none').text(errMsg);
            }
        } catch (err) {
            $("#alert-danger").show().text("Error while processing your request");
        }
    }
    // Forward to thank you page after receiving success response.
    function subscribeResponseHandler(responseJSON) {
    //window.location.replace(responseJSON.successMsg);
     console.log(responseJSON.state);
        if (responseJSON.state == 'success') {
            toastr.success(responseJSON.message);
            $("#alert-success").addClass('alert alert-success').removeClass('d-none').text(responseJSON.message);
            $("#alert-danger").addClass('d-none');
        }
        if (responseJSON.state == 'error') {
            toastr.error('Something went wrong please try again');
            $("#alert-danger").addClass('alert alert-danger').removeClass('d-none').text(responseJSON.message);
            $("#alert-success").addClass('d-none');
        }
    }