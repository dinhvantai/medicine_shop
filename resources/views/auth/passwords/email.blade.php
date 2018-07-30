@extends('frontend.layouts.master')

@section('title', __('Reset Password'))

@section('content')
<section class="site-section site-section-light site-section-top themed-background-dark">
    <div class="container">
    </div>
</section>
<section class="site-content site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ __('Reset Password') }}</div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        {!! Form::open(['route' => 'password.email', 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form']) !!}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                {!! Form::label('email', __('E-Mail Address'), ['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::email('email','',['class' => 'form-control', 'placeholder' => __('E-Mail Address'), 'required' => '']) !!}
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    {!! Form::button(__('Send Password Reset Link'),['class' => 'btn btn-primary', 'type' => 'submit']) !!}
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
