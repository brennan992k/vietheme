@php 
    $success_message = __('lang.success_message');
    $success_alert = __('lang.success_alert');
    $failed_message = __('lang.failed_message');
    $failed_alert = __('lang.failed_alert');
@endphp

@if(session()->has('message-success'))
    <script>  toastr.success("{{$success_message}}","{{$success_alert}}", {  timeOut: 5000 }); </script>
@elseif(session()->has('message-danger'))
    <script> toastr.error("{{$failed_message}}","{{$failed_alert}}", { timeOut: 5000 }); </script>
@endif 
