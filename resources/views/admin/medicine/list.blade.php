@extends('admin.layouts.admin-layout')

@section('pageAdminTitle', __('List Medicines'))

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ __('Medicines') }}
        <small>{{ __('List') }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!! url('admin') !!}"><i class="fa fa-dashboard"></i>{{ __('Home') }}</a></li>
        <li class="active">{{ __('List Medicines') }}</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="col-md-10">
                        <h3 class="box-title">{{ __('List Medicines') }}</h3>
                    </div>
                    <div class="col-md-1 text-right">
                        <a href="{!! route('medicine.create') !!}" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="{{ __('Add New') }}"><i class="fa fa-plus"></i></a>
                    </div>
                    <div class="col-md-1">
                        <a href="" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="{{ __('Rebuild') }}"><i class="fa fa-refresh"></i></a>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="user_list_table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>{{ __('ID #') }}</th>
                            <th>{{ __('Medicine Name') }}</th>
                            <th>{{ __('Symptom') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('Qty') }}</th>
                            <th>{{ __('Created By') }}</th>
                            <th>{{ __('Allowed buy') }}</th>
                            <th>{{ __('Avg Rate') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php $medicines = $data['medicines'] ?>

                        @foreach($medicines as $medicine)
                            <tr>
                                <td>
                                    <span>{{ $medicine->id }}</span>
                                </td>
                                <td>
                                    <span>{{ $medicine->name }}</span>
                                </td>
                                <td>
                                    <span>{{ $medicine->symptom }}</span>
                                </td>
                                <td>
                                    <span>
                                        {{ App\Helpers\Helper::formatPrice($medicine->price) }}
                                    </span>
                                </td>
                                <td>
                                    {{ $medicine->quantity }}
                                </td>
                                <td>
                                    <span>{{ $medicine->getCreatedUser->display_name }}</span>
                                </td>
                                <td>
                                    <span>{{ $data['optionAlowedBuy'][$medicine->allowed_buy] }}</span>
                                </td>
                                <td>
                                    <span>{{ $medicine->avg_rate }}</span>
                                </td>
                                <td class="text-right">
                                    {!! Form::open(['route' =>['medicine.destroy', $medicine->id], 'method' => 'DELETE']) !!}
                                        <span class="text-right">
                                            <a href="{{ route('medicine.edit', [$medicine->id]) }}" data-toggle="tooltip" class="btn btn-primary" data-original-title="{{ __('Edit') }}">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        </span>
                                        <a href="javascript:void(0)" data-text="{{ __('Do you want to delete?') }}" data-toggle="tooltip" class="btn btn-danger" onclick="confirmButtonBeforeSubmit(this)" data-original-title="{{ __('Delete') }}">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $medicines->links() }}
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
@endsection
