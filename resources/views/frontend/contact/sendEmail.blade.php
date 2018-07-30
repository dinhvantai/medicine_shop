@extends('frontend.layouts.master')

@section('title', __('Contact Us'))

@section('content')
<!-- Media Container -->
    <div class="wrap-page-contact">
        <section class="site-section site-section-light site-section-top themed-background-dark">
            <div class="container">
                <h1 class="text-center animation-slideDown"><i class="fa fa-envelope"></i> <strong>{{ __('Contact Us') }}</strong></h1>
                <h2 class="h3 text-center animation-slideUp">{{ __('We will be happy to answer all your questions and work together!') }}</h2>
            </div>
        </section>
        <section class="site-content site-section">
            <div class="container">

                @include('frontend.components.show-message')

                <div class="row row-items text-center">
                    <div class="col-sm-4 animation-fadeIn">
                        <a href="javascript:void(0)" class="circle themed-background send-email-circle">
                            <i class="gi gi-envelope"></i>
                        </a>
                        <h4><strong>{{ __('Mail') }}</strong>{{ __(' Us') }}</h4>
                    </div>
                    <div class="col-sm-4 animation-fadeIn">
                        <a href="{{ asset('https://www.facebook.com/ec.ec.ec.ec.ec.ec6969')}}" target="_blank" class="circle themed-background">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                        </a>
                        <h4><strong>{{ __('Like ') }}</strong>{{ __(' Us on Facebook') }}</h4>
                    </div>
                    <div class="col-sm-4 animation-fadeIn">
                        <a href="{{ asset('https://twitter.com/')}}" target="_blank" class="circle themed-background">
                            <i class="fa fa-twitter"></i>
                        </a>
                        <h4><strong>{{ __('Tweet') }}</strong>{{ __(' Us') }}</h4>
                    </div>
                </div>
                <hr>
            </div>
        </section>

        <section class="site-content site-section contact-content">
            <div class="container">
                <div class="row">
                    
                    <div class="col-sm-12 col-md-12 site-block">
                        <h3 class="h2 site-heading"><strong>{{ __('Contact') }}</strong>{{ __(' Form') }}</h3>
                        {!! Form::open(array('method' => 'post', 'route' => array('frontend.sendemail')))!!}
                                <div class="form-group">
                                    {{ Form::label('contact-name', __('Name')) }}
                                    {{ Form::text('firstname', '', ['class' => 'form-control input-lg ', 'placeholder' => 'Your title', 'required' => '']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('contact-email', __('Email')) }}
                                    {{ Form::email('email', '', ['class' => 'form-control input-lg ', 'placeholder' => 'Your title', 'required' => '']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('contact-message', __('Message')) }}
                                    {{ Form::textarea('message', '', ['class' => 'form-control input-lg ', 'placeholder' => 'Your title', 'required' => '']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::submit('Send Message', array('class' => 'btn btn-lg btn-primary ')) }}
                                </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
