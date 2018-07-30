@extends('admin.layouts.admin-layout')

@section('pageAdminTitle', __('Request Medicine'))

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ __('Request Medicine') }}
        <small>{{ __('List') }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!! url('admin') !!}"><i class="fa fa-dashboard"></i>{{ __('Home') }}</a></li>
        <li class="active">{{ __('Request Medicine') }}</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="col-md-10">
                        <h3 class="box-title">{{ __('Request Medicine') }}</h3>
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
                            <th>{{ __('Medicine Name') }}</th>
                            <th>{{ __('Short Describer') }}</th>
                            <th>{{ __('User') }}</th>
                            <th>{{ __('Created At') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody>

                        @php
                            $requestMedicines = $data['requestMedicine']
                        @endphp

                        @foreach ($requestMedicines as $requestMedicine)
                            <tr>
                                <td>
                                    <span>{{ $requestMedicine->id }}</span>
                                </td>
                                <td>
                                    <span>{{ $requestMedicine->medicine_name }}</span>
                                </td>
                                <td>
                                    <span>{!! str_limit($requestMedicine->short_describer, 120) !!}</span>
                                </td>
                                <td>
                                    <span>
                                        @if ($requestMedicine->getUser)
                                            {{ $requestMedicine->getUser->display_name }}
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <span>{{ $requestMedicine->created_at }}</span>
                                </td>
                                <td class="text-center">
                                    @if ($requestMedicine->status === App\Eloquent\RequestMedicine::STATUS_NOT_SEEN)
                                        <div class="btn btn-danger text-center">
                                            <i class="fa fa-eye-slash"></i>
                                            <span>{{ __('Not seen') }}</span>
                                        </div>
                                    @elseif ($requestMedicine->status === App\Eloquent\RequestMedicine::STATUS_WATCHED)
                                        <div class="btn btn-primary text-center">
                                            <i class="fa fa-eye"></i>
                                            <span>{{ __('Watched') }}</span>
                                        </div>
                                    @else
                                        <div class="btn btn-info text-center">
                                            <i class="fa fa-share-square-o"></i>
                                            <span>{{ __('Has responded') }}</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <span class="text-right">
                                        <a href="{{ route('request.edit', [$requestMedicine->id]) }}" data-toggle="tooltip" class="btn btn-primary" data-original-title="{{ __('View Detail') }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $requestMedicines->links() }}
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
@endsection
