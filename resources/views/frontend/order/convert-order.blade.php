@extends('frontend.layouts.master')

@section('title', __('Convert Prescription to Order.'))

@section('content')
<section class="site-section site-section-light site-section-top themed-background-dark">
    <div class="container text-center">
        <h1 class="animation-slideDown">
            <i class="fa fa-shopping-cart"></i>
            <strong>{{ __('Convert Prescription to Order.') }}</strong>
        </h1>
    </div>
</section>
<section class="site-content site-section padding-bottom-35px">
    <div class="container">

        @include('frontend.components.show-message')

        <div class="table-responsive">
            <table class="table table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th colspan="2">{{ __('Medicine') }}</th>
                        <th class="text-center">{{ __('Qty') }}</th>
                        <th class="text-right">{{ __('Price') }}</th>
                        <th class="text-right">{{ __('Row Total') }}</th>
                    </tr>
                </thead>
                @php
                    $allowBuy = false;
                    if (Auth::user()->permission == App\Eloquent\User::PERMISSION_DOCTER || $prescription->doctor_id) {
                        $allowBuy = true;
                    }
                @endphp

                <tbody>
                    @php
                        $grandTotal = 0;
                        App\Helpers\Helper::emptyCarts();
                    @endphp

                    @foreach ($prescription->getAllItemPrescriptions as $items)
                        <tr class="{{ $items->getMedicine ? '' : 'not-medicine' }}">
                            <td class="text-center">
                                @php
                                    $imageShow = config('custom.medicine.image_default');
                                    if ($items->getMedicine) {
                                        $imageCollection = $items->getMedicine->getAllImages();
                                        $image = $imageCollection->orderBy('is_main', 'desc')->first();
                                        if ($image) {
                                            $imageShow = $image->path_origin;
                                        }
                                    }
                                @endphp
                                <img src="{{ asset($imageShow) }}" class="height-100px">
                            </td>
                            @if ($items->getMedicine)
                                @php
                                    $allowBuyMedicine = $allowBuy || $items->getMedicine->allowed_buy == App\Eloquent\Medicine::ALLOWED_BUY;
                                @endphp
                                 <td>
                                    <a target="_blank" href="{{ route('detail', [$items->getMedicine->id, str_slug($items->getMedicine->name)]) }}">
                                        <strong>{{ $items->name_medicine }}</strong>
                                    </a><br/>
                                    @if ($items->getMedicine->quantity > 0)
                                        <strong class="text-success">{{ __('In Store') }}</strong>
                                    @else
                                        <strong class="text-danger">{{ __('Out Store') }}</strong>
                                    @endif
                                </td>
                                <td class="text-left">
                                    <div class="padding-5px">
                                        <span>{{ __('Amount') }}</span>
                                        <span class="pull-right-container">
                                            <small class="pull-right">
                                                {{ $items->amount }} {{ $items->getMedicine->unit }} / {{ __('day') }}
                                            </small>
                                        </span>
                                    </div>
                                    <div class="padding-5px">
                                        <span>{{ __('Uses in') }}</span>
                                        <span class="pull-right-container">
                                            <small class="pull-right">{{ $items->qty_purchased }} {{ __('day') }}</small>
                                        </span>
                                    </div>
                                    @php
                                        $qtyOrdered = ceil($items->amount * $items->qty_purchased);
                                    @endphp
                                    <div class="padding-5px">
                                        <span>{{ __('Qty ordered') }}</span>
                                        <span class="pull-right-container">
                                            <strong class="pull-right text-danger">
                                                {{ App\Helpers\Helper::numberIntegerFormat($qtyOrdered) }}
                                                {{ $items->getMedicine->unit }}
                                            </strong>
                                        </span>
                                    </div>
                                </td>
                                @if ($allowBuyMedicine)
                                    <td class="text-right">
                                        {{ App\Helpers\Helper::formatPrice($items->getMedicine->price) }}
                                    </td>
                                    @php
                                        $rowTotal = $qtyOrdered * $items->getMedicine->price;
                                        $grandTotal += $rowTotal;
                                        App\Helpers\Helper::addItemToCart($items->id, $qtyOrdered, $items->getMedicine->price, $rowTotal, $items->getMedicine->id, $items->getMedicine->name);
                                    @endphp
                                    <td class="text-right">
                                        <strong>{{ App\Helpers\Helper::formatPrice($rowTotal) }}</strong>
                                    </td>
                                @else
                                    <td class="text-center">
                                        <strong class="text-danger">{{ __('Not allowed to buy') }}</strong>
                                    </td>
                                    <td class="text-right">
                                        <strong>{{ App\Helpers\Helper::formatPrice(0) }}</strong>
                                    </td>
                                @endif
                            @else
                                <td colspan="3" class="text-center">
                                    <strong class="text-success">{{ $items->name_medicine }}</strong><br/>
                                    <strong class="text-danger">{{ __('Not in the store') }}</strong>
                                </td>
                                <td class="text-right">
                                    <strong>{{ App\Helpers\Helper::formatPrice(0) }}</strong>
                                </td>
                            @endif

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
            <div class="col-xs-5 col-md-3 col-md-offset-6 pull-right">
                <a href="{{ route('frontend.checkout') }}" class="btn btn-block btn-danger">
                    {{ __('Checkout') }}
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
