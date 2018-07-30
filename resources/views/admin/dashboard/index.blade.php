@extends('admin.layouts.admin-layout') 

@section('pageAdminTitle', __('Admin Dashboard')) 

@section('content')
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua">
                    <i class="fa fa-medkit"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text padding-top-10px">
                        <strong>{{ App\Helpers\Helper::numberIntegerFormat($data['medicines']['total']) }}</strong>
                        {{ __('Medicines') }}
                    </span>
                    <span class="info-box-text padding-top-10px">
                        <strong>{{ App\Helpers\Helper::numberIntegerFormat($data['medicines']['reviews']) }}</strong>
                        {{ __('Reviews') }}
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text padding-top-10px">
                        <strong>{{ App\Helpers\Helper::numberIntegerFormat($data['comments']['questions']) }}</strong>
                        {{ __('Questions') }}
                    </span>
                    <span class="info-box-text padding-top-10px">
                        <strong>{{ App\Helpers\Helper::numberIntegerFormat($data['comments']['answers']) }}</strong>
                        {{ __('Answers') }}
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-shopping-cart"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text padding-top-10px">
                        <strong>{{ App\Helpers\Helper::formatPrice($data['orders']['sales']) }}</strong>
                        {{ __('Sales') }}
                    </span>
                    <span class="info-box-text padding-top-10px">
                        <strong>{{ App\Helpers\Helper::numberIntegerFormat($data['orders']['total']) }}</strong>
                        {{ __('Orders') }}
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text padding-top-5px">
                        <strong>{{ App\Helpers\Helper::numberIntegerFormat($data['users']['admins']) }}</strong>
                        {{ __('Admins') }}
                    </span>
                    <span class="info-box-text padding-top-5px">
                        <strong>{{ App\Helpers\Helper::numberIntegerFormat($data['users']['doctors']) }}</strong>
                        {{ __('Doctors') }}
                    </span>
                    <span class="info-box-text padding-top-5px">
                        <strong>{{ App\Helpers\Helper::numberIntegerFormat($data['users']['users']) }}</strong>
                        {{ __('Users') }}
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row position-relative" id="admin-chart-statistics">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border text-center">
                    <h3 class="box-title">{{ __('Monthly Recap Report') }}</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="btn-group text-center" role="group">
                        <button type="button" class="btn btn-default" data-value="3" data-bind="click: selectDistanceMonths">
                            {{ __(':number Months', ['number' => 3]) }}
                        </button>
                        <button type="button" class="btn btn-default active" data-value="6" data-bind="click: selectDistanceMonths">
                            {{ __(':number Months', ['number' => 6]) }}
                        </button>
                        <button type="button" class="btn btn-default" data-value="9" data-bind="click: selectDistanceMonths">
                            {{ __(':number Months', ['number' => 9]) }}
                        </button>
                        <button type="button" class="btn btn-default" data-value="12" data-bind="click: selectDistanceMonths">
                            {{ __(':number Months', ['number' => 12]) }}
                        </button>
                        <button type="button" class="btn btn-default" data-value="18" data-bind="click: selectDistanceMonths">
                            {{ __(':number Months', ['number' => 18]) }}
                        </button>
                        <button type="button" class="btn btn-default" data-value="24" data-bind="click: selectDistanceMonths">
                            {{ __(':number Months', ['number' => 24]) }}
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-8">
                            <p class="text-center">
                                <strong data-bind="text: data().startTime + ' - ' + data().endTime"></strong>
                            </p>
                            <div class="chart">
                                <!-- LINE CHART -->
                                <canvas id="admin-sales-line-chart"></canvas>
                            </div>
                            <!-- /.chart-responsive -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-4">
                            <p class="text-center">
                                <strong>{{ __('Statistics orders') }}</strong>
                            </p>
                            <div class="progress-group">
                                <span class="progress-text">
                                    {{ $data['orders']['options'][App\Eloquent\Order::STATUS_PENDING] }}
                                </span>
                                <span class="progress-number">
                                    <b data-bind="text: data().orders.pending"></b>
                                    <span data-bind="text: ' / ' + data().orders.total"></span>
                                </span>
                                <div class="progress sm">
                                    <div class="progress-bar progress-bar-aqua" data-bind="attr:{style: 'width:' + parseInt(100 * data().orders.pending / data().orders.total) + '%'}"></div>
                                </div>
                            </div>
                            <!-- /.progress-group -->
                            <div class="progress-group">
                                <span class="progress-text">
                                    {{ $data['orders']['options'][App\Eloquent\Order::STATUS_COMPLETE] }}
                                </span>
                                <span class="progress-number">
                                    <b data-bind="text: data().orders.complete"></b>
                                    <span data-bind="text: ' / ' + data().orders.total"></span>
                                </span>
                                <div class="progress sm">
                                    <div class="progress-bar progress-bar-green" data-bind="attr:{style: 'width:' + parseInt(100 * data().orders.complete / data().orders.total) + '%'}"></div>
                                </div>
                            </div>
                            <!-- /.progress-group -->
                            <div class="progress-group">
                                <span class="progress-text">
                                    {{ $data['orders']['options'][App\Eloquent\Order::STATUS_CANCEL] }}
                                </span>
                                <span class="progress-number">
                                    <b data-bind="text: data().orders.cancel"></b>
                                    <span data-bind="text: ' / ' + data().orders.total"></span>
                                </span>
                                <div class="progress sm">
                                    <div class="progress-bar progress-bar-yellow" data-bind="attr:{style: 'width:' + parseInt(100 * data().orders.cancel / data().orders.total) + '%'}"></div>
                                </div>
                            </div>
                            <!-- /.progress-group -->
                            <div class="progress-group">
                                <span class="progress-text">
                                    {{ $data['orders']['options'][App\Eloquent\Order::STATUS_REFUND] }}
                                </span>
                                <span class="progress-number">
                                    <b data-bind="text: data().orders.refund"></b>
                                    <span data-bind="text: ' / ' + data().orders.total"></span>
                                </span>
                                <div class="progress sm">
                                    <div class="progress-bar progress-bar-red" data-bind="attr:{style: 'width:' + parseInt(100 * data().orders.refund / data().orders.total) + '%'}"></div>
                                </div>
                            </div>
                            <!-- /.progress-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- ./box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="indicator hide" id="indicator-statistic-chart">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- /.row -->

    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
            <!-- /.row -->
            <!-- TABLE: LATEST ORDERS -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ __('Latest Orders') }}</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>{{ __('ID #') }}</th>
                                    <th class="text-center">{{ __('User') }}</th>
                                    <th class="text-center">{{ __('Total Items') }}</th>
                                    <th class="text-center">{{ __('Status') }}</th>
                                    <th class="text-right">{{ __('Grand Total') }}</th>
                                    <th class="text-center">{{ __('Order Date') }}</th>
                                    <th class="text-center">{{ __('Updated At') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['orders']['list'] as $order)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.orders.detail', [$order->id]) }}">
                                                #{{ $order->id }}
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            @if ($order->user_id)
                                                <a href="{{ route('users.show', [$order->user_id]) }}">
                                                    {{ $order->user_display_name }}
                                                </a>
                                            @else
                                                {{ $order->user_display_name }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{ App\Helpers\Helper::numberIntegerFormat($order->total_items) }}
                                        </td>
                                        <td class="text-center">
                                            @php
                                                $status = $order->status;
                                            @endphp

                                            @if ($status == App\Eloquent\Order::STATUS_PENDING)
                                                <span class="label label-info">
                                                    {{ $data['orders']['options'][$order->status] }}
                                                </span>
                                            @endif

                                            @if ($status == App\Eloquent\Order::STATUS_COMPLETE)
                                                <span class="label label-success">
                                                    {{ $data['orders']['options'][$order->status] }}
                                                </span>
                                            @endif

                                            @if ($status == App\Eloquent\Order::STATUS_CANCEL)
                                                <span class="label label-danger">
                                                    {{ $data['orders']['options'][$order->status] }}
                                                </span>
                                            @endif

                                            @if ($status == App\Eloquent\Order::STATUS_REFUND)
                                                <span class="label label-default">
                                                    {{ $data['orders']['options'][$order->status] }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            {{ App\Helpers\Helper::formatPrice($order->grand_total) }}
                                        </td>
                                        <td class="text-right">
                                            {{ $order->created_at }}
                                        </td>
                                        <td class="text-right">
                                            {{ $order->updated_at }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    
</section>
@endsection

@section('javascript')
    <script src="{!! url('bower_components/AdminLTE/plugins/chartjs/Chart.min.js') !!}"></script>
    <script src="{!! url('js/admin/admin-index-chart.js') !!}"></script>
@endsection
