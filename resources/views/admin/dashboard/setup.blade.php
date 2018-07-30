@extends('admin.layouts.admin-layout')

@section('pageAdminTitle', __('Setup Website'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ __('Setup Website') }}</h1>
    <ol class="breadcrumb">
        <li><a href="{!! url('admin') !!}"><i class="fa fa-dashboard"></i>{{ __('Home') }}</a></li>
        <li class="active">{{ __('Setup Website') }}</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="col-md-10">
                        <h3 class="box-title">{{ __('Setup Website') }}</h3>
                    </div>
                    <div class="col-md-2 text-right">
                        {!! Form::button(__('Save'), ['type' => 'submit', 'form' => 'setup-website', 'data-toggle' => 'tooltip', 'class' => 'btn btn-primary', 'data-original-title' => __('Save')]) !!}

                        <a href="{!! url('admin') !!}" data-toggle="tooltip" class="btn btn-default" data-original-title="{{ __('Cancel') }}">
                            <i class="fa fa-reply"></i>
                        </a>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    {!! Form::open(['route' => 'admin.setup', 'id' => 'setup-website', 'class' => 'form-horizontal', 'method' => 'post', 'files' => 'true']) !!}

                        <div class="form-group">
                            <div class="col-sm-6">
                                {!! Form::label('title', __('Title'), ['class' => 'col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('title', $setup->title, ['class' => 'form-control', 'placeholder' => __('Title')]) !!}
                                    <span class="text-danger">{!! $errors->first('title') !!}</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                {!! Form::label('slogan', __('Slogan'), ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('slogan', $setup->slogan, ['class' => 'form-control', 'placeholder' => __('Slogan')]) !!}
                                    <span class="text-danger">{!! $errors->first('slogan') !!}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            @php
                                $options = json_decode($setup->options, true);
                                $ordered = isset($options['ordered_out_stock']) ? $options['ordered_out_stock'] : config('custom.order.ordered_out_stock');
                                $emailContact = isset($options['contact_email']) ? $options['contact_email'] : config('custom.contact.default_email');
                            @endphp
                            <div class="col-sm-6">
                                {!! Form::label('ordered_out_stock', __('Ordered Out Stock'), ['class' => 'col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::select('ordered_out_stock', $optionOrdered, $ordered, ['class' => 'form-control']) !!}
                                    <span class="text-danger">{!! $errors->first('ordered_out_stock') !!}</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                {!! Form::label('contact_email', __('Email recieve Contact'), ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('contact_email', $emailContact, ['class' => 'form-control', 'placeholder' => __('Email recieve Contact')]) !!}
                                    <span class="text-danger">{!! $errors->first('contact_email') !!}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('logo', __('Logo'), ['class' => 'col-sm-2 control-label']) !!}
                            @if ($setup->logo)
                                <div class="col-sm-3">
                                    <img src="{{ url($setup->logo) }}" alt="{{ $setup->title }}" class="img-responsive">
                                </div>
                                <div class="col-sm-2"></div>
                                <div class="col-sm-5">
                            @else
                                <div class="col-sm-10">
                            @endif
                                {!! Form::file('logo', ['class' => 'form-control']) !!}
                                <span class="text-danger">{!! $errors->first('logo') !!}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('title', __('Link Communication'), ['class' => 'col-sm-1 control-label']) !!}
                            <div class="col-sm-1 control-label">
                                <a href="#" data-toggle="tooltip" class="btn btn-primary" data-original-title="{{ __('Add New Link') }}" data-bind="click: addNewOption">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                            <div class="col-sm-10 control-label" data-bind="foreach: objectLinks">
                                <div class="row form-group">
                                    <div class="input-group col-sm-5 pull-left">
                                        <span class="input-group-addon">{{ __('Keyword') }}</span>
                                        {!! Form::text('keyword[]', '', ['data-bind' => 'value: key', 'class' => 'form-control']) !!}
                                        <span class="text-danger">{!! $errors->first('keyword.*') !!}</span>
                                    </div>
                                    <div class="col-sm-1"></div>
                                    <div class="input-group col-sm-5 pull-left">
                                        <span class="input-group-addon">{{ __('Link') }}</span>
                                        {!! Form::text('link[]', '', ['data-bind' => 'value: link', 'class' => 'form-control']) !!}
                                        <span class="text-danger">{!! $errors->first('link.*') !!}</span>
                                    </div>
                                    <div class="col-sm-1 pull-left">
                                        <a href="#" data-toggle="tooltip" class="btn btn-danger" data-bind="click: $root.removeOption">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            {!! Form::label('footer', __('Footer'), ['class' => 'col-sm-1 control-label']) !!}
                            <div class="col-sm-11">
                                {!! Form::textarea('footer', $setup->footer, ['class' => 'form-control', 'placeholder' => __('Footer')]) !!}
                                <span class="text-danger">{!! $errors->first('footer') !!}</span>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
@endsection

@section('javascript')
<script src="{!! url('js/admin/admin-setup.js') !!}"></script>
<script type="text/javascript">
    showTinyWithFileManager('#footer');

    @php
        $links = [];
        if ($setup->link_communications) $links = json_decode($setup->link_communications, true);
    @endphp
    var data = [
        @foreach ($links as $key => $value)
            {!! 'new objectLinkViewModel().objectLink("' . addslashes($key) . '", "' . addslashes($value) . '"),' !!}
        @endforeach
    ];
    var textConfirm = '{{ __('Are you delete?') }}';

    ko.applyBindings(new objectLinkViewModel().initData(data, textConfirm));
</script>
@endsection
