@extends('admin.layouts.admin-layout')

@section('pageAdminTitle', __('Add New Parent Category'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ __('Add New Parent Category') }}</h1>
    <ol class="breadcrumb">
        <li><a href="{!! url('admin') !!}"><i class="fa fa-dashboard"></i>{{ __('Home') }}</a></li>
        <li class="active">{{ __('Add New Parent Category') }}</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="col-md-10">
                        <h3 class="box-title">{{ __('Add New Parent Category') }}</h3>
                    </div>
                    <div class="col-md-2 text-right">
                        {!! Form::button(__('Save'), ['type' => 'submit', 'form' => 'add-new-category', 'data-toggle' => 'tooltip', 'class' => 'btn btn-primary', 'data-original-title' => __('Save')]) !!}

                        <a href="{!! url('admin/category') !!}" data-toggle="tooltip" class="btn btn-default" data-original-title="{{ __('Cancel') }}">
                            <i class="fa fa-reply"></i>
                        </a>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    {!! Form::open(['route' => 'category.store', 'id' => 'add-new-category', 'class' => 'form-horizontal', 'method' => 'post', 'files' => 'true']) !!}
                        <div class="form-group">
                            <div class="col-sm-6">
                                {!! Form::label('name', __('Name'), ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('name', '', ['class' => 'form-control', 'placeholder' => __('Name')]) !!}
                                    <span class="text-danger">{!! $errors->first('name') !!}</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                {!! Form::label('link', __('Link'), ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('link', '', ['class' => 'form-control', 'placeholder' => __('Link')]) !!}
                                    <span class="text-danger">{!! $errors->first('link') !!}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                {!! Form::label('image', __('Image'), ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::file('image', ['class' => 'form-control']) !!}
                                    <span class="text-danger">{!! $errors->first('image') !!}</span>
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
