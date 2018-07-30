@extends('frontend.layouts.master')

@section('title', __('Register'))

@section('content')
<section class="site-section site-section-light site-section-top themed-background-dark">
    <div class="container">
        <h1 class="text-center animation-slideDown">
            <i class="fa fa-plus"></i>
            <strong>{{ __('Sign Up') }}</strong>
        </h1>
        <h2 class="h3 text-center animation-slideUp">
            {{ __('Get your own dashboard in a few seconds!') }}
        </h2>
    </div>
</section>

<section class="site-content site-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3 col-lg-4 col-lg-offset-4 site-block">
                <!-- Sign Up Form -->
                {!! Form::open(['route' => 'register', 'method' => 'post', 'class' => 'form-horizontal', 'id' => 'form-sign-up', 'novalidate' => 'novalidate']) !!}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-user"></i></span>
                                {!! Form::text('display_name','',['class' => 'form-control input-lg', 'placeholder' => __('Display Name'), 'autofocus' => '', 'required' => '']) !!}
                            </div>
                            @if ($errors->has('display_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('display_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                             <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                                {!! Form::email('email','',['class' => 'form-control input-lg', 'placeholder' => __('E-Mail Address'), 'required' => '']) !!}
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
                                {!! Form::password('password', ['class' => 'form-control input-lg', 'required' => '', 'placeholder' => __('Password')]) !!}
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                                {!! Form::password('password_confirmation', ['class' => 'form-control input-lg', 'required' => '', 'placeholder' => __('Confirm Password')]) !!}
                            </div>
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group form-actions">
                        <div class="col-xs-6"></div>
                        <div class="col-xs-6 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fa fa-plus"></i>{{ __('Register') }}
                            </button>
                        </div>
                    </div>
                {!! Form::close() !!}
                <!-- END Sign Up Form -->
            </div>
        </div>
    </div>
</section>
@endsection
