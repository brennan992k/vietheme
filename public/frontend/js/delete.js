"use strict";

function deleItem(id) {
    swal({
            title: 'Are you sure?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel',
            confirmButtonClass: 'boxed-btn',
            cancelButtonClass: 'boxed-btn-gray',
            buttonsStyling: false,
            reverseButtons: true
    }).then((result) => {
            if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).click();
            }
            
        })
}
function deleItemAll() {
    swal({
            title: 'Are you sure?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel',
            confirmButtonClass: 'boxed-btn',
            cancelButtonClass: 'boxed-btn-gray',
            buttonsStyling: false,
            reverseButtons: true
    }).then((result) => {
            if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-lol').click();
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
function RestoreItem(id) {
    swal({
            title: 'Are you sure?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Restore',
            cancelButtonText: 'Cancel',
            confirmButtonClass: 'boxed-btn',
            cancelButtonClass: 'boxed-btn-gray',
            buttonsStyling: false,
            reverseButtons: true
    }).then((result) => {
            if (result.value) {
                    event.preventDefault();
                    document.getElementById('restore-form-'+id).click();
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