var fileInput = document.getElementById('photo');
if (fileInput) {
    fileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        var fileInput = event.srcElement;
        var fileName = fileInput.files[0].name;
        document.getElementById('placeholderPhoto').placeholder = fileName;
    }
}


// student section info for student admission
$(document).ready(function () {
    $('#background-color').hide();
    $('#background-image').hide();
});

$(document).ready(function () {
    $('#background-type').change(function () {
        if ($(this).val() == "") {
            $('#background-color').hide();
            $('#background-image').hide();
        } else if ($(this).val() == "color") {
            $('#background-color').show();
            $('#background-image').hide();
        } else if ($(this).val() == "image") {
            $('#background-color').hide();
            $('#background-image').show();
        }

    });
});



function showHideConfig() {
    var checkBox = document.getElementById("configure_check");
    var text = document.getElementById("showHideDiv");
    console.log('Checkbox clicked');
    if (checkBox.checked == true) {
        text.style.display = "block";
    } else {
        text.style.display = "none";
    }
};
// Add Multiple env term in add payment method
$(document).ready(function () {

    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper

    var fieldHTML = `
        <div class="add_payment_btn">
                                        <div class="row mt-40 align-itesm-center justify-content-between ">

                                                <div class="col-lg-6">
                                                    <div class="input-effect add_single_payment">
                                                        <input class="primary-input form-control{{ $errors->has('field_name') ? ' is-invalid' : '' }}" type="text" name="field_name[]" autocomplete="off" value="">
                                                        <label>ENV Key <span>*</span></label>
                                                        <span class="focus-border"></span>

                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control{{ $errors->has('field_value') ? ' is-invalid' : '' }}" type="text" name="field_value[]" autocomplete="off" value="">
                                                        <label>ENV Value <span>*</span></label>
                                                        <span class="focus-border"></span>

                                                    </div>
                                                </div>

                                                <button type="button" name="create" style=" background: #ff0000;" class="primary-btn icon-only fix-gr-bg remove_button">
                                                    <span class="ti-close"></span>
                                                </button>
                                            </div>
                                    </div>`;
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function () {
        console.log('clicked');
        //Check maximum number of input fields
        if (x < maxField) {
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function (e) {
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});







// currency info
$(document).ready(function () {

    $("#gs_currency").change(function () {
        var url = $('#url').val();

        var formData = {
            id: $(this).val()
        };

        console.log(formData);

        // get section for student
        $.ajax({
            type: "GET",
            data: formData,
            dataType: 'json',
            url: url + '/' + 'systemsetting/ajaxSelectCurrency',

            success: function (data) {

                var symbol = data[0].symbol;
                $('#gs_currency_symbol').val(symbol);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    // });
});


(function () {
    $(document).ready(function () {
        $('.switch-input').on('change', function () {


            if ($(this).is(':checked')) {

                var status = 'on';

            } else {

                var status = 'off';
            }




            var formData = {
                id: $(this).parents('tr').attr("id"),
                status: status,
            };



            var url = $('#url').val();

            $.ajax({
                type: "GET",
                data: formData,
                dataType: 'json',
                url: url + '/' + 'admin/login-access-permission',
                success: function (data) {



                    setTimeout(function () {
                        toastr.success('Operation Success!', 'Success Alert', { "iconClass": 'customer-info' }, { timeOut: 2000 });
                    }, 500);



                },
                error: function (data) {

                    console.log('no');

                    setTimeout(function () {
                        toastr.error('Operation Success!', 'Error Alert', { timeOut: 5000 });
                    }, 500);
                }
            });






        });
    });

})();

(function () {
    $(document).ready(function () {
        $('.switch_status').on('change', function () {

            if ($(this).is(':checked')) {

                var status = 'on';

            } else {

                var status = 'off';
            }

            var formData = {
                id: $(this).parents('tr').attr("id"),
                status: status,
            };



            var url = $('#url').val();

            $.ajax({
                type: "GET",
                data: formData,
                dataType: 'json',
                url: url + '/' + 'admin/user/approve',
                success: function (data) {

                    setTimeout(function () {
                        toastr.success('Operation Success!', 'Success Alert', { "iconClass": 'customer-info' }, { timeOut: 2000 });
                    }, 500);



                },
                error: function (data) {

                    console.log('no');

                    setTimeout(function () {
                        toastr.error('Operation Success!', 'Error Alert', { timeOut: 5000 });
                    }, 500);
                }
            });






        });
    });

})();



(function () {

    $(document).ready(function () {
        $("#foysal").click(function () {
            var maxField = 10; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button fix-gr-bg">-</a></div>'; //New input field html
            var x = 1; //Initial field counter is 1

            alert("The paragraph was clicked.");
            //Once add button is clicked
            $(addButton).click(function () {
                //Check maximum number of input fields
                if (x < maxField) {
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function (e) {
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });

    });

})();

function showHideConfig() {
    var checkBox = document.getElementById("configure_check");
    var text = document.getElementById("showHideDiv");
    // console.log('Checkbox clicked');
    if (checkBox.checked == true) {
        text.style.display = "block";
    } else {
        text.style.display = "none";
    }
}




































