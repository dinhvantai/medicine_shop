@extends('admin.layouts.admin-layout')

@section('pageAdminTitle', __('Detail user :name', ['name' => $user->display_name]))

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header margin-bottom-15px">
    <ol class="breadcrumb">
        <li><a href="{!! url('admin') !!}"><i class="fa fa-dashboard"></i>{{ __('Home') }}</a></li>
        <li class="active">{{ __('Detail user :name', ['name' => $user->display_name]) }}</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-4">
            <!-- Customer Info Block -->
            <div class="block">
                <!-- Customer Info Title -->
                <div class="block-title">
                    <h2>
                        <i class="fa fa-file-o"></i>
                        <strong>{{ __('User Information') }}</strong>
                    </h2>
                </div>
                <!-- END Customer Info Title -->

                <!-- Customer Info -->
                <div class="block-section text-center">
                    <a href="javascript:void(0)">
                        <img src="{{ App\Helpers\Helper::getLinkUserAvatar($user->avatar) }}" alt="avatar" class="img-circle">
                    </a>
                    <h3>
                        <a href="{{ route('frontend.user.different.profiles', [$user->id, str_slug($user->display_name)]) }}" target="_blank">
                            <strong>{{ $user->display_name }}</strong>
                        </a>
                        <br><small></small>
                    </h3>
                </div>
                <table class="table table-borderless table-striped table-vcenter">
                    <tbody>
                        <tr>
                            <td class="text-right"><strong>{{ __('E-Mail Address') }}</strong></td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>{{ __('Permission') }}</strong></td>
                            <td>
                                <span class="label label-warning">
                                    {{ $permissionOption[$user->permission] }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>{{ __('Date of birth') }}</strong></td>
                            <td>{{ $user->birthday }}</td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>{{ __('Gender') }}</strong></td>
                            <td>
                                @if (isset($data['user']['optionGender'][$user->gender]))
                                    {{ $data['user']['optionGender'][$user->gender] }}
                                @else
                                   {{ __('Not selected') }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>{{ __('Registration') }}</strong></td>
                            <td>{{ $user->created_at }}</td>
                        </tr>
                        @if ($user->phone)
                            <tr>
                                <td class="text-right"><strong>{{ __('Phone') }}</strong></td>
                                <td>{{ $user->phone }}</td>
                            </tr>
                        @endif
                        @if ($user->address)
                            <tr>
                                <td class="text-right"><strong>{{ __('Address') }}</strong></td>
                                <td>{{ $user->address }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <!-- END Customer Info -->
            </div>
            <!-- END Customer Info Block -->
        </div>
        <div class="col-lg-3">
            <!-- Quick Stats Block -->
            <div class="block">
                <!-- Quick Stats Title -->
                <div class="block-title">
                    <h2>
                        <i class="fa fa-line-chart"></i>
                        <strong>{{ __('Quick') }}</strong> {{ __('Stats') }}
                    </h2>
                </div>
                <!-- END Quick Stats Title -->

                <!-- Quick Stats Content -->
                <a href="javascript:void(0)" class="widget widget-hover-effect2 themed-background-muted-light">
                    <div class="widget-simple">
                        <div class="widget-icon pull-right themed-background">
                            <i class="fa fa-truck"></i>
                        </div>
                        <h4 class="text-left">
                            <strong>
                                {{ App\Helpers\Helper::formatPrice($data['orders']['pending']->sum('grand_total')) }}
                            </strong><br>
                            <small>
                                {{ __('Orders Pending') }}
                                ({{ App\Helpers\Helper::numberIntegerFormat($data['orders']['pending']->count()) }})
                            </small>
                        </h4>
                    </div>
                </a>
                <a href="javascript:void(0)" class="widget widget-hover-effect2 themed-background-success">
                    <div class="widget-simple text-success">
                        <div class="widget-icon pull-right themed-background">
                            <i class="fa fa-usd"></i>
                        </div>
                        <h4 class="text-left">
                            <strong>
                                {{ App\Helpers\Helper::formatPrice($data['orders']['complete']->sum('grand_total')) }}
                            </strong><br>
                            <small>
                                {{ __('Orders Complete') }}
                                ({{ App\Helpers\Helper::numberIntegerFormat($data['orders']['complete']->count()) }})
                            </small>
                        </h4>
                    </div>
                </a>
                <a href="javascript:void(0)" class="widget widget-hover-effect2 themed-background-muted-light">
                    <div class="widget-simple text-warning">
                        <div class="widget-icon pull-right themed-background">
                            <i class="fa fa-times"></i>
                        </div>
                        <h4 class="text-left">
                            <strong>
                                {{ App\Helpers\Helper::formatPrice($data['orders']['cancel']->sum('grand_total')) }}
                            </strong><br>
                            <small>
                                {{ __('Orders Cancel') }}
                                ({{ App\Helpers\Helper::numberIntegerFormat($data['orders']['cancel']->count()) }})
                            </small>
                        </h4>
                    </div>
                </a>
                <a href="javascript:void(0)" class="widget widget-hover-effect2 themed-background-muted-light">
                    <div class="widget-simple text-danger">
                        <div class="widget-icon pull-right themed-background">
                            <i class="fa fa-truck"></i>
                        </div>
                        <h4 class="text-left">
                            <strong>
                                {{ App\Helpers\Helper::formatPrice($data['orders']['refund']->sum('grand_total')) }}
                            </strong><br>
                            <small>
                                {{ __('Orders Refund') }}
                                ({{ App\Helpers\Helper::numberIntegerFormat($data['orders']['refund']->count()) }})
                            </small>
                        </h4>
                    </div>
                </a>
                <a href="javascript:void(0)" class="widget widget-hover-effect2 themed-background-muted-light">
                    <div class="widget-simple">
                        <div class="widget-icon pull-right themed-background-success">
                            <i class="fa fa-star-o"></i>
                        </div>
                        <h4 class="text-left text-success">
                            <strong>
                                {{ App\Helpers\Helper::numberIntegerFormat($data['review']['count']) }}
                            </strong><br>
                            <small>{{ __('Reviews Total') }}</small>
                        </h4>
                    </div>
                </a>
                <a href="javascript:void(0)" class="widget widget-hover-effect2 themed-background-muted-light">
                    <div class="widget-simple">
                        <div class="widget-icon pull-right themed-background-warning">
                            <i class="fa fa-question"></i>
                        </div>
                        <h4 class="text-left text-warning">
                            <strong>
                                {{ App\Helpers\Helper::numberIntegerFormat($data['comment']['question']) }}
                            </strong><br>
                            <small>{{ __('Questions Total') }}</small>
                        </h4>
                    </div>
                </a>
                <a href="javascript:void(0)" class="widget widget-hover-effect2 themed-background-muted-light">
                    <div class="widget-simple">
                        <div class="widget-icon pull-right themed-background-info">
                            <i class="fa fa-comments-o"></i>
                        </div>
                        <h4 class="text-left text-info">
                            <strong>
                                {{ App\Helpers\Helper::numberIntegerFormat($data['comment']['answer']) }}
                            </strong><br>
                            <small>{{ __('Answers Total') }}</small>
                        </h4>
                    </div>
                </a>
                <a href="javascript:void(0)" class="widget widget-hover-effect2 themed-background-muted-light">
                    <div class="widget-simple">
                        <div class="widget-icon pull-right themed-background-danger">
                            <i class="fa fa-pencil-square-o"></i>
                        </div>
                        <h4 class="text-left text-danger">
                            <strong>
                                {{ App\Helpers\Helper::numberIntegerFormat($data['request']['medicine']) }}
                            </strong><br>
                            <small>{{ __('Requests Medicine Total') }}</small>
                        </h4>
                    </div>
                </a>
                <!-- END Quick Stats Content -->
            </div>
            <!-- END Quick Stats Block -->
        </div>
        <div class="col-lg-5">
            <!-- Orders Block -->
            <div class="block">
                <!-- Orders Title -->
                <div class="block-title">
                    <h2 class="col-sm-12">
                        <span>
                            <i class="fa fa-truck"></i>
                            <strong>{{ __('Orders') }}</strong>
                            ({{ App\Helpers\Helper::numberIntegerFormat($data['orders']['list']->count()) }})
                        </span>
                        <div class="block-options pull-right">
                            <span>{{ __('Orders Value') }}</span>
                            <span class="label label-success">
                                <strong>
                                    {{ App\Helpers\Helper::formatPrice($data['orders']['list']->sum('grand_total')) }}
                                </strong>
                            </span>
                        </div>
                    </h2>
                </div>
                <!-- END Orders Title -->

                <!-- Orders Content -->
                <table class="table table-bordered table-striped table-vcenter" id="user-order-list">
                    <thead>
                        <tr>
                            <th>{{ __('ID #') }}</th>
                            <th class="text-center">{{ __('Total Items') }}</th>
                            <th class="text-center">{{ __('Status') }}</th>
                            <th class="text-right">{{ __('Grand Total') }}</th>
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
                                <td class="text-center">{{ App\Helpers\Helper::numberIntegerFormat($order->total_items) }}</td>
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- END Orders Content -->
            </div>
            <!-- END Orders Block -->
        </div>
    </div>
</section><!-- /.content -->
@endsection

@section('javascript')
<script type="text/javascript">
    $('#user-order-list').DataTable({
        'order': [0, "desc" ]
    });
</script>
@endsection
