<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <title>@yield('pageAdminTitle')</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    @include('admin.layouts.library.header-css')

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    @include('admin.layouts.library.content-header')

    @include('admin.layouts.library.sidebar')

    <div class="content-wrapper">
        @include('admin.layouts.library.session-message')

        <!-- Load Content -->
        @yield('content')
        <!-- End Load Content -->
    </div>
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
        </div>
        <strong>{{ __('Copyright') }} &copy; {!! date('Y') !!}</strong>
        {{ __('All rights reserved.') }}
    </footer>

</div><!-- ./wrapper -->

@include('admin.layouts.library.footer-js')

<!-- Write Custome Javascrip -->
@yield('javascript')
<!-- End Write Custome Javascrip -->

</body>
</html>
