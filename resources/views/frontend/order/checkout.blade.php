@extends('frontend.layouts.master')

@section('title', __('Checkout'))

@section('content')
<section class="site-section site-section-light site-section-top themed-background-dark">
    <div class="container text-center">
        <h1 class="animation-slideDown">
            <i class="fa fa-shopping-cart"></i>
            <strong>{{ __('Checkout') }}</strong>
        </h1>
    </div>
</section>
<section class="site-content site-section" id="frontend-area-checkout">
    <div class="container">

        @include('frontend.components.show-message')

        <div class="site-block position-relative">

            {!! Form::open(['route' => 'frontend.checkout.store', 'id' => 'checkout-store', 'class' => 'ui-formwizard', 'method' => 'post']) !!}
                {!! Form::hidden('prescription_id', $prescription->id) !!}
                <!-- First Step -->
                <div id="checkout-step-first" class="step ui-formwizard-content">
                    <!-- Step Info -->
                    <ul class="nav nav-pills nav-justified checkout-steps push-bit">
                        <li class="active" data-bind="click: activeStepFirst">
                            <a href="javascript:void(0)" data-gotostep="checkout-first">
                                <strong>1. {{ __('User Information') }}</strong>
                            </a>
                        </li>
                        <li data-bind="click: activeStepSecond">
                            <a href="javascript:void(0)" data-gotostep="checkout-second">
                                <strong>2. {{ __('Address') }}</strong>
                            </a>
                        </li>
                        <li data-bind="click: activeStepThird">
                            <a href="javascript:void(0)" data-gotostep="checkout-fourth">
                                <strong>3. {{ __('Confirm order') }}</strong>
                            </a>
                        </li>
                    </ul>
                    <!-- END Step Info -->
                    <div class="row">
                        <h4 class="page-header">{{ __('User Information') }}</h4>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::label('user_email', __('E-Mail Address')) !!}
                                {!! Form::text('user_email', Auth::user()->email, ['class' => 'form-control ui-wizard-content', 'placeholder' => __('E-Mail Address')]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('user_address', __('Address')) !!}
                                {!! Form::text('user_address', Auth::user()->address, ['class' => 'form-control ui-wizard-content', 'placeholder' => __('Address')]) !!}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::label('user_display_name', __('Display name')) !!}
                                {!! Form::text('user_display_name', Auth::user()->display_name, ['class' => 'form-control ui-wizard-content', 'placeholder' => __('Display name')]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('user_phone', __('Phone number')) !!}
                                {!! Form::text('user_phone', Auth::user()->phone, ['class' => 'form-control ui-wizard-content', 'placeholder' => __('Phone number')]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END First Step -->

                <!-- Second Step -->
                <div id="checkout-step-second" class="step ui-formwizard-content hide">
                    <!-- Step Info -->
                    <ul class="nav nav-pills nav-justified checkout-steps push-bit">
                        <li data-bind="click: activeStepFirst">
                            <a href="javascript:void(0)" data-gotostep="checkout-first">
                                <i class="fa fa-check"></i>
                                <strong>1. {{ __('User Information') }}</strong>
                            </a>
                        </li>
                        <li class="active" data-bind="click: activeStepSecond">
                            <a href="javascript:void(0)" data-gotostep="checkout-second">
                                <strong>2. {{ __('Address') }}</strong>
                            </a>
                        </li>
                        <li  data-bind="click: activeStepThird">
                            <a href="javascript:void(0)" data-gotostep="checkout-fourth">
                                <strong>3. {{ __('Confirm order') }}</strong>
                            </a>
                        </li>
                    </ul>
                    <!-- END Step Info -->
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="page-header">{{ __('Billing Address') }}</h4>
                            <div class="form-group">
                                {!! Form::label('billing_email', __('E-Mail Address')) !!}
                                {!! Form::text('billing_email', Auth::user()->email, ['class' => 'form-control ui-wizard-content', 'placeholder' => __('E-Mail Address')]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('billing_display_name', __('Display name')) !!}
                                {!! Form::text('billing_display_name', Auth::user()->display_name, ['class' => 'form-control ui-wizard-content', 'placeholder' => __('Display name')]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('billing_address', __('Address')) !!}
                                {!! Form::text('billing_address', Auth::user()->address, ['class' => 'form-control ui-wizard-content', 'placeholder' => __('Address')]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('billing_phone', __('Phone number')) !!}
                                {!! Form::text('billing_phone', Auth::user()->phone, ['class' => 'form-control ui-wizard-content', 'placeholder' => __('Phone number')]) !!}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <h4 class="page-header">{{ __('Shipping Address') }}</h4>
                            <div class="form-group">
                                {!! Form::label('shipping_email', __('E-Mail Address')) !!}
                                {!! Form::text('shipping_email', Auth::user()->email, ['class' => 'form-control ui-wizard-content', 'placeholder' => __('E-Mail Address')]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('shipping_display_name', __('Display name')) !!}
                                {!! Form::text('shipping_display_name', Auth::user()->display_name, ['class' => 'form-control ui-wizard-content', 'placeholder' => __('Display name')]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('shipping_address', __('Address')) !!}
                                {!! Form::text('shipping_address', Auth::user()->address, ['class' => 'form-control ui-wizard-content', 'placeholder' => __('Address')]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('shipping_phone', __('Phone number')) !!}
                                {!! Form::text('shipping_phone', Auth::user()->phone, ['class' => 'form-control ui-wizard-content', 'placeholder' => __('Phone number')]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Second Step -->
               
                <!-- Fourth Step -->
                <div id="checkout-step-third" class="step ui-formwizard-content hide">
                    <!-- Step Info -->
                    <ul class="nav nav-pills nav-justified checkout-steps push-bit">
                        <li data-bind="click: activeStepFirst">
                            <a href="javascript:void(0)" data-gotostep="checkout-first">
                                <i class="fa fa-check"></i>
                                <strong>1. {{ __('User Information') }}</strong>
                            </a>
                        </li>
                        <li  data-bind="click: activeStepSecond">
                            <a href="javascript:void(0)" data-gotostep="checkout-second">
                                <i class="fa fa-check"></i>
                                <strong>2. {{ __('Address') }}</strong>
                            </a>
                        </li>
                        <li class="active" data-bind="click: activeStepThird">
                            <a href="javascript:void(0)" data-gotostep="checkout-fourth">
                                <strong>3. {{ __('Confirm order') }}</strong>
                            </a>
                        </li>
                    </ul>
                    <!-- END Step Info -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-vcenter">
                            <thead>
                                <tr>
                                    <th colspan="2">{{ __('Medicine') }}</th>
                                    <th class="text-center">{{ __('Qty ordered') }}</th>
                                    <th class="text-right">{{ __('Price') }}</th>
                                    <th class="text-right">{{ __('Row Total') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $grandTotal = 0;
                                @endphp

                                @foreach ($items as $item)
                                    <tr>
                                        <td class="text-center">
                                            @php
                                                $grandTotal += $item['cart']['row_total'];

                                                $imageShow = config('custom.medicine.image_default');
                                                if ($item['item']->getMedicine) {
                                                    $imageCollection = $item['item']->getMedicine->getAllImages();
                                                    $image = $imageCollection->orderBy('is_main', 'desc')->first();
                                                    if ($image) {
                                                        $imageShow = $image->path_origin;
                                                    }
                                                }
                                            @endphp
                                            <img src="{{ asset($imageShow) }}" class="height-100px">
                                        </td>
                                        <td>
                                            <strong>{{ $item['item']->name_medicine }}</strong><br/>
                                            @if ($item['item']->getMedicine->quantity > 0)
                                                <strong class="text-success">{{ __('In Store') }}</strong>
                                            @else
                                                <strong class="text-danger">{{ __('Out Store') }}</strong>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{ $item['cart']['qty_ordered'] }}
                                        </td>
                                        <td class="text-right">
                                            {{ App\Helpers\Helper::formatPrice($item['cart']['price']) }}
                                        </td>
                                        <td class="text-right">
                                            <strong>{{ App\Helpers\Helper::formatPrice($item['cart']['row_total']) }}</strong>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr class="active">
                                    <td colspan="4" class="text-right text-uppercase h4">
                                        <strong>{{ __('Grand Total') }}</strong>
                                    </td>
                                    <td class="text-right text-success h4">
                                        <strong>{{ App\Helpers\Helper::formatPrice($grandTotal) }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 push-bit">
                            <h4 class="page-header"><strong>{{ __('Billing Address') }}</strong></h4>
                            <h4><strong data-bind="text: dataBilling().display_name"></strong></h4>
                            <address>
                                <span data-bind="text: dataBilling().address"></span><br>
                                <i class="fa fa-phone"></i>
                                <span data-bind="text: dataBilling().phone"></span><br>
                                <i class="fa fa-envelope-o"></i>
                                <a href="javascript:void(0)" data-bind="text: dataBilling().email"></a>
                            </address>
                        </div>
                        <div class="col-sm-6 push-bit">
                            <h4 class="page-header"><strong>{{ __('Shipping Address') }}</strong></h4>
                            <h4><strong data-bind="text: dataShipping().display_name"></strong></h4>
                            <address>
                                <span data-bind="text: dataShipping().address"></span><br>
                                <i class="fa fa-phone"></i>
                                <span data-bind="text: dataShipping().phone"></span><br>
                                <i class="fa fa-envelope-o"></i>
                                <a href="javascript:void(0)" data-bind="text: dataShipping().email"></a>
                            </address>
                        </div>
                    </div>
                </div>
                <!-- END Fourth Step -->

                <!-- Form Buttons -->
                <div class="form-group text-right">
                    <input type="reset" class="btn btn-danger ui-wizard-content ui-formwizard-button" value="{{ __('Previous Step') }}" data-bind="click: preCheckoutStep">
                    <input type="submit" class="btn btn-primary ui-wizard-content ui-formwizard-button" id="checkout-button-next" value="{{ __('Next Step') }}" data-text-first="{{ __('Next Step') }}" data-text-last="{{ __('Confirm Order') }}" data-bind="click: nextCheckoutStep">
                </div>
                <!-- END Form Buttons -->
            {!! Form::close() !!}
            <!-- END Checkout Wizard Content -->

            <div class="indicator hide" id="frontend-checkout-indicator">
                <div class="spinner"></div>
            </div>

        </div>
    </div>
</section>
@endsection

@section('custom-javascript')
    <script src="{!! url('js/frontend/checkout.js') !!}"></script>
    <script type="text/javascript">
        var currentUser = {!! json_encode(Auth::user()) !!};
        ko.applyBindings(
            new CheckoutViewModel(currentUser),
            document.getElementById('frontend-area-checkout')
        );
    </script>
@endsection
