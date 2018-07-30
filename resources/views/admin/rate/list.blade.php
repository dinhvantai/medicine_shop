@extends('admin.layouts.admin-layout')

@section('pageAdminTitle', __('Review Medicine'))

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ __('Review Medicine') }}
        <small>{{ __('List') }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!! url('admin') !!}"><i class="fa fa-dashboard"></i>{{ __('Home') }}</a></li>
        <li class="active">{{ __('Review Medicine') }}</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="col-md-10">
                        <h3 class="box-title">{{ __('Review Medicine') }}</h3>
                    </div>
                    <div class="col-md-2 text-right">
                        <a href="" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="{{ __('Rebuild') }}"><i class="fa fa-refresh"></i></a>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="user_list_table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>{{ __('ID #') }}</th>
                            <th>{{ __('Medicine') }}</th>
                            <th>{{ __('User') }}</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Point') }}</th>
                            <th>{{ __('Content') }}</th>
                            <th>{{ __('Created At') }}</th>
                        </tr>
                        </thead>
                        <tbody>

                        @php
                            $rates = $data['rates']
                        @endphp

                        @foreach ($rates as $rate)
                            <tr>
                                <td>
                                    <span>{{ $rate->id }}</span>
                                </td>
                                <td>
                                    <span>{{ $rate->getMedicine->name }}</span>
                                </td>
                                <td>
                                    @if ($rate->user_id)
                                        <span>{{ $rate->getUser->display_name }}</span>
                                    @else
                                        <span class="text-danger">{{ __('User not login') }}</span>
                                    @endif
                                </td>
                                <td>{{ $rate->title }}</td>
                                <td>
                                    <span>{{ $rate->point_rate }}</span>
                                </td>
                                <td>{{ $rate->content }}</td>
                                <td>
                                    <span>{{ $rate->created_at }}</span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $rates->links() }}
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
@endsection
