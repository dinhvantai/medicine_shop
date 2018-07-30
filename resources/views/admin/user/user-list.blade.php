@extends('admin.layouts.admin-layout')

@section('pageAdminTitle', __('List Users'))

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ __('User') }}
        <small>{{ __('List') }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!! url('admin') !!}"><i class="fa fa-dashboard"></i>{{ __('Home') }}</a></li>
        <li class="active">{{ __('List Users') }}</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="col-md-10">
                        <h3 class="box-title">{{ __('List Users') }}</h3>
                    </div>
                    <div class="col-md-1 text-right">
                        <a href="{!! url('admin/users/create') !!}" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="{{ __('Add New') }}"><i class="fa fa-plus"></i></a>
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
                            <th>{{ __('E-Mail Address') }}</th>
                            <th>{{ __('Display name') }}</th>
                            <th>{{ __('Permission') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php $users = $data['users'] ?>

                        @foreach($users as $user)
                            <tr>
                                <td>
                                    <span>{{ $user->id }}</span>
                                </td>
                                <td>
                                    <span>{{ $user->email }}</span>
                                </td>
                                <td>
                                    <span>{{ $user->display_name }}</span>
                                </td>
                                <td>
                                    <span>{{ $data['permissionOption'][$user->permission] }}</span>
                                </td>
                                <td>
                                    {!! Form::open(['route' =>['users.destroy', $user->id], 'method' => 'DELETE']) !!}
                                        <span class="text-right">
                                            <a href="{{ route('users.show', [$user->id]) }}" data-toggle="tooltip" class="btn btn-primary" data-original-title="{{ __('View Detail') }}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </span>
                                        <span class="text-right">
                                            <a href="{{ route('users.edit', [$user->id]) }}" data-toggle="tooltip" class="btn btn-primary" data-original-title="{{ __('Edit') }}">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        </span>
                                        @if ($user->id != Auth::user()->id)
                                            <a href="javascript:void(0)" data-text="{{ __('Do you want to delete?') }}" data-toggle="tooltip" class="btn btn-danger" onclick="confirmButtonBeforeSubmit(this)"data-original-title="{{ __('Delete') }}">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                        @endif
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
@endsection

@section('javascript')
<script lang="javascript">
    $(function() {
        $("#user_list_table").DataTable({
            "order": [[ 0, "desc" ]]
        });
    });
</script>
@endsection
