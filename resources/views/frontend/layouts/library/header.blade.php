<header>
    <div class="container">
        <!-- Site Logo -->
        <a href="{{ route('welcome') }}" class="site-logo col-md-3">
            <i class="gi gi-flash"></i> <strong>{{ __('Framgia') }}</strong>{{ __('Medicines') }}
        </a>
        <!-- End Site Logo -->
        <div class="col-md-3" id="area-search-header-form-id">
            {!! Form::open(['route' => 'frontend.search', 'method' => 'get'], ['class' => 'search-form']) !!}
                <div class="form-group input-group search-form margin-bottom-0px">
                    {!! Form::text('keyword', '', ['class' => 'form-control z-index-100', 'placeholder' => trans('label.search'), 'autocomplete' => 'off', 'data-bind' => 'event:{keyup: searchHeaderMedicine, focus: searchHeaderMedicine}']) !!}
                    <span class="input-group-btn">
                        {!! Form::button(null, ['class' => 'btn btn-default glyphicon glyphicon-search top-0px', 'type' => 'submit']) !!} 
                    </span>
                </div>
                <div class="search-form position-relative">
                    <div class="col-sm-12 prescrition-search-item position-absolute hide" id="search-header-medicine-result">
                        <ul class="list-group" data-bind="foreach: searchItems">
                            <a data-bind="attr:{href: '/detail/' + id + '/' + str_slug(name)}">
                                <li class="list-group-item">
                                    <span data-bind="text: name"></span>
                                </li>
                            </a>
                        </ul>
                        <ul class="list-group" data-bind="if: searchItems().length == 0">
                            <div class="text-center alert-danger cursor-pointer">
                                {{ __('Medicine not found!') }}
                            </div>
                        </ul>
                    </div>
                </div>
            {!! Form::close() !!}
            <div class="hide" id="over-header-full-screen" data-bind="click: closeHeaderMedicineResult"></div>
        </div>
        <!-- Site Navigation -->
        <nav class="col-md-6">
            <!-- Menu Toggle -->
            <!-- Toggles menu on small screens -->
            <a href="javascript:void(0)" class="btn btn-default site-menu-toggle visible-xs visible-sm">
                <i class="fa fa-bars"></i>
            </a>
            <!-- END Menu Toggle -->

            <!-- Main Menu -->
            <ul class="site-nav pull-right">
                <!-- Toggles menu on small screens -->
                <li class="visible-xs visible-sm">
                    <a href="javascript:void(0)" class="site-menu-toggle text-center">
                        <i class="fa fa-times"></i>
                    </a>
                </li>
                <!-- END Menu Toggle -->
                <li>
                    <a href="javascript:void(0)" class="site-nav-sub"><i class="fa fa-angle-down site-nav-arrow"></i>{{ __('Categories') }}</a>
                    <ul>
                        @foreach ($frontendAllParentCategories as $parentCategory)
                            <li>
                                <a href="{{ route('nav', ['bar' => $parentCategory->link]) }}">{{ $parentCategory->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="{{ route('frontend.doctor.list') }}">{{ __('Doctors List') }}</a>
                </li>
                <li>
                    <a href="{{ route('frontend.contact.index') }}">{{ __('Contact') }}</a>
                </li>
                @if (!Auth::check())
                    <li>
                        <a href="{{ route('login') }}" class="btn btn-primary">{{ __('Log In') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" class="btn btn-success">{{ __('Sign up') }}</a>
                    </li>
                @else
                    <li>
                        <a href="javascript:void(0)" class="account">
                            @if (Auth::user()->avatar)
                                <img src="{!! asset(Auth::user()->avatar) !!}" class="user-image">
                            @else
                                <img src="{!! asset('bower_components/AdminLTE/dist/img/avatar.png') !!}" class="user-image">
                            @endif
                            <span class="hidden-xs">{!! Auth::user()->display_name !!}</span>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route('frontend.mark-medicine.index') }}" title="{{ trans('label.medical_box') }}">{{ trans('label.medical_box') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('frontend.request-medicine.index') }}" title="{{ __('Request Medicine') }}">{{ __('Request Medicine') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('request-prescription.index') }}" title="{{ __('Request Presctiption') }}">{{ __('Make Request Presctiption') }}</a>
                            </li>
                            @if (Auth::user()->permission == App\Eloquent\User::PERMISSION_DOCTER)
                                <li>
                                    <a href="{{ route('doctor-request-prescription.index') }}" title="{{ __('Doctor - Request Presctiption') }}">
                                        {{ __('Doctor - Request Presctiption') }}
                                        <span class="label label-danger count-new-request-doctor">
                                            {{ App\Helpers\Helper::countNewRequestPrescriptionDoctor() }}
                                        </span>
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="{{ route('frontend.prescription.index') }}" title="{{ trans('label.prescription') }}" class="top-link-checkout">{{ trans('label.prescription') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('frontend.user.profiles') }}" title="{{ __('My profiles') }}">{{ __('My profiles') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('frontend.order.list') }}" title="{{ __('Orders List') }}">{{ __('Orders List') }}</a>
                            </li>
                            @if(Auth::user()->permission == App\Eloquent\User::PERMISSION_ADMIN)
                                <li>
                                    <a href="{!! url('admin') !!}" title="{{ trans('label.adminpage') }}">{{ trans('label.adminpage') }}</a>
                                </li>
                            @endif
                            <li>
                                <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); clickLogoutForm('#logout-form', '{{ __('Do you want to logout?') }}')">{{ __('Logout') }}</a>
                                {!! Form::open(['route' => 'logout', 'method' => 'post', 'style' => 'display:none', 'id' => 'logout-form']) !!}
                                {!! Form::close() !!}
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
            <!-- END Main Menu -->
        </nav>
        <!-- END Site Navigation -->
    </div>
</header>
