@extends('frontend.layouts.master')

@section('title', __('Login'))

@section('content')
<section class="site-section site-section-light site-section-top themed-background-dark">
    <div class="container">
        <h1 class="text-center animation-slideDown"><i class="fa fa-arrow-right"></i> <strong>{{ __('Login') }}</strong></h1>
        <h2 class="h3 text-center animation-slideUp">{{ __('Connect to your dashboard!') }}</h2>
    </div>
</section>
<section class="site-content site-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3 col-lg-4 col-lg-offset-4 site-block">
                <!-- Log In Form -->
                {!! Form::open(['route' => 'login', 'method' => 'post', 'class' => 'form-horizontal', 'id' => 'form-log-in', 'novalidate' => 'novalidate']) !!}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                                {!! Form::email('email','',['class' => 'form-control input-lg', 'required' => '', 'autofocus' => '', 'placeholder' => __('E-Mail Address')]) !!}
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                                {!! Form::password('password',['class' => 'form-control input-lg', 'required' => '', 'placeholder' => __('Password')]) !!}
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                     <div class="form-group form-actions">
                        <div class="col-xs-6">
                            <label class="switch switch-primary">
                                {!! Form::checkbox('remember','', ['checked' => '']) !!}
                                <span></span>
                            </label>
                            <small>{{ __('Remember Me') }}</small>
                        </div>
                        <div class="col-xs-6 text-right">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-arrow-right"></i>{{ __('Login') }}</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-7 text-left">
                            <a href="{{ route('auth.social', ['facebook']) }}">
                                <span class="btn btn-primary"><i class="fa fa-facebook"></i></span>
                            </a>
                            <a href="{{ route('auth.social', ['google']) }}">
                                <span class="btn btn-danger"><i class="fa fa-google-plus"></i></span>
                            </a>
                        </div>
                        <div class="col-md-5">
                            <a class="btn btn-link" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                        </div>
                    </div>
                {!! Form::close() !!}
                <!-- END Log In Form -->
            </div>
        </div>
    </div>
</section>
@endsection
