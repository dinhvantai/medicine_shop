@extends('frontend.layouts.master')

@section('title', __('Add New Request Medicine'))

@section('content')
<section class="site-section site-section-light site-section-top themed-background-dark">
    <div class="container text-center">
        <h1 class="animation-slideDown">
            <p><strong>{{ __('Add New Request Medicine') }}</strong></p>
        </h1>
    </div>
</section>
<section class="site-content site-section padding-15px">
    <div class="container">
        <div class="content position-relative" id="area-add-prescription">
            <div class= "row">
                <div class="panel panel-success">
                    <div class="panel-heading text-center">
                        <div class="row padding-15px">
                            <div class="col-sm-12 text-right">
                                <a href="{!! route('frontend.request-medicine.index') !!}" data-toggle="tooltip" class="btn btn-default" title="{{ __('Cancel') }}">
                                    <i class="fa fa-reply"></i>
                                </a>
                                {!! Form::button(__('Save'), ['type' => 'submit', 'form' => 'add-new-medicine', 'data-toggle' => 'tooltip', 'class' => 'btn btn-primary', 'title' => __('Save')]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['route' => 'frontend.request-medicine.store', 'id' => 'add-new-medicine', 'class' => 'form-horizontal', 'method' => 'post', 'files' => 'true']) !!}

                            <div class="form-group">
                                {!! Form::label('medicine_name', __('Medicine Name'), ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('medicine_name', '', ['class' => 'form-control', 'placeholder' => __('Medicine Name'), 'required' => 'true']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('short_describer', __('Short Describe'), ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::textarea('short_describer', '', ['class' => 'form-control', 'rows' => '6', 'placeholder' => __('Short Describe')]) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('images', __('Images'), ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::file('images[]', ['class' => 'form-control', 'multiple' => true]) !!}
                                    <span class="text-danger">{!! $errors->first('images.*') !!}</span>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
