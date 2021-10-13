
<input type="hidden" name="url" id="url" value="{{url('/')}}">

<nav id="sidebar">
    <div class="sidebar-header update_sidebar">
        <a href="{{url('/')}}">
            <img src="{{asset(@BackgroundSetting()[0]->image)}}" alt="">
        </a>
        <a id="close_sidebar" class="d-lg-none">
            <i class="ti-close"></i>
        </a>
    </div>

     @php
                $check_permission=  App\Models\AssignModulePermission::where('permission',1)->where('role_id',Auth::user()->role_id)->get();
                $permitted_modules=[];
                foreach ($check_permission as $key => $value) {
                   $permitted_modules[]=$value->module_id;
                }
               
    @endphp


    <ul class="list-unstyled components">

            @if(Auth::user()->role_id == 1 || in_array(1, $permitted_modules))
                <li>
                    <a href="{{url('/admin/dashboard')}}" id="admin-dashboard">

                        <span class="flaticon-speedometer"></span>
                        @lang('lang.dashboard')
                    </a>
                </li>
            @endif

            @if(Auth::user()->role_id == 1 || in_array(2, $permitted_modules))
            <li>
                <a href="#subMenuUser" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-analytics"></span>
                    @lang('lang.user') @lang('lang.management')
                </a>
                <ul class="collapse list-unstyled" id="subMenuUser">
                    @if(Auth::user()->role_id == 1 || in_array(2, $permitted_modules))
                    <li>
                      <a href="{{ route('admin.department') }}" class="action-url">@lang('lang.department')</a>
                    </li>
                    @endif
                    @if(Auth::user()->role_id == 1 || in_array(2, $permitted_modules))
                    <li>
                      <a href="{{ route('admin.user_list') }}" class="action-url">@lang('lang.user') @lang('lang.list')</a>
                    </li>
                    @endif

                    @if(Auth::user()->role_id == 1 || in_array(2, $permitted_modules))
                    <li>
                      <a href="{{ route('admin.vendor') }}" class="action-url">@lang('lang.author') @lang('lang.list')</a>
                    </li>
                    @endif
                    @if(Auth::user()->role_id == 1 || in_array(2, $permitted_modules))
                    <li>
                        <a href="{{ route('admin.customer') }}" class="action-url">@lang('lang.customer') @lang('lang.list') </a>
                    </li>
                    @endif
                    @if(Auth::user()->role_id == 1 || in_array(2, $permitted_modules))
                    <li>
                        <a href="{{ route('admin.agent') }}" class="action-url">@lang('lang.agent') @lang('lang.list') </a>
                    </li>
                    @endif

                    @if(Auth::user()->role_id == 1 || in_array(2, $permitted_modules))
                    <li>
                        <a href="{{ route('admin.userLog') }}" class="action-url">@lang('lang.user') @lang('lang.log') @lang('lang.list')</a>
                    </li>
                    @endif
                    @if(Auth::user()->role_id == 1 || in_array(2, $permitted_modules))
                    <li>
                        <a href="{{ route('admin.registrationBonus') }}" class="action-url">@lang('lang.registration') @lang('lang.bonus')</a>
                    </li>
                    @endif

                </ul>
            </li>

            @endif

            @if(Auth::user()->role_id == 1 || in_array(3, $permitted_modules))
            <li>
                <a href="#subMenuFund" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-analytics"></span>
                    @lang('lang.offline_payment')
                </a>
                <ul class="collapse list-unstyled" id="subMenuFund">
                    @if(Auth::user()->role_id == 1 || in_array(3, $permitted_modules))
                    <li>
                      <a href="{{ route('admin.addFund') }}">@lang('lang.add_fund')</a>
                    </li>
                    @endif
                    @if(Auth::user()->role_id == 1 || in_array(3, $permitted_modules))
                    <li>
                        <a href="{{ route('admin.fundList') }}">@lang('lang.fund_list') </a>
                    </li>
                    @endif
                </ul>
            </li>

            @endif

            @if(Auth::user()->role_id == 1 || in_array(4, $permitted_modules))
            <li>
                <a href="#bankPayment" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-analytics"></span>
                    @lang('lang.bank_payment')
                </a>
                <ul class="collapse list-unstyled" id="bankPayment">
                    @if(Auth::user()->role_id == 1 || in_array(4, $permitted_modules))
                    <li>
                        <a href="{{ route('admin.depositRequest') }}">@lang('lang.bank_deposit_request') </a>
                    </li>
                    @endif
                    @if(Auth::user()->role_id == 1 || in_array(4, $permitted_modules))
                    <li>
                        <a href="{{ route('admin.depositApproved') }}">@lang('lang.approved_request') </a>
                    </li>
                    @endif
                </ul>
            </li>

            @endif
            {{-- @php
                $data=  App\Models\AssignModulePermission::where('module_id',4)->first();
            @endphp
            @if(Auth::user()->role_id == 1 || @$data->permission == 1)
            <li>
                <a href="#subMenuHuman" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-analytics"></span>
                    @lang('lang.humanresource') 
                </a>
                <ul class="collapse list-unstyled" id="subMenuHuman">
                    @if(Auth::user()->role_id == 1 || @$data->permission == 1)
                    <li>
                      <a href="{{ route('admin.department') }}">@lang('lang.department')</a>
                    </li>
                    @endif
                    @if(Auth::user()->role_id == 1 || @$data->permission == 1)
                    <li>
                      <a href="{{ route('admin.user_list') }}">@lang('lang.user') @lang('lang.list')</a>
                    </li>
                    @endif

                </ul>
            </li>

            @endif --}}
            {{-- @php
                $data=  App\Models\AssignModulePermission::where('module_id',5)->first();
            @endphp --}}
            @if(Auth::user()->role_id == 1 || in_array(5, $permitted_modules))
            <li>
                <a href="#subMenuItem" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-analytics"></span>
                    @lang('lang.product')
                </a>
                <ul class="collapse list-unstyled" id="subMenuItem">
                    @if(Auth::user()->role_id == 1 || in_array(5, $permitted_modules))
                    <li>
                      <a href="{{ route('admin.adCategory') }}">@lang('lang.category')</a>
                    </li>
                    @endif
                    @if(Auth::user()->role_id == 1 || in_array(5, $permitted_modules))
                    <li>
                        <a href="{{ route('admin.subCategory') }}"> @lang('lang.sub') @lang('lang.category') </a>
                    </li>
                    @endif
                    @if(Auth::user()->role_id == 1 || in_array(5, $permitted_modules))
                    <li>
                        <a href="{{ route('admin.attributes') }}">@lang('lang.attributes') </a>
                    </li>
                    @endif
                    @if(Auth::user()->role_id == 1 || in_array(5, $permitted_modules))
                    <li>
                        <a href="{{ route('admin.subattributes') }}">@lang('lang.sub') @lang('lang.attributes') </a>
                    </li>
                    @endif
                    {{-- @php
                        $module_link=  App\Models\AssignModulePermission::where('module_id',6)->first();
                    @endphp --}}
                    @if(Auth::user()->role_id == 1 || in_array(6, $permitted_modules))
                    <li>
                        <a href="{{ route('admin.item_preview') }}">@lang('lang.product') @lang('lang.update') @lang('lang.list')</a>
                    </li>

                    @endif
                    {{-- @php
                        $module_link=  App\Models\AssignModulePermission::where('module_id',7)->first();
                    @endphp --}}
                    @if(Auth::user()->role_id == 1 || in_array(7, $permitted_modules))
                    <li>
                        <a href="{{ route('admin.content_pending') }}">@lang('lang.product') @lang('lang.pending') @lang('lang.list')</a>
                    </li>
                    @endif
                    @if(Auth::user()->role_id == 1 || in_array(5, $permitted_modules))
                    <li>
                        <a href="{{ route('admin.content') }}">@lang('lang.product') @lang('lang.list')</a>
                    </li>
                    @endif
                    @if(Auth::user()->role_id == 1 || in_array(5, $permitted_modules))
                    <li>
                        <a href="{{ route('admin.deactive_product') }}">@lang('lang.deactive') @lang('lang.product') @lang('lang.list')</a>
                    </li>
                    @endif
                    @if(Auth::user()->role_id == 1 || in_array(5, $permitted_modules))
                    <li>
                        <a href="{{ route('admin.free_product') }}">@lang('lang.free') @lang('lang.product') @lang('lang.list')</a>
                    </li>
                    @endif


                    {{-- ==== Product Setting menu is added for create product package system ===== --}}

                    {{-- @if(Auth::user()->role_id == 1 || @$data->permission == 1)
                    <li>
                        <a href="{{ route('admin.ProductSetting') }}">@lang('lang.product') @lang('lang.setting')</a>
                    </li>
                    @endif --}}
                </ul>
            </li>

            @endif
            {{-- @php
                $data=  App\Models\AssignModulePermission::where('module_id',8)->first();
            @endphp --}}
            @if(Auth::user()->role_id == 1 || in_array(8, $permitted_modules))
            <li>
                <a href="#ItemOrder" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-analytics"></span>
                    @lang('lang.product') @lang('lang.order')
                </a>
                <ul class="collapse list-unstyled" id="ItemOrder">
                    @if(Auth::user()->role_id == 1 || in_array(8, $permitted_modules))
                    <li>
                      <a href="{{ route('admin.item_order') }}">@lang('lang.order')</a>
                    </li>
                    @endif
                </ul>
            </li>

            @endif
            {{-- @php
                $data=  App\Models\AssignModulePermission::where('module_id',9)->first();
            @endphp --}}
            @if(Auth::user()->role_id == 1 || in_array(9, $permitted_modules))
            <li>
                <a href="#RefundItem" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-analytics"></span>
                    @lang('lang.refund') @lang('lang.order')
                </a>
                <ul class="collapse list-unstyled" id="RefundItem">
                    @if(Module::has('Refund'))
                        <li> <a href="{{ route('admin.refund_list') }}">@lang('lang.refund') @lang('lang.type')</a> </li>
                    @endif
                    @if(Auth::user()->role_id == 1 || in_array(9, $permitted_modules))
                    <li>
                      <a href="{{ route('admin.refund_order') }}">@lang('lang.request') @lang('lang.refund') @lang('lang.order')</a>
                    </li>
                    @endif
                    @if(Auth::user()->role_id == 1 || in_array(9, $permitted_modules))
                    <li>
                      <a href="{{ route('admin.approved_refund_order') }}">@lang('lang.refund') @lang('lang.list')</a>
                    </li>
                    @endif
                </ul>
            </li>
            {{-- @if(Module::has('Refund'))
            <li>
                <a href="#Refund" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-analytics"></span>
                    @lang('lang.refund') @lang('lang.type')
                </a>
                <ul class="collapse list-unstyled" id="Refund">
                    <li> <a href="{{ route('admin.refund_list') }}">@lang('lang.refund') @lang('lang.list')</a> </li>
                </ul>
            </li>
        @endif           --}}
            @endif
             
            {{-- @php
                $data=  App\Models\AssignModulePermission::where('module_id',10)->first();
            @endphp --}}
            @if(Auth::user()->role_id == 1 || in_array(10, $permitted_modules))
            <li>
                <a href="#ItemFee" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-analytics"></span>
                    @lang('lang.buyer') @lang('lang.fee')
                </a>
                <ul class="collapse list-unstyled" id="ItemFee">
                    @if(Auth::user()->role_id == 1 || in_array(10, $permitted_modules))
                    <li>
                       <a href="{{ route('admin.item_fee') }}">@lang('lang.buyer') @lang('lang.fee')</a>
                    </li>
                    @endif
                    {{-- @if(Auth::user()->role_id == 1 || @$data->permission == 1)
                    <li>
                      <a href="{{ route('admin.buyerItemFee') }}">@lang('lang.buyer') @lang('lang.item')  @lang('lang.fee')</a>
                    </li>
                    @endif --}}
                    {{-- @if(Auth::user()->role_id == 1 || @$data->permission == 1)
                    <li>
                        <a href="{{ route('admin.fee_type') }}">@lang('lang.buyer') @lang('lang.fee') @lang('lang.type')</a>
                    </li>
                    @endif --}}
                   
                   
                </ul>
            </li>

            @endif
            {{-- @php
                $data=  App\Models\AssignModulePermission::where('module_id',11)->first();
            @endphp --}}
            @if(Auth::user()->role_id == 1 || in_array(11, $permitted_modules))
            <li>
                <a href="#package" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-slumber"></span>
                    @lang('lang.author') @lang('lang.level')
                </a>
                <ul class="collapse list-unstyled" id="package">
                    @if(Auth::user()->role_id == 1 || in_array(11, $permitted_modules))
                    <li>
                        <a href="{{ route('admin.label') }}">@lang('lang.level') @lang('lang.list')</a>
                    </li>
                    @endif
                    @if(Auth::user()->role_id == 1 || in_array(11, $permitted_modules))
                    <li>
                        <a href="{{ route('admin.badge') }}">@lang('lang.badge') @lang('lang.list')</a>
                    </li>
                    @endif
                    {{-- @if(Auth::user()->role_id == 1 || in_array(11, $permitted_modules))
                    <li>
                        <a href="{{ route('admin.package_type') }}">@lang('lang.package')  @lang('lang.type')</a>
                    </li>
                    @endif
                    @if(Auth::user()->role_id == 1 || in_array(11, $permitted_modules))
                    <li>
                        <a href="{{ route('admin.package') }}">@lang('lang.package')  @lang('lang.plan')</a>
                    </li>
                    @endif --}}
                   
                    @if(Auth::user()->role_id == 1 || in_array(11, $permitted_modules))
                    <li>
                        <a href="{{ route('admin.review_type') }}">@lang('lang.review') @lang('lang.type')</a>
                    </li>
                    @endif
                    
                    {{-- @if(Auth::user()->role_id == 1 || in_array(11, $permitted_modules))
                    <li>
                        <a href="{{ route('admin.couponFee') }}">@lang('lang.coupon')  @lang('lang.fee')</a>
                    </li>
                    @endif --}}
                </ul>
            </li>

            @endif
            {{-- @dd('test')  --}}
            {{-- @php
                $data=  App\Models\AssignModulePermission::where('module_id',12)->first();
            @endphp --}}
            @if(Auth::user()->role_id == 1 || in_array(12, $permitted_modules))
            <li>
                <a href="#coupon" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-slumber"></span>
                    @lang('lang.coupon')
                </a>
                <ul class="collapse list-unstyled" id="coupon">
                    @if(Auth::user()->role_id == 1 || in_array(12, $permitted_modules))
                        <li>
                            <a href="{{ route('admin.coupon-list') }}">@lang('lang.admin') @lang('lang.coupon')</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.coupon') }}">@lang('lang.coupon')  @lang('lang.plan')</a>
                        </li>
                       
                    @endif
                    {{-- @if(Auth::user()->role_id == 1 || in_array(12, $permitted_modules))
                        <li>
                            <a href="{{ route('admin.fee') }}">@lang('lang.coupon') @lang('lang.limit')</a>
                        </li>
                    @endif --}}
                </ul>
            </li>

            @endif
            {{-- @dd('test1')  --}}

            {{-- @if(Module::has('Newsletter'))
                <li>
                <a href="#n" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-analytics"></span>
                    @lang('lang.newsletter')
                </a>
                <ul class="collapse list-unstyled" id="n">

                    <li>
                      <a href="{{ route('newsletterList') }}">@lang('lang.newsletter')</a>
                    </li>

                </ul>
            </li>
            @endif --}}
            {{-- @php
                $data=  App\Models\AssignModulePermission::where('module_id',11)->first();
            @endphp
            @if(Auth::user()->role_id == 1 || @$data->permission == 1)
            @if(Module::has('Blog'))
                <li>
                <a href="#b" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-analytics"></span>
                    @lang('lang.blog')
                </a>
                <ul class="collapse list-unstyled" id="b">
                    <li>
                      <a href="{{ route('categoryList') }}">@lang('lang.category')</a>
                    </li>                 
                    <li>
                        <a href="{{ route('blogList') }}">@lang('lang.blog')  @lang('lang.list')</a>
                    </li>                   
                </ul>
            </li>
            @endif
            @endif --}}
            {{-- @php
                $data=  App\Models\AssignModulePermission::where('module_id',13)->first();
            @endphp --}}
            @if(Auth::user()->role_id == 1 || in_array(13, $permitted_modules))
            @if(Module::has('KnowledgeBase'))
                <li>
                <a href="#k" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-analytics"></span>
                    @lang('lang.KnowledgeBase')
                </a>
                <ul class="collapse list-unstyled" id="k">
                    <li>
                      <a href="{{ route('KnowledgeBaseCategoryList') }}">@lang('lang.category')</a>
                    </li>                 
                    <li>
                        <a href="{{ route('categoryQuestion') }}">@lang('lang.question')</a>
                    </li>                   
                    <li>
                        <a href="{{ route('questionList') }}">@lang('lang.sub') @lang('lang.question') @lang('lang.&') @lang('lang.answer')</a>
                    </li>                   
                </ul>
            </li>
            @endif
            @endif
            
            {{-- @php
                $data=  App\Models\AssignModulePermission::where('module_id',14)->first();
            @endphp --}}
            @if(Auth::user()->role_id == 1 ||in_array(14, $permitted_modules))
            @if(Module::has('Tax'))
                <li>
                    <a href="#Tax" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <span class="flaticon-analytics"></span>
                        {{-- @lang('lang.system_settings') --}}
                        @lang('lang.tax')
                    </a>
                    <ul class="collapse list-unstyled" id="Tax">
                        <li> <a href="{{ route('admin.tax_list') }}">@lang('lang.tax') @lang('lang.list')</a> </li>
                    </ul>
                </li>
            @endif
            @endif

            {{-- @if(Auth::user()->role_id == 1)
            @if(Module::has('Refund'))
                <li>
                    <a href="#Refund" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <span class="flaticon-analytics"></span>
                        @lang('lang.refund') @lang('lang.type')
                    </a>
                    <ul class="collapse list-unstyled" id="Refund">
                        <li> <a href="{{ route('admin.refund_list') }}">@lang('lang.refund') @lang('lang.list')</a> </li>
                    </ul>
                </li>
            @endif            
            @endif --}}
            {{-- @php
                $data=  App\Models\AssignModulePermission::where('module_id',15)->first();
            @endphp --}}
            @if(Auth::user()->role_id == 1 || in_array(15, $permitted_modules))
                <li>
                    <a href="#payment" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <span class="flaticon-analytics"></span>
                        @lang('lang.payment')
                    </a>
                    <ul class="collapse list-unstyled" id="payment">
                        <li> <a href="{{ route('admin.CreditCard') }}">@lang('lang.save') @lang('lang.credit') @lang('lang.card')</a> </li>
                        <li> <a href="{{ route('admin.paymentMethod') }}">@lang('lang.author_balance')</a> </li>
                        <li> <a href="{{ route('admin.payableUser') }}">@lang('lang.payment') @lang('lang.author')</a> </li>

                    </ul>
                </li> 
            @endif
            {{-- @php
                $data=  App\Models\AssignModulePermission::where('module_id',16)->first();
            @endphp --}}
            @if(Auth::user()->role_id == 1 ||in_array(16, $permitted_modules))
                <li>
                    <a href="#Promotional" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <span class="flaticon-analytics"></span>
                        @lang('lang.promotional')
                    </a>
                    <ul class="collapse list-unstyled" id="Promotional">
                        <li>
                            <a href="{{ route('admin.sendEmailSmsView')}}">@lang('lang.send_email')</a>
                        </li>
                    </ul>
                </li> 
            @endif

         
            {{-- @php
                $data=  App\Models\AssignModulePermission::where('module_id',17)->first();
            @endphp --}}
            @if(Auth::user()->role_id == 1 || in_array(17, $permitted_modules))
                <li>
                    <a href="#recaptcha" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <span class="flaticon-analytics"></span>
                        @lang('lang.re_captcha')
                    </a>
                    <ul class="collapse list-unstyled" id="recaptcha">
                        <li> <a href="{{ route('admin.reCaptcha') }}">@lang('lang.re_captcha') @lang('lang.setting')</a> </li>
                    </ul>
                </li>
            @endif
            {{-- @php
                $data=  App\Models\AssignModulePermission::where('module_id',18)->first();
            @endphp --}}
            @if(Auth::user()->role_id == 1 ||in_array(18, $permitted_modules))
        @if(Module::has('Ticket'))
                <li>
                <a href="#t" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-analytics"></span>
                    @lang('lang.ticket')
                </a>
                <ul class="collapse list-unstyled" id="t">
                    <li>
                      <a href="{{ route('titcketStatus') }}">@lang('lang.ticket') @lang('lang.status')</a>
                    </li>                 
                    <li>
                      <a href="{{ route('infixTicketcategory') }}">@lang('lang.category')</a>
                    </li>                 
                    <li>
                        <a href="{{ route('infixTicketPriority') }}">@lang('lang.priority')</a>
                    </li>                   
                    <li>
                        <a href="{{ route('infixTicket_list') }}">@lang('lang.ticket')</a>
                    </li>                   
                </ul>
            </li>
            @endif
            @endif

            {{-- @php
                $data=  App\Models\AssignModulePermission::where('module_id',19)->first();
            @endphp --}}
            @if(Auth::user()->role_id == 1 || in_array(19, $permitted_modules))
            <li>
                <a href="#revenue" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-analytics"></span>
                    @lang('lang.reports')
                </a>
                <ul class="collapse list-unstyled" id="revenue">
                    <li> <a href="{{ route('admin.revenue') }}">@lang('lang.admin') @lang('lang.revenue')</a> </li>
                    <li> <a href="{{ route('admin.authorRevenue') }}">@lang('lang.author') @lang('lang.revenue')</a> </li>
                </ul>
            </li>
            @endif
            {{-- @php
                $data=  App\Models\AssignModulePermission::where('module_id',20)->first();
            @endphp --}}
            @if(Auth::user()->role_id == 1 || in_array(20, $permitted_modules))
            @if(Module::has('Systemsetting'))
            <li>
                <a href="#SystemSettings" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-analytics"></span>
                    @lang('lang.system_settings')
                    {{-- System Settings --}}
                </a>
                <ul class="collapse list-unstyled" id="SystemSettings">
                    <li> <a href="{{ route('general_setting') }}">@lang('lang.general_settings') </a> </li>
                    <li> <a href="{{ route('manage-adons') }}">@lang('lang.module_manage') </a> </li>
                    

                    <li> <a href="{{ route('email-setting') }}">@lang('lang.email_settings') </a> </li>
                    <li> <a href="{{ route('role-permission') }}">@lang('lang.role_permission') </a> </li>
                    {{-- <li> <a href="{{ route('admin.mail_template') }}">Email template </a> </li> --}}
                    <li> <a href="{{ route('payment-method-setting') }}">@lang('lang.payment_method_settings')</a> </li>
                    <li> <a href="{{ route('language-setting') }}">@lang('lang.language_settings') </a> </li>
                    <li> <a href="{{ route('seo-setting') }}">@lang('lang.SEO_settings') </a> </li>
                    
                    {{-- <li> <a href="{{ route('footer-setting') }}">Footer Settings </a> </li> --}}
                    {{-- <li> <a href="{{ route('purchase-key-setting') }}">Purchase Key</a> </li> --}}
                    <li> <a href="{{ route('theme-setting') }}">@lang('lang.dashboard_themes')</a> </li>
                    <li> <a href="{{ route('backup-settings') }}">@lang('lang.backup')</a> </li>
                    <li> <a href="{{ route('googleAnalytics') }}">@lang('lang.third_party_API')</a> </li>
                    <li> <a href="{{ route('aboutSystem') }}">@lang('lang.about') & @lang('lang.update')</a> </li>

                </ul>
            </li>
        @endif
        @endif
        {{-- @php
                $data=  App\Models\AssignModulePermission::where('module_id',21)->first();
            @endphp --}}
            @if(Auth::user()->role_id == 1 || in_array(21, $permitted_modules))
           @if(Module::has('Pages'))
                <li>
                    <a href="#Pages" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <span class="flaticon-analytics"></span>
                        {{-- @lang('lang.system_settings') --}}
                        @lang('lang.frontend_CMS')
                    </a>
                    <ul class="collapse list-unstyled" id="Pages">
                        <li> <a href="{{ route('HomePage') }}">@lang('lang.home_page')</a> </li>
                        <li> <a href="{{ route('ProfileSetting') }}">@lang('lang.profile_setting')</a> </li>
                        <li> <a href="{{ route('couponText') }}">@lang('lang.coupon')</a> </li>
                        <li> <a href="{{ route('LicensePage') }}">@lang('lang.License')</a> </li>
                        <li> <a href="{{ route('TicketPage') }}">@lang('lang.ticket')</a> </li>
                        <li> <a href="{{ route('privacy-policy') }}">@lang('lang.privacy_policy')</a> </li>
                        <li> <a href="{{ route('terms-conditions') }}">@lang('lang.terms_conditions') </a> </li>
                        <li> <a href="{{ route('market-apis') }}">@lang('lang.market_apis') </a> </li>
                        <li> <a href="{{ route('item-support') }}">@lang('lang.item_support')</a> </li>
                        <li> <a href="{{ route('become-author') }}">@lang('lang.become_author')</a> </li>
                        <li> <a href="{{ route('about-company') }}">@lang('lang.about_company')</a> </li>
                        <li> <a href="{{ route('faqs') }}">@lang('lang.faq')</a> </li>
                    </ul>
                </li>
            @endif
            @endif
            {{-- @php
                $data=  App\Models\AssignModulePermission::where('module_id',22)->first();
            @endphp --}}
        @if(Auth::user()->role_id == 1 || in_array(22, $permitted_modules))
            <li>
                <a href="#frontSetting" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-analytics"></span>
                    @lang('lang.front_settings')
                </a>
                <ul class="collapse list-unstyled" id="frontSetting">
                    <li> <a href="{{ route('site-image-setting') }}">@lang('lang.site_image_settings') </a> </li>
                    {{-- <li> <a href="{{ url('front-setting') }}">@lang('lang.front_settings')</a> </li> --}}
                    {{-- <li> <a href="{{ url('license-feature') }}">@lang('lang.license') @lang('lang.Features') </a> </li> --}}
                    <li> <a href="{{ url('footer-menu') }}">@lang('lang.footer_menu')</a> </li>
                    
                    <li> <a href="{{ route('FooterCustomLink') }}">@lang('lang.footer_custom_link')</a> </li>
                </ul>
            </li>

        @endif

                {{-- <li>
                    <a href="#a" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <span class="flaticon-analytics"></span>
                        {{-- @lang('lang.system_settings') --}}
                        {{-- @lang('lang.AddOns')
                    </a>
                    <ul class="collapse list-unstyled" id="a">
                        <li> <a href="{{ route('admin.addons-setting') }}">Modules Manager</a> </li>
                    </ul>
                </li> --}}






    </ul>
</nav>
