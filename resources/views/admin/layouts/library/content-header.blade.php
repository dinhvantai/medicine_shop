<header class="main-header">

    <!-- Logo -->
    <a href="{{ url('admin') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>DB</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>{{ __('Admin') }}</b>{!! __('Dashboard') !!}</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">{{ __('Toggle Navigation') }}</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li>
                    <a href="{!! url('') !!}" target="_blank">{{ __('Go Home Page') }}</a>
                </li>

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if (Auth::user()->avatar)
                            <img src="{!! asset(Auth::user()->avatar) !!}" class="user-image">
                        @else
                            <img src="{!! asset('bower_components/AdminLTE/dist/img/avatar.png') !!}" class="user-image">
                        @endif
                        <span class="hidden-xs">{!! Auth::user()->display_name !!}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            @if (Auth::user()->avatar)
                                <img src="{!! asset(Auth::user()->avatar) !!}" class="user-image">
                            @else
                                <img src="{!! asset('bower_components/AdminLTE/dist/img/avatar.png') !!}" class="user-image">
                            @endif
                            <p>
                                <span class="hidden-xs">{!! Auth::user()->display_name !!}</span>
                                <small></small>
                            </p>
                            <p>
                                <small>
                                    {!! Auth::user()->address !!}
                                        - 
                                    {!! Auth::user()->phone !!}
                                </small>
                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                {!! Form::open(['url' => url('logout'), 'method' => 'post']) !!}
                                    <a data-toggle="tooltip" class="btn btn-danger" onclick="confirmButtonBeforeSubmit(this)" data-text="{{ __('Do you want to delete?') }}" data-original-title="{{ __('Logout') }}">
                                        {{ __('Logout') }}
                                    </a>
                                {!! Form::close() !!}
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
            </ul>
        </div>
    </nav>
</header>
