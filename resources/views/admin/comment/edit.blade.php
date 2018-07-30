@extends('admin.layouts.admin-layout')

@section('pageAdminTitle', __('Edit Comment'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ __('Edit Comment') }}</h1>
    <ol class="breadcrumb">
        <li><a href="{!! url('admin') !!}"><i class="fa fa-dashboard"></i>{{ __('Home') }}</a></li>
        <li class="active">{{ __('Edit Comment') }}</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="col-md-10">
                        <h3 class="box-title">{{ __('Edit Comment') }}</h3>
                    </div>
                    <div class="col-md-2 text-right">
                        {!! Form::button(__('Save'), ['type' => 'submit', 'form' => 'edit-comment', 'data-toggle' => 'tooltip', 'class' => 'btn btn-primary', 'data-original-title' => __('Save')]) !!}

                        <a href="{!! route('comment.index') !!}" data-toggle="tooltip" class="btn btn-default" data-original-title="{{ __('Cancel') }}">
                            <i class="fa fa-reply"></i>
                        </a>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    {!! Form::open(['route' => ['comment.update', $comment->id], 'id' => 'edit-comment', 'class' => 'form-horizontal', 'method' => 'PUT']) !!}

                        <div class="form-group">
                            <div class="col-sm-12">
                                {!! Form::label('content', __('Content'), ['class' => 'col-sm-1 control-label']) !!}

                                <div class="col-sm-11">
                                    {{ $comment->content }}
                                    <span class="text-danger">{!! $errors->first('content') !!}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4">
                                {!! Form::label('status', __('Status'), ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::select('status', $optionStatus, $comment->status, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-sm-4">
                                {!! Form::label('', __('User'), ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    <span class="label label-info">{!! $comment->getUser->display_name !!}</span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                {!! Form::label('', __('Medicine'), ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    <span class="label label-info">{!! $comment->getMedicine->name !!}</span>
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

