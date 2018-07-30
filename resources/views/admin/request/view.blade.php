@extends('admin.layouts.admin-layout')

@php
    $requestMedicine = $data['requestMedicine']
@endphp

@section('pageAdminTitle', __('Detail request medicine :name', ['name' => $requestMedicine->medicine_name]))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ __('Detail request medicine :name', ['name' => $requestMedicine->medicine_name]) }}</h1>
    <ol class="breadcrumb">
        <li><a href="{!! url('admin') !!}"><i class="fa fa-dashboard"></i>{{ __('Home') }}</a></li>
        <li class="active">{{ __('Detail request medicine :name', ['name' => $requestMedicine->medicine_name]) }}</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="col-md-10"></div>
                    <div class="col-md-2 text-right">
                        {!! Form::button(__('Save'), ['type' => 'submit', 'form' => 'save-request-medicine', 'data-toggle' => 'tooltip', 'class' => 'btn btn-primary', 'data-original-title' => __('Save')]) !!}
                        <a href="{!! route('request.index') !!}" data-toggle="tooltip" class="btn btn-default" data-original-title="{{ __('Cancel') }}">
                            <i class="fa fa-reply"></i>
                        </a>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="col-sm-12">
                        <div class="panel panel-info">
                            <!-- Default panel contents -->
                            <div class="panel-heading">
                                <i class="fa fa-medkit"></i>
                                <span>{{ $requestMedicine->medicine_name }}</span>
                            </div>
                            <div class="panel-body">
                                <!-- List group -->
                                <ul class="list-group">
                                    @if ($requestMedicine->getUser)
                                        <li class="list-group-item">
                                            <span class="label label-info">{{ __('User') }}</span>
                                            <span>
                                                {{ 
                                                    $requestMedicine->getUser->display_name
                                                }}
                                            </span>
                                        </li>
                                    @endif
                                    <li class="list-group-item">
                                        <span class="label label-info">{{ __('Short Describer') }}</span>
                                        <span>{{ $requestMedicine->short_describer }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    {!! Form::open(['route' => ['request.update', $requestMedicine->id], 'id' => 'save-request-medicine', 'class' => 'form-horizontal', 'method' => 'PUT']) !!}

                        <div class="form-group">
                            <div class="col-sm-1"></div>
                            @foreach ($requestMedicine->getAllImages as $image)
                                <div class="col-sm-2">
                                    <img src="{{ url($image->path_origin) }}" class="img-thumbnail max-height-200px" alt="{{ $requestMedicine->medicine_name }}">
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-12">
                                {!! Form::label('status', __('Status'), ['class' => 'col-sm-1 control-label']) !!}
                                <div class="col-sm-11">
                                    {!! Form::select('status', $data['option'], $requestMedicine->status, ['class' => 'form-control']) !!}
                                    <span class="text-danger">{!! $errors->first('status') !!}</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                {!! Form::label('respone_admin', __('Respone By Admin'), ['class' => 'col-sm-1 control-label']) !!}

                                <div class="col-sm-11">
                                    {!! Form::textarea('respone_admin', $requestMedicine->respone_admin, ['class' => 'form-control', 'placeholder' => __('Respone By Admin'), 'rows' => '6']) !!}
                                    <span class="text-danger">{!! $errors->first('respone_admin') !!}</span>
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
