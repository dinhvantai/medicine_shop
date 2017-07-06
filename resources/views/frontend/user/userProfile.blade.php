@extends('frontend.layouts.master')

@section('title', __('My profiles'))

@section('content')
<div class="media-container media2">
    <!-- For best results use an image with a resolution of 2560x279 pixels -->
    <div class="container banner-title">
        <h1 class="text-center animation-slideDown">
            <strong>
                {{ __('Hello '). Auth::user()->display_name }}
            </strong>
        </h1>
        <h2 class="h3 text-center animation-slideUp">
            {{ __("Let's check your profiles!") }}
        </h2>
    </div>
    <img src="{{ asset('images/mountain.jpg') }}" alt="Image" class="media-image animation-pulseSlow">
</div>

<div class="wrap-user-sitecontent">
    <section class="site-content site-section site-slide-content site-userprofile">
        <div class="container">
            <div class="mainbody container-fluid">
                <div class="row padding-15px">
                    
                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="img-padding-circle" align="center"> 
                                    <img alt="User Pic" src="{!! App\Helpers\Helper::getLinkUserAvatar(Auth::user()->avatar) !!}" class="img-circle img-responsive" width="300px" height="300px"> 
                                    <div class="edit-icon">
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#modalAvatar">
                                            <i class="fa fa-pencil" aria-hidden="true"></i> {{ __('Edit') }}
                                        </a>
                                    </div>
                                </div>
                                <div class="media-body"><hr>
                                    <h4><strong>{{ __('Short Describe') }}</strong></h4>
                                    <p>{{ Auth::user()->about_you }}</p><hr/>

                                    <h4><strong>{{ __('Type User') }}</strong></h4>
                                    <p>
                                        <span class="label label-warning">
                                            {{ $option['permission'][Auth::user()->permission] }}
                                        </span>
                                    </p><hr/>

                                    <h4><strong>{{ __('Display Name') }}</strong></h4>
                                    <p>{{ Auth::user()->display_name }}</p><hr/>

                                    <h4><strong>{{ __('Gender') }}</strong></h4>
                                    <p>
                                        @if (isset($option['gender'][Auth::user()->gender]))
                                            {{ $option['gender'][Auth::user()->gender] }}
                                        @else
                                           {{ __('Not selected') }}
                                        @endif
                                    </p><hr/>

                                    <h4><strong>{{ __('Birthday') }}</strong></h4>
                                    <p>{{ Auth::user()->birthday }}</p><hr/>

                                    <h4><strong>{{ __('Phone') }}</strong></h4>
                                    <p>{{ Auth::user()->phone }}</p><hr/>
                                    
                                    <h4><strong>{{ __('Address') }}</strong></h4>
                                    <p>{{ Auth::user()->address }}</p><hr/>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $userProfiles = Auth::user();
                    @endphp
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h3 class="mgbt-xs-15 mgtp-10 font-semibold text-info">
                                    <i class="icon-user mgr-10 profile-icon"></i>
                                    {{ __('User Information') }}
                                    <a href="javascript:void(0)" class="span-edit-profile text-warning" data-toggle="modal" data-target="#per-info">
                                        ({{ __('Change Profile') }}
                                        <i class="fa fa-pencil" aria-hidden="true"></i>)
                                    </a>
                                </h3>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row mgbt-xs-0">
                                            <label class="col-xs-5 control-label">{{ __('E-Mail Address') }}</label>
                                            <div class="col-xs-7 controls">
                                                {{ $userProfiles->email }}
                                            </div>
                                            <!-- col-sm-10 --> 
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row mgbt-xs-0">
                                            <label class="col-xs-5 control-label">{{ __('Password') }}</label>
                                            <div class="col-xs-7 controls">
                                                <span>{{ __('*********') }}</span>
                                                <span class="span-edit-password text-warning">
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#change-password">
                                                        ({{ __('Change password') }})
                                                    </a>
                                                </span>
                                            </div>
                                            <!-- col-sm-10 --> 
                                        </div>
                                    </div>
                                </div>

                                @if($userProfiles->permission == App\Eloquent\User::PERMISSION_DOCTER)
                                    <h3 class="mgbt-xs-15 mgtp-10 font-semibold text-info">
                                        <i class="icon-user mgr-10 profile-icon"></i>
                                        {{ __('Doctor Information') }}
                                    </h3>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="row mgbt-xs-0">
                                                <label class="col-xs-5 control-label">{{ __('Specialize') }}</label>
                                                <div class="col-xs-7 controls">{{ $userProfiles->specialize }}</div>
                                                <!-- col-sm-10 --> 
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row mgbt-xs-0">
                                                <label class="col-xs-5 control-label">{{ __('Experience') }}</label>
                                                <div class="col-xs-7 controls">{{ $userProfiles->experience }}</div>
                                                <!-- col-sm-10 --> 
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row mgbt-xs-0">
                                                <label class="col-xs-5 control-label">{{ __('Certificate') }}</label>
                                                <div class="col-xs-7 controls">{{ $userProfiles->certificate }}</div>
                                                <!-- col-sm-10 --> 
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row mgbt-xs-0">
                                                <label class="col-xs-5 control-label">{{ __('Workplace') }}</label>
                                                <div class="col-xs-7 controls">{{ $userProfiles->workplace }}</div>
                                                <!-- col-sm-10 --> 
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row mgbt-xs-0">
                                                <label class="col-xs-5 control-label">{{ __('Position') }}</label>
                                                <div class="col-xs-7 controls">{{ $userProfiles->position }}</div>
                                                <!-- col-sm-10 --> 
                                            </div>
                                        </div>

                                    </div><hr>
                                @endif
                            </div>
                        </div>
                        
                        <div class="panel panel-default">
                            <div class="panel-body">

                                <div class="col-lg-5">
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
                                                <div class="widget-icon pull-right">
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
                                                <div class="widget-icon pull-right">
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
                                                <div class="widget-icon pull-right">
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
                                                <div class="widget-icon pull-right">
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
                                        <a href="javascript:void(0)" class="widget widget-hover-effect2">
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

                                        @if (Auth::user()->permission == App\Eloquent\User::PERMISSION_DOCTER)
                                            <a href="javascript:void(0)" class="widget widget-hover-effect2 themed-background-muted-light">
                                                <div class="widget-simple">
                                                    <div class="widget-icon pull-right themed-background-danger">
                                                        <i class="fa fa-reply"></i>
                                                    </div>
                                                    <h4 class="text-left text-danger">
                                                        <strong>
                                                            {{ App\Helpers\Helper::numberIntegerFormat($data['doctor']['request']) }}
                                                        </strong><br>
                                                        <small>{{ __('Requests Prescription from User') }}</small>
                                                    </h4>
                                                </div>
                                            </a>
                                            <a href="javascript:void(0)" class="widget widget-hover-effect2 themed-background-muted-light">
                                                <div class="widget-simple">
                                                    <div class="widget-icon pull-right themed-background-danger">
                                                        <i class="fa fa-hospital-o"></i>
                                                    </div>
                                                    <h4 class="text-left text-danger">
                                                        <strong>
                                                            {{ App\Helpers\Helper::numberIntegerFormat($data['doctor']['prescription']) }}
                                                        </strong><br>
                                                        <small>{{ __('Make Prescription for User') }}</small>
                                                    </h4>
                                                </div>
                                            </a>
                                        @endif
                                        
                                        <!-- END Quick Stats Content -->

                                    </div>
                                    <!-- END Quick Stats Block -->
            
                                </div>
                                <div class="col-lg-7">
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
                                                            <a href="{{ route('frontend.order.detail', [$order->id]) }}">
                                                                {{ $order->id }}
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
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Change Profile User -->
<div class="modal fade" id="per-info" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
                    {{ __('Edit personal information') }}
                </h4>
            </div>
            <div class="modal-body form-edit-user">
                {!! Form::open(['route' => 'frontend.user.edit.personal']) !!}
                    {{-- personal edit --}}
                    <div class="form-group col-md-6 col-xs-12">
                        {{ Form::label('display_name', __('Name')) }}
                        {{ Form::text('display_name', Auth::user()->display_name, array('class' => 'form-control display_name')) }}
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        {{ Form::label('gender', __('Gender')) }}
                        {{ Form::select('gender', $option['gender'], Auth::user()->gender, array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        {{ Form::label('date_of_birth', __('Date of birth :')) }}
                        {{ Form::date('birthday', Auth::user()->birthday, array('class' => 'form-control date_of_birth')) }}
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        {{ Form::label('phone', __('Phone')) }}
                        {{ Form::text('phone', Auth::user()->phone, array('class' => 'form-control phone')) }}
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        {{ Form::label('address', __('Address')) }}
                        {{ Form::text('address', Auth::user()->address, array('class' => 'form-control address')) }}
                    </div>
                    <div class="form-group col-md-12 col-xs-12">
                        {{ Form::label('about_you', __('Short describe')) }}
                        {{ Form::textarea('about_you', Auth::user()->about_you, array('class' => 'form-control describe', 'rows' => '6')) }}
                    </div>
                    {{ Form::hidden('user_id', Auth::user()->id, array('id' => 'user_id_hidden')) }}
                    
                    {{-- end personal edit --}}
                    {{-- specialize edit --}}
                    @if (Auth::user()->permission == App\Eloquent\User::PERMISSION_DOCTER)
                        <div class="form-group col-md-6 col-xs-12">
                            {{ Form::label('position', __('Position')) }}
                            {{ Form::text('position', Auth::user()->position, array('class' => 'form-control position')) }}
                        </div>
                        <div class="form-group col-md-6 col-xs-12">
                            {{ Form::label('specialize', __('Specialize')) }}
                            {{ Form::text('specialize', Auth::user()->specialize, array('class' => 'form-control specialize')) }}
                        </div>
                        <div class="form-group col-md-6 col-xs-12">
                            {{ Form::label('certificate', __('Certificate')) }}
                            {{ Form::text('certificate', Auth::user()->certificate, array('class' => 'form-control certificate')) }}
                        </div>
                        <div class="form-group col-md-6 col-xs-12">
                            {{ Form::label('experience', __('Experience')) }}
                            {{ Form::text('experience', Auth::user()->experience, array('class' => 'form-control experience')) }}
                        </div>
                        <div class="form-group col-md-6 col-xs-12">
                            {{ Form::label('workplace', __('Workplace')) }}
                            {{ Form::text('workplace', Auth::user()->workplace, array('class' => 'form-control workplace')) }}
                        </div>
                    @endif
                   
                    {{ Form::submit('Submit', array('class' => 'btn btn-success user-submit-personal-info','data-toggle'=> 'modal', 'data-target' => '#per-user-edit')) }}
                    {{-- end specialize edit --}}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
<!-- Change Profile User -->

<!-- Modal change password -->
<div class="modal fade" id="change-password" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="indicator hide" id="change-password-indicator">
                <div class="spinner"></div>
            </div>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
                    {{ __('Change password') }}
                </h4>
            </div>
            <div class="modal-body">
                <p class="change-password-notification text-center"></p>
                <div class="form-group">
                    {{ Form::label('old_password', __('Old password')) }}
                    {{ Form::password('old_password', array('class' => 'form-control data-old-password', 'placeholder' => 'Old password')) }}
                    <span class="text-danger noti-old-password"></span>
                </div>
                
                <div class="form-group">
                    {{ Form::label('new_password', __('New password')) }}
                    {{ Form::password('new_password', array('class' => 'form-control data-new-password', 'placeholder' => 'New password')) }}
                    <span class="text-danger noti-new-password"></span>
                </div>
                <div class="form-group">
                    {{ Form::label('confirm-password', __('Confirm password')) }}
                    {{ Form::password('confirm_password', array('class' => 'form-control data-confirm-password', 'placeholder' => 'Confirm password')) }}
                    <span class="text-danger noti-confirm-password"></span>
                </div>
                <button class="btn btn-success user-change-password">{{ __('Change') }}</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal change password -->

<!-- Modal avatar -->
<div class="modal fade" id="modalAvatar" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
                    {{ __('Update avatar') }}
                </h4>
            </div>
            <div class="modal-body upload-avatar-form">
                <div class="wrap-upload">
                    <div class="row">
                        <a href="javascript:void(0)" id="attachfile">
                            <div class="col-md-12 col-sm-12 col-sx-12 button-upload-avatar" >
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                <span>{{ __('Upload Image') }}</span>
                            </div>
                        </a>
                    </div>
                    <div class="row">
                        <div class="wrap-image-upload">
                            <div class="col-md-3 col-lg-3">
                            </div>
                            <div class="col-md-6 col-lg-6 img-padding-circle image-upload" align="center"> 
                                <img alt="User Pic" id= "image_target" src="{!! App\Helpers\Helper::getLinkUserAvatar(Auth::user()->avatar) !!}" class="img-circle img-responsive" width="300px" height="300px"> 
                            </div>
                        </div>
                    </div>
                    <div class="wrap-upload-note">
                        <span><b>{{ __('Note') }} : </b>{{ __("Image's size recomment: greater 350px width and height") }} </span>

                    </div>
                    <div class="form-upload-avatar">
                       {{ Form::open(array('route' => 'show_upload_avatar', 'files'=>'true')) }}
                       {{ Form::file('image_upload', array('id' => 'edit_photo')) }} 
                       {{ Form::submit('Save', array('id' => 'submit_photo', 'class' => 'btn btn-success')) }} 
                       {{ Form::close() }}
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>
<!-- Modal avatar -->
@endsection

@section('custom-css')
    <link rel="stylesheet" href="{!! url('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css') !!}"/>
@endsection

@section('custom-javascript')
    <script src="{!! url('bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! url('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js') !!}"></script>
    <script type="text/javascript">
        $('#user-order-list').DataTable({
            'order': [0, "desc" ]
        });
    </script>
@endsection
