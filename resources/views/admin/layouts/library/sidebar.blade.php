<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                @if (Auth::user()->avatar)
                    <img src="{!! asset(Auth::user()->avatar) !!}" class="user-image">
                @else
                    <img src="{!! asset('bower_components/AdminLTE/dist/img/avatar.png') !!}" class="user-image">
                @endif
            </div>
            <div class="pull-left info">
                <p>{!! Auth::user()->display_name !!}</p>
                <a href="#"><i class="fa fa-circle text-success"></i>{{ __('Online') }}</a>
            </div>
        </div>
    
        <ul class="sidebar-menu">
            <li class="header" style=" text-transform: uppercase">
                {{ __('Main Navigation') }}
            </li>
            <li class="treeview">
                <a href="{{ route('users.index') }}">
                    <i class="fa fa-users"></i>
                    <span> {{ __('List Users') }} </span>
                </a>
            </li>
            <li class="treeview">
                <a href="{{ route('category.index') }}">
                    <i class="fa fa-list-ul"></i>
                    <span> {{ __('Category') }} </span>
                </a>
            </li>
            <li class="treeview">
                <a href="{{ route('medicine.index') }}">
                    <i class="fa fa-medkit"></i>
                    <span> {{ __('Medicine') }} </span>
                </a>
            </li>
            <li class="treeview">
                <a href="{{ route('comment.index') }}">
                    <i class="fa fa-facebook-f"></i>
                    <span> {{ __('Comment') }} </span>
                </a>
            </li>
            <li class="treeview">
                <a href="{{ route('rate.index') }}">
                    <i class="fa fa-star"></i>
                    <span> {{ __('Review Medicine') }} </span>
                </a>
            </li>
            <li class="treeview">
                <a href="{{ route('request.index') }}">
                    <i class="fa  fa-question"></i>
                    <span> {{ __('Request Medicine') }} </span>
                </a>
            </li>
            <li class="treeview">
                <a href="{{ route('admin.orders.index') }}">
                    <i class="fa fa-shopping-cart"></i>
                    <span> {{ __('Orders') }} </span>
                </a>
            </li>
            <li class="treeview">
                <a href="{{ route('admin.setup') }}">
                    <i class="fa fa-cog"></i>
                    <span>{{ __('Setup Website') }}</span>
                    
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
