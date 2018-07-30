@extends('frontend.layouts.master')

@section('title', __('Add New Request Prescription'))

@section('content')
<section class="site-section site-section-light site-section-top themed-background-dark">
    <div class="container text-center">
        <h1 class="animation-slideDown">
            <p><strong>{{ __('Add New Request Prescription') }}</strong></p>
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
                                <a href="{!! route('request-prescription.index') !!}" data-toggle="tooltip" class="btn btn-default" title="{{ __('Cancel') }}">
                                    <i class="fa fa-reply"></i>
                                </a>
                                {!! Form::button(__('Save'), ['type' => 'submit', 'form' => 'add-new-prescription', 'data-toggle' => 'tooltip', 'class' => 'btn btn-primary', 'title' => __('Save')]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['route' => 'request-prescription.store', 'id' => 'add-new-prescription', 'class' => 'form-horizontal', 'method' => 'post', 'files' => 'true']) !!}

                            <div class="form-group">
                                {!! Form::label('title', __('Title'), ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('title', '', ['class' => 'form-control', 'placeholder' => __('Title'), 'required' => 'true']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('describer', __('Describer'), ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::textarea('describer', '', ['class' => 'form-control', 'rows' => '6']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('doctors', __('Doctors'), ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-9">
                                    {{ Form::select('doctors[]', $doctorOption, null, ['multiple' => true, 'class' => 'form-control select-doctor'])}}
                                    <span class="text-danger">{!! $errors->first('doctors') !!}</span>
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
             <div class="indicator hide">
                <div class="spinner"></div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('custom-javascript')
    <script src="{!! url('bower_components/AdminLTE/plugins/select2/select2.min.js') !!}"></script>
    <script type="text/javascript">
        $('.select-doctor').select2();
    </script>
@endsection
