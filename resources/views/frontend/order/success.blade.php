@extends('frontend.layouts.master')

@section('title', __('Created order successfully!'))

@section('content')
<section class="site-section site-section-light site-section-top themed-background-dark">
    <div class="container text-center">
        <h1 class="animation-slideDown">
            <i class="fa fa-shopping-cart"></i>
            <strong>{{ __('Your order has been received.') }}</strong>
        </h1>
    </div>
</section>
<section class="site-content site-section" id="frontend-area-checkout">
    <div class="container">

        @include('frontend.components.show-message')

        <div class="site-block position-relative">
            <div class="alert alert-success alert-dismissible text-center">
                <h4>{{ __('Your order has been received.') }}</h4>
                <p>{{ __('Thank you for your purchase!') }}</p>
                <p>
                    <small>{{ __('Your order # is:') }}</small>
                    <a href="{{route('frontend.order.detail', [$order->id])}}">#{{ $order->id }}</a>
                </p>
                <p><small>{{ __('You will receive an order confirmation email with details of your order and a link to track its progress.') }}</small></p>
            </div>
        </div>
    </div>
</section>
@endsection
