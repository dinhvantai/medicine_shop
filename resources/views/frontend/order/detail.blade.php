@extends('frontend.layouts.master')

@section('title', __('Order detail'))

@section('content')
<section class="site-section site-section-light site-section-top themed-background-dark">
    <div class="container text-center">
        <h1 class="animation-slideDown">
            <i class="fa fa-shopping-cart"></i>
            <strong>{{ __('Order detail') }}</strong>
        </h1>
    </div>
</section>
<div class="content position-relative padding-15px" id="area-prescription-list">

    @include('frontend.components.show-message')

    <div class= "row">
        <div class="col-xs-12">
            <div class="box block">
                <div class="box-header">
                    <div class="col-md-8">
                        <h3 class="box-title">
                            {{ __('Order') }} 
                            <a href="javascript:void(0)">#{{ $data['order']->id }}</a> |
                            {{ __('Last change') }}
                            <span class="text-success">
                                {{ $data['order']->updated_at }}
                            </span>
                        </h3>
                    </div>
                    <div class="col-md-4 text-right">
                        @php
                            $status = $data['order']->status;
                        @endphp

                        @if ($status == App\Eloquent\Order::STATUS_PENDING)
                            <a class="btn btn-warning" onclick="confirmBeforeSubmit('#order-change-cancel', this)" data-text="{{ __('Do you want to cancel this order?') }}">{{ __('Cancel') }}</a>
                        @endif

                        <a class="btn btn-success" onclick="resendEmailOrder('{{ $data['order']->id }}', this)" data-text="{{ __('Do you want to resend email this order?') }}">{{ __('Send Email') }}</a>

                        <a href="{!! route('frontend.order.list') !!}" data-toggle="tooltip" class="btn btn-default" data-original-title="{{ __('Back') }}">
                            <i class="fa fa-reply"></i>
                        </a>
                    </div>

                    {!! Form::open(['route' => ['frontend.order.change', $data['order']->id], 'id' => 'order-change-cancel', 'class' => 'form-horizontal', 'method' => 'put']) !!}
                        {!! Form::hidden('status', App\Eloquent\Order::STATUS_CANCEL) !!}
                    {!! Form::close() !!}
                </div><!-- /.box-header -->
               
                <div class="row">
                    <div class="col-sm-6">
                        <div class="block">
                            <div class="block-title">
                                <h2>
                                    <i class="fa fa-shopping-cart"></i>
                                    <strong>
                                        {{ __('Order') }} 
                                        <a href="javascript:void(0)">#{{ $data['order']->id }}</a>
                                    </strong>
                                </h2>
                            </div>
                            <table class="table table-bordered table-vcenter">
                                <tbody>
                                    <tr>
                                        <td>{{ __('Order Date') }}</td>
                                        <td>{{ $data['order']->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Status') }}</td>
                                        <td>
                                            @php
                                                $status = $data['order']->status;
                                            @endphp

                                            @if ($status == App\Eloquent\Order::STATUS_PENDING)
                                                <span class="label label-info">
                                                    {{ $data['optionStatus'][$data['order']->status] }}
                                                </span>
                                            @endif

                                            @if ($status == App\Eloquent\Order::STATUS_COMPLETE)
                                                <span class="label label-success">
                                                    {{ $data['optionStatus'][$data['order']->status] }}
                                                </span>
                                            @endif

                                            @if ($status == App\Eloquent\Order::STATUS_CANCEL)
                                                <span class="label label-danger">
                                                    {{ $data['optionStatus'][$data['order']->status] }}
                                                </span>
                                            @endif

                                            @if ($status == App\Eloquent\Order::STATUS_REFUND)
                                                <span class="label label-default">
                                                    {{ $data['optionStatus'][$data['order']->status] }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="block">
                            <div class="block-title">
                                <h2>
                                    <i class="fa fa-building-o"></i>
                                    <strong>{{ __('User Information') }}</strong>
                                </h2>
                            </div>
                            <table class="table table-bordered table-vcenter">
                                <tbody>
                                    <tr>
                                        <td>{{ __('Customer Name') }}</td>
                                        <td>{{ $data['order']->user_display_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('E-Mail Address') }}</td>
                                        <td>{{ $data['order']->user_email }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Addresses -->
                <div class="row">
                    @if ($data['address']['billing'])
                        <div class="col-sm-6">
                            <!-- Billing Address Block -->
                            <div class="block">
                                <!-- Billing Address Title -->
                                <div class="block-title">
                                    <h2>
                                        <i class="fa fa-building-o"></i>
                                        <strong>{{ __('Billing') }}</strong>
                                        {{ __('Address') }}
                                    </h2>
                                </div>
                                <!-- END Billing Address Title -->

                                <!-- Billing Address Content -->
                                <h4><strong>{{ $data['address']['billing']->user_display_name }}</strong></h4>
                                <address>
                                    {{ $data['address']['billing']->user_address }}<br>
                                    <i class="fa fa-phone"></i>
                                    {{ $data['address']['billing']->user_phone }}<br>
                                    <i class="fa fa-envelope-o"></i>
                                    <a href="javascript:void(0)">
                                        {{ $data['address']['billing']->user_email }}
                                    </a>
                                </address>
                                <!-- END Billing Address Content -->
                            </div>
                            <!-- END Billing Address Block -->
                        </div>
                    @endif

                    @if ($data['address']['shipping'])
                        <div class="col-sm-6">
                            <!-- Shipping Address Block -->
                            <div class="block">
                                <!-- Shipping Address Title -->
                                <div class="block-title">
                                    <h2>
                                        <i class="fa fa-building-o"></i>
                                        <strong>{{ __('Shipping') }}</strong>
                                        {{ __('Address') }}
                                    </h2>
                                </div>
                                <!-- END Shipping Address Title -->

                                <!-- Shipping Address Content -->
                                <h4><strong>{{ $data['address']['shipping']->user_display_name }}</strong></h4>
                                <address>
                                    {{ $data['address']['shipping']->user_address }}<br>
                                    <i class="fa fa-phone"></i>
                                    {{ $data['address']['shipping']->user_phone }}<br>
                                    <i class="fa fa-envelope-o"></i>
                                    <a href="javascript:void(0)">
                                        {{ $data['address']['shipping']->user_email }}
                                    </a>
                                </address>
                                <!-- END Shipping Address Content -->
                            </div>
                            <!-- END Shipping Address Block -->
                        </div>
                    @endif
                </div>
                <!-- END Addresses -->

                <div class="table-responsive block">
                    <table class="table table-bordered table-vcenter">
                        <thead>
                            <tr>
                                <th class="text-center">{{ __('Medicine') }}</th>
                                <th class="text-center">{{ __('Qty ordered') }}</th>
                                <th class="text-right">{{ __('Price') }}</th>
                                <th class="text-right">{{ __('Row Total') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['order']->getOrderItems as $item)
                                <tr>
                                    <td class="text-center">
                                        <strong>
                                            <a href="{{ route('detail', [$item->medicine_id, str_slug($item->medicine_name)]) }}" target="_blank">
                                                {{ $item->medicine_name }}
                                            </a>
                                        </strong>
                                    </td>
                                    <td class="text-center">
                                        {{ App\Helpers\Helper::numberIntegerFormat($item->qty_ordered) }}
                                    </td>
                                    <td class="text-right">
                                        {{ App\Helpers\Helper::formatPrice($item->price) }}
                                    </td>
                                    <td class="text-right">
                                        <strong>
                                            {{ App\Helpers\Helper::formatPrice($item->row_total) }}
                                        </strong>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="active">
                                <td colspan="3" class="text-right text-uppercase">
                                    <strong>{{ __('Grand Total') }}</strong>
                                </td>
                                <td class="text-right text-success">
                                    <strong>
                                        {{ App\Helpers\Helper::formatPrice($data['order']->grand_total) }}
                                    </strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div><!-- /.box -->
        </div><!-- /.col -->
    </div>
</div>
@endsection
