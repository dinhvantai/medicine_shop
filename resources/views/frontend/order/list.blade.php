@extends('frontend.layouts.master')

@section('title', __('Orders List'))

@section('content')
<section class="site-section site-section-light site-section-top themed-background-dark">
    <div class="container text-center">
        <h1 class="animation-slideDown">
            <i class="fa fa-shopping-cart"></i>
            <strong>{{ __('Orders List') }}</strong>
        </h1>
    </div>
</section>
<div class="content position-relative" id="area-prescription-list">

    @include('frontend.components.show-message')

    <div class= "row">
        <div class="panel panel-success">
            <div class="panel-body">
                <div class="text-right">
                    {{ $data['orders']->links() }}
                </div>
                <table id="user_list_table" class="table table-bordered table-hover">
                    <thead>
                        <tr class="warning">
                            <th>{{ __('ID #') }}</th>
                            <th class="text-center">{{ __('Total Items') }}</th>
                            <th class="text-right">{{ __('Grand Total') }}</th>
                            <th class="text-center">{{ __('Status') }}</th>
                            <th class="text-center">{{ __('Order Date') }}</th>
                            <th class="text-center">{{ __('Updated At') }}</th>
                            <th class="text-center">{{ __('Action') }} </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($data['orders'] as $order)
                        <tr>
                            <td>
                                <span>#{{ $order->id }}</span>
                            </td>
                            <td class="text-center">
                                {{ App\Helpers\Helper::numberIntegerFormat($order->total_items) }}
                            </td>
                            <td class="text-right">
                                {{ App\Helpers\Helper::formatPrice($order->grand_total) }}
                            </td>
                            <td class="text-center">
                                @if ($order->status == App\Eloquent\Order::STATUS_PENDING)
                                    <span class="label label-info">
                                        {{ $data['optionStatus'][$order->status] }}
                                    </span>
                                @endif

                                @if ($order->status == App\Eloquent\Order::STATUS_COMPLETE)
                                    <span class="label label-success">
                                        {{ $data['optionStatus'][$order->status] }}
                                    </span>
                                @endif

                                @if ($order->status == App\Eloquent\Order::STATUS_CANCEL)
                                    <span class="label label-danger">
                                        {{ $data['optionStatus'][$order->status] }}
                                    </span>
                                @endif

                                @if ($order->status == App\Eloquent\Order::STATUS_REFUND)
                                    <span class="label label-default">
                                        {{ $data['optionStatus'][$order->status] }}
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <span>{{ $order->created_at }}</span>
                            </td>
                            <td class="text-center">
                                <span>{{ $order->updated_at }}</span>
                            </td>
                            <td class="text-center">
                                <span class="text-right">
                                    <a href="{{ route('frontend.order.detail', [$order->id]) }}" data-toggle="tooltip" class="btn btn-primary" data-original-title="{{ __('View Detail') }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $data['orders']->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
