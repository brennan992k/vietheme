@php
    $footer_link=app('infix_footer_settings');
    // $setting = Modules\Systemsetting\Entities\InfixGeneralSetting::find(1);
    if(isset($footer_link->copyright_text)){ @$copyright_text = @$footer_link->copyright_text; }else{ @$copyright_text = 'Copyright 2019 All rights reserved by Codethemes'; }

@endphp
</div>
</div>

<div class="has-modal modal fade" id="showDetaildModal">
    <div class="modal-dialog modal-dialog-centered" id="modalSize">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="showDetaildModalTile">@lang('lang.new_client_information')</h4>
                <button type="button" class="close icons" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" id="showDetaildModalBody">

            </div>

            <!-- Modal footer -->

        </div>
    </div>
</div>


<!--  Start Modal Area -->
<div class="modal fade invoice-details" id="showDetaildModalInvoice">
    <div class="modal-dialog large-modal modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('lang.add_invoice')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body" id="showDetaildModalBodyInvoice">
            </div>

        </div>
    </div>
</div>



<!-- ================Footer Area ================= -->
<footer class="footer-area pt-20">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 text-center">
                <p>{!! $copyright_text !!} </p>
            </div>
        </div>
    </div>
</footer>
<!-- ================End Footer Area ================= -->

<script src="{{asset('public/backend/')}}/vendors/js/jquery-3.2.1.min.js"></script>
<script src="{{asset('public/backend/')}}/vendors/js/jquery-ui.js">
</script>
<script src="{{asset('public/backend/')}}/vendors/js/jquery.data-tables.js">
</script>
<script src="{{asset('public/backend/')}}/vendors/js/dataTables.buttons.min.js">
</script>
<script src="{{asset('public/backend/')}}/vendors/js/buttons.flash.min.js">
</script>
<script src="{{asset('public/backend/')}}/vendors/js/jszip.min.js">
</script>
<script src="{{asset('public/backend/js/')}}/pdfmake.min.js"></script> 
<script src="{{asset('public/backend/js/')}}/vfs_fonts.js"></script> 
<script src="{{asset('public/backend/')}}/vendors/js/buttons.html5.min.js">
</script>
<script src="{{asset('public/backend/')}}/vendors/js/buttons.print.min.js">
</script>
<script src="{{asset('public/backend/')}}/vendors/js/dataTables.rowReorder.min.js">
</script>
<script src="{{asset('public/backend/')}}/vendors/js/dataTables.responsive.min.js">
</script>
<script src="{{asset('public/backend/')}}/vendors/js/buttons.colVis.min.js">
</script>
<script src="{{asset('public/backend/')}}/vendors/js/popper.js">
</script>
<script src="{{asset('public/backend/')}}/vendors/js/bootstrap.min.js">
</script>
<script src="{{asset('public/backend/')}}/vendors/js/nice-select.min.js"></script>
<script src="{{asset('public/backend/')}}/vendors/js/jquery.magnific-popup.min.js">
</script>
<script src="{{asset('public/backend/')}}/vendors/js/fastselect.standalone.min.js">
</script>
<script src="{{asset('public/backend/')}}/vendors/js/raphael-min.js">
</script>
<script src="{{asset('public/backend/')}}/vendors/js/morris.min.js">
</script>
<script src="https://cdn.ckeditor.com/4.5.1/standard/ckeditor.js"></script>

<script type="text/javascript" src="{{asset('public/backend/')}}/vendors/js/toastr.min.js"></script>

<script type="text/javascript" src="{{asset('public/backend/')}}/vendors/js/moment.min.js"></script>
<script type="text/javascript" src="{{asset('public/backend/')}}/js/bootstrap-datetimepicker.min.js"></script>

<script src="{{asset('public/backend/')}}/vendors/js/bootstrap-datepicker.min.js">
</script>


<script type="text/javascript" src="{{asset('public/backend/')}}/vendors/js/fullcalendar.min.js"></script>

<script src="{{  asset('public/frontend/js/') }}/summernote.min.js"></script>

<script type="text/javascript" src="{{asset('public/backend/')}}/js/jquery.validate.min.js"></script>
<script src="{{asset('public/backend/')}}/vendors/js/select2/select2.min.js"></script>
<script src="{{ asset('public/js/')}}/additional.js"></script>
<script src="{{ asset('public/js/')}}/validate.js"></script>
<script src="{{ asset('public/backend/js/')}}/search.js"></script>
<script src="{{asset('public/backend/')}}/js/color_picker/rgbaColorPicker.js"></script>
<script src="{{asset('public/backend/')}}/js/main.js"></script>
<script src="{{asset('public/backend/')}}/js/custom.js"></script>
<script src="{{asset('public/backend/')}}/js/developer.js"></script>

<script src="{{asset('public/backend/backend.js')}}"></script>
<script src="{{asset('public/backend/footer.js')}}"></script>


    @include('backend/partials/alertMessage')
    <script src="{{asset('public/js/toastr.js')}}"></script>
    {!! Toastr::message() !!}
@yield('script')




</body>
</html>

