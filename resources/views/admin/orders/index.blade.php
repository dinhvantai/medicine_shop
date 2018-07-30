@extends('admin.layouts.admin-layout')

@section('pageAdminTitle', __('List Orders'))

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ __('Orders') }}
        <small>{{ __('List') }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!! url('admin') !!}"><i class="fa fa-dashboard"></i>{{ __('Home') }}</a></li>
        <li class="active">{{ __('List Orders') }}</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="col-md-11">
                        <h3 class="box-title">{{ __('List Orders') }}</h3>
                    </div>
                    <div class="col-md-1">
                        <a href="" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="{{ __('Rebuild') }}"><i class="fa fa-refresh"></i></a>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="user_list_table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>{{ __('ID #') }}</th>
                            <th class="text-center">{{ __('Customer Name') }}</th>
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
                                    <span>{{ $order->user_display_name }}</span>
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
                                        <a href="{{ route('admin.orders.detail', [$order->id]) }}" data-toggle="tooltip" class="btn btn-primary" data-original-title="{{ __('View Detail') }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $data['orders']->links() }}
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
@endsection
