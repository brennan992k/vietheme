//  "use strict";
$(".stripe-button-el").remove();
        
function validateFormForPayment(){
    var confirm = document.forms["payment_main_balance"]["item_comment"].value;
    return true;

}

function validateForm() {
    var bank_name = document.forms["bank_payment"]["bank_name"].value;
    if (bank_name == "") {
        $('#bank_name').html('Bank Name is required !');
        return false;
    }else{            
        $('#bank_name').html('');
    }
    var owner_name = document.forms["bank_payment"]["owner_name"].value;
    if (owner_name == "") {
        $('#owner_name').html('Account owner name is required !');
        return false;
    }else{            
        $('#bank_name').html('');
    }
    var account_number = document.forms["bank_payment"]["account_number"].value;
    if (account_number == "") {
        $('#account_number').html('Account number name is required !');
        return false;
    }else{            
        $('#bank_name').html('');
    }
    var amount = document.forms["bank_payment"]["amount"].value;
    if (amount == "") {
        $('#amount_validation').html('');
        $('#amount_validation').html('Amount is required !');
        return false;
    }
   if (amount<0) {
        $('#amount_validation').html('');
        $('#amount_validation').html('Amount Can not be less than 0');
        return false;
    } 
}
