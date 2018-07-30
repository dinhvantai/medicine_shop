@extends('admin.layouts.admin-layout')

@section('pageAdminTitle', __('List Categories'))

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ __('Categories') }}
        <small>{{ __('List') }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!! url('admin') !!}"><i class="fa fa-dashboard"></i>{{ __('Home') }}</a></li>
        <li class="active">{{ __('List Categories') }}</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="col-md-10">
                        <h3 class="box-title">{{ __('List Categories') }}</h3>
                    </div>
                    <div class="col-md-1 text-right">
                        <a href="{!! route('category.create') !!}" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="{{ __('Add New Parent Category') }}"><i class="fa fa-plus"></i></a>
                    </div>
                    <div class="col-md-1">
                        <a href="" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="{{ __('Rebuild') }}"><i class="fa fa-refresh"></i></a>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?php $categories = $data['categories']; ?>
                    @foreach ($categories as $category)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <a href="{{ url($category->link) }}" target="_blank">
                                            <span class="label label-info">
                                                {{ $category->name }}
                                            </span>
                                            <span class"padding-left-10px">
                                                {{ url($category->link) }}
                                            </span>
                                        </a>
                                    </div>
                                    <div class="col-sm-3 text-right">
                                        {!! Form::open(['route' => ['category.destroy', $category->id], 'method' => 'DELETE']) !!}
                                            <span class="text-right">
                                                <a href="{!! url('admin/category/'. $category->id .'/create') !!}" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="{{ __('Add New Children Category') }}"><i class="fa fa-plus"></i></a>
                                            </span>
                                            <span class="text-right">
                                                <a href="{{ route('category.edit', [$category->id]) }}" data-toggle="tooltip" class="btn btn-primary" data-original-title="{{ __('Edit') }}">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                            </span>
                                            <a data-toggle="tooltip" class="btn btn-danger"
                                             href="javascript:void(0)" data-text="{{ __('Do you want to delete?') }}" data-toggle="tooltip" class="btn btn-danger" onclick="confirmButtonBeforeSubmit(this)"
                                                data-original-title="{{ __('Delete') }}">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <ul class="list-group">
                                    @foreach ($category->children as $children)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-sm-9">
                                                    <a href="{{ url($category->link.'/'.$children->link) }}" target="_blank">
                                                        <span class="label label-warning">
                                                            {{ $children->name }}
                                                        </span>
                                                        <span class="padding-left-10px">
                                                            {{ url($category->link.'/'.$children->link) }}
                                                        </span>
                                                    </a>
                                                </div>
                                                <div class="col-sm-3 text-right">
                                                    {!! Form::open(['route' => ['category.destroy', $children->id], 'method' => 'DELETE']) !!}
                                                        <span class="text-right">
                                                            <a href="{{ route('category.edit', [$children->id]) }}" data-toggle="tooltip" class="btn btn-primary" data-original-title="{{ __('Edit') }}">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                        </span>
                                                        <a href="javascript:void(0)" data-text="{{ __('Do you want to delete?') }}" data-toggle="tooltip" class="btn btn-danger" onclick="confirmButtonBeforeSubmit(this)" data-original-title="{{ __('Delete') }}">
                                                            <i class="fa fa-trash-o"></i>
                                                        </a>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                    @if (count($category->children) == 0)
                                        <div class="text-center">
                                            {{ __('No sub category') }}
                                        </div>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    @endforeach
                    {{ $data['categoryParents']->links() }}
                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
@endsection
