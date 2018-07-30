@extends('admin.layouts.admin-layout')

@section('pageAdminTitle', __('Add New User'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ __('Add New User') }}</h1>
    <ol class="breadcrumb">
        <li><a href="{!! url('admin') !!}"><i class="fa fa-dashboard"></i>{{ __('Home') }}</a></li>
        <li class="active">{{ __('New User') }}</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="col-md-10">
                        <h3 class="box-title">{{ __('New User') }}</h3>
                    </div>
                    <div class="col-md-2 text-right">
                        {!! Form::button(__('Save'), ['type' => 'submit', 'form' => 'add-new-user', 'data-toggle' => 'tooltip', 'class' => 'btn btn-primary', 'data-original-title' => __('Save')]) !!}

                        <a href="{!! url('admin/users') !!}" data-toggle="tooltip" class="btn btn-default" data-original-title="{{ __('Cancel') }}">
                            <i class="fa fa-reply"></i>
                        </a>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    {!! Form::open(['route' => 'users.store', 'id' => 'add-new-user', 'class' => 'form-horizontal', 'method' => 'post', 'files' => 'true']) !!}

                        <div class="form-group">
                            <div class="col-sm-6">
                                {!! Form::label('email', __('Email'), ['class' => 'col-sm-3 control-label']) !!}

                                <div class="col-sm-9">
                                    {!! Form::email('email', '', ['class' => 'form-control', 'placeholder' => __('Email')]) !!}
                                    <span class="text-danger">{!! $errors->first('email') !!}</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                {!! Form::label('display_name', __('Display Name'), ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('display_name', '', ['class' => 'form-control', 'placeholder' => __('Display Name')]) !!}
                                    <span class="text-danger">{!! $errors->first('display_name') !!}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                {!! Form::label('phone', __('Phone'), ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('phone', '', ['class' => 'form-control', 'placeholder' => __('Phone')]) !!}
                                    <span class="text-danger">{!! $errors->first('phone') !!}</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                {!! Form::label('address', __('Address'), ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('address', '', ['class' => 'form-control', 'placeholder' => __('Address')]) !!}
                                    <span class="text-danger">{!! $errors->first('address') !!}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                {!! Form::label('password', __('Password'), ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => __('Password')]) !!}
                                    <span class="text-danger">{!! $errors->first('password') !!}</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                {!! Form::label('confirm_password', __('Confirm Password'), ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::password('confirm_password', ['class' => 'form-control', 'placeholder' => __('Confirm Password')]) !!}
                                    <span class="text-danger">{!! $errors->first('confirm_password') !!}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                {!! Form::label('avatar', __('Avatar'), ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::file('avatar', ['class' => 'form-control']) !!}
                                    <span class="text-danger">{!! $errors->first('avatar') !!}</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                {!! Form::label('permission', __('Permission'), ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::select('permission', $permissionOption, null, ['class' => 'form-control']) !!}
                                    <span class="text-danger">{!! $errors->first('permission') !!}</span>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
@endsection
