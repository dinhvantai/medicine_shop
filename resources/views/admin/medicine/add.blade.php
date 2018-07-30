@extends('admin.layouts.admin-layout')

@section('pageAdminTitle', __('Add New Medicine'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ __('Add New Medicine') }}</h1>
    <ol class="breadcrumb">
        <li><a href="{!! url('admin') !!}"><i class="fa fa-dashboard"></i>{{ __('Home') }}</a></li>
        <li class="active">{{ __('New Medicine') }}</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="col-md-10">
                        <h3 class="box-title">{{ __('New Medicine') }}</h3>
                    </div>
                    <div class="col-md-2 text-right">
                        {!! Form::button(__('Save'), ['type' => 'submit', 'form' => 'add-new-medicine', 'data-toggle' => 'tooltip', 'class' => 'btn btn-primary', 'data-original-title' => __('Save')]) !!}

                        <a href="{!! route('medicine.index') !!}" data-toggle="tooltip" class="btn btn-default" data-original-title="{{ __('Cancel') }}">
                            <i class="fa fa-reply"></i>
                        </a>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    {!! Form::open(['route' => 'medicine.store', 'id' => 'add-new-medicine', 'class' => 'form-horizontal', 'method' => 'post', 'files' => 'true']) !!}

                        <div class="form-group">
                            <div class="col-sm-12">
                                {!! Form::label('name', __('Medicine Name'), ['class' => 'col-sm-1 control-label']) !!}
                                <div class="col-sm-11">
                                    {!! Form::text('name', '', ['class' => 'form-control', 'placeholder' => __('Medicine Name')]) !!}
                                    <span class="text-danger">{!! $errors->first('name') !!}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                {!! Form::label('price', __('Price'), ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="addon-medicine-price">
                                            {{ App\Helpers\Helper::getSymbolCurrency() }}
                                        </span>
                                        {!! Form::text('price', '', ['class' => 'form-control', 'placeholder' => __('Price'), 'aria-describedby' => 'addon-medicine-price']) !!}
                                    </div>
                                    <span class="text-danger">{!! $errors->first('price') !!}</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                {!! Form::label('quantity', __('Quantity'), ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-6">
                                    {!! Form::text('quantity', '', ['class' => 'form-control', 'placeholder' => __('Quantity')]) !!}
                                    <span class="text-danger">{!! $errors->first('quantity') !!}</span>
                                </div>
                                <div class="col-sm-4">
                                    {!! Form::text('unit', '', ['class' => 'form-control', 'placeholder' => __('Unit')]) !!}
                                    <span class="text-danger">{!! $errors->first('unit') !!}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                {!! Form::label('allowed_buy', __('Allowed buy'), ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">
                                    {{ Form::select('allowed_buy', $optionAlowedBuy, null, ['class' => 'form-control']) }}
                                    <span class="text-danger">{!! $errors->first('allowed_buy') !!}</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                {!! Form::label('made_in', __('Made in'), ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('made_in', '', ['class' => 'form-control', 'placeholder' => __('Made in')]) !!}
                                    <span class="text-danger">{!! $errors->first('made_in') !!}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                {!! Form::label('symptom', __('Symptom'), ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('symptom', '', ['class' => 'form-control', 'placeholder' => __('Symptom')]) !!}
                                    <span class="text-danger">{!! $errors->first('symptom') !!}</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                {!! Form::label('ingredient', __('Ingredient'), ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('ingredient', '', ['class' => 'form-control', 'placeholder' => __('Ingredient')]) !!}
                                    <span class="text-danger">{!! $errors->first('ingredient') !!}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                {!! Form::label('short_describer', __('Short Describer'), ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::textarea('short_describer', '', ['class' => 'form-control', 'placeholder' => __('Short Describer'), 'rows' => '3']) !!}
                                    <span class="text-danger">{!! $errors->first('short_describer') !!}</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                {!! Form::label('categories', __('Categories'), ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">
                                    {{ Form::select('categories[]', $allOptionCategories, null, ['multiple' => true, 'class' => 'form-control categories'])}}
                                    <span class="text-danger">{!! $errors->first('categories') !!}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                {!! Form::label('images', __('Images'), ['class' => 'col-sm-1 control-label']) !!}
                                <div class="col-sm-11">
                                    {!! Form::file('images[]', ['class' => 'form-control', 'multiple' => true]) !!}
                                    <span class="text-danger">{!! $errors->first('images.*') !!}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                {!! Form::label('guide', __('Guide'), ['class' => 'col-sm-1 control-label']) !!}
                                <div class="col-sm-11">
                                    {!! Form::textarea('guide', '', ['class' => 'form-control show-tinyeditor', 'placeholder' => __('Guide')]) !!}
                                    <span class="text-danger">{!! $errors->first('guide') !!}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                {!! Form::label('detail', __('Detail'), ['class' => 'col-sm-1 control-label']) !!}
                                <div class="col-sm-11">
                                    {!! Form::textarea('detail', '', ['class' => 'form-control show-tinyeditor', 'placeholder' => __('Detail')]) !!}
                                    <span class="text-danger">{!! $errors->first('detail') !!}</span>
                                </div>
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
<script type="text/javascript">
    $('.categories').select2();
    showTinyWithFileManager('.show-tinyeditor');
</script>
@endsection
