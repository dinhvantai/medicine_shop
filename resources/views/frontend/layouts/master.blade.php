<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/slick-carousel/slick/slick-theme.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/slick-carousel/slick/slick.css') }}" />
    <link href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/layouts.css') }}" />
    <link href="{{ asset('bower_components/bootstrap-star-rating/css/star-rating.min.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('bower_components/bootstrap-star-rating/css/theme-krajee-svg.min.css') }}" type="text/css" />
    <link href="{{ asset('bower_components/bootstrap-star-rating/css/theme-krajee-fa.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{!! url('bower_components/AdminLTE/plugins/select2/select2.min.css') !!}"/>
    {{-- template css --}}
    <link rel="stylesheet" href="{{ asset('/css/template/plugins.css') }}">
    <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
    <link rel="stylesheet" href="{{ asset('/css/template/main.css') }}">

    <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
    <link rel="stylesheet" href="{{ asset('/css/template/themes.css') }}">
    <!-- END Stylesheets -->
    <link rel="stylesheet" href="{!! url('bower_components/bootstrap-sweetalert/dist/sweetalert.css') !!}"/>

    @yield('custom-css')

    {{-- end template css --}}
</head>
<body>
    <div class="wrap-page">
        <!-- Start header -->
        @include('frontend.layouts.library.header')
        <!-- Sub navigation bar -->
        <!-- End header -->
        <!-- Start content -->
        @yield('content')
        <!-- End content -->
        <!-- Start footer -->
        @include('frontend.layouts.library.footer')
        <!-- End footer -->
    </div>
    @section('frontend-js')
        <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
        @include('frontend.layouts.library.footer-js')
        <script src="{{ asset('/js/template/plugins.js') }}"></script>
    @show
    @yield('custom-javascript')
    
</body>
</html>

