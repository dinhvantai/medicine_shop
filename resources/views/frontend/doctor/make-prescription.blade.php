@extends('frontend.layouts.master')

@section('title', __('Make Prescription for User'))

@section('content')
<div class="content position-relative" id="area-add-prescription">
    <div class= "row">
        <div class="panel panel-success">
            <div class="panel-heading text-center">
                <div class="row padding-15px">
                    <div class="col-sm-10">
                        <h3 class="panel-title">{{ __('Make Prescription for User') }}</h3>
                    </div>
                    <div class="col-sm-2 text-right">
                        <a href="{!! route('doctor-request-prescription.index') !!}" data-toggle="tooltip" class="btn btn-default" title="{{ __('Cancel') }}">
                            <i class="fa fa-reply"></i>
                        </a>
                        {!! Form::button(__('Save'), ['type' => 'submit', 'form' => 'add-new-prescription', 'data-toggle' => 'tooltip', 'class' => 'btn btn-primary', 'title' => __('Save')]) !!}
                    </div>
                </div>
            </div>

            <div class="panel-body col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">
                            <span>{{ $requestPrescription->title }}</span>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <img class="user-image" src="{{ App\Helpers\Helper::getLinkUserAvatar($requestPrescription->getUser->avatar) }}">
                                <a target="_blank" href="{{ route('frontend.user.different.profiles', [$requestPrescription->getUser->id, str_slug($requestPrescription->getUser->display_name)]) }}">
                                    {{ $requestPrescription->getUser->display_name }}
                                </a>
                            </div>
                            <div class="col-sm-12 padding-15px">
                                <span>{{ __('Gender') }} : </span>
                                <a>{{ $requestPrescription->getUser->genderLabel }}</a>
                            </div>
                        </div>
                        <div class="row well well-sm">
                            <div class="col-sm-12">
                                <span>{{ $requestPrescription->describer }}</span>
                            </div>
                        </div>
                        <div class="row well well-sm">
                            @foreach ($requestPrescription->getAllImages as $image)
                                <div class="col-sm-6">
                                    <img src="{{ url($image->path_origin) }}" class="img-thumbnail image-detail-prescription">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-body col-md-8">
                <div class="panel panel-info padding-15px">
                    {!! Form::open(['route' => ['frontend.doctor.prescription.store', $requestPrescription->id], 'id' => 'add-new-prescription', 'class' => 'form-horizontal', 'method' => 'post']) !!}

                        <div class="form-group">
                            {!! Form::label('name_prescription', __('Prescription Name'), ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('name_prescription', '', ['class' => 'form-control', 'placeholder' => __('Prescription Name'), 'required' => 'true']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('diagnose', __('Diagnose'), ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::textarea('diagnose', '', ['class' => 'form-control', 'rows' => '3', 'placeholder' => __('Diagnose')]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('guide', __('Guide'), ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::textarea('guide', '', ['class' => 'form-control', 'rows' => '3', 'placeholder' => __('Guide')]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('', __('Prescription Items'), ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-1 text-left">
                                <a href="#" data-toggle="tooltip" class="btn btn-primary" title="{{ __('Add New Item') }}" data-bind="click: addNewItem">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                            <div class="col-sm-8" data-bind="foreach: items">
                                <div class="row well">
                                    {!! Form::hidden('medicine_id[]', '',['class' => 'medicine-id', 'data-bind' => 'value: medicineId']) !!}
                                    <div class="col-sm-11 position-relative height-35px z-index-100">
                                        {!! Form::text('name_medicine[]', '', ['class' => 'form-control', 'placeholder' => __('Medicine Name'), 'required' => 'true', 'autocomplete' => 'off', 'data-bind' => 'value: medicineName, event:{keyup: findMedicineKeyup, focus: findMedicineKeyup}']) !!}
                                        <div class="col-sm-12 prescrition-search-item hide">
                                            <ul class="list-group" data-bind="foreach: resultFindMedicines">
                                                <li class="list-group-item" data-bind="text: name, event:{click: $parent.clickSelectedMedicine}">
                                                </li>
                                            </ul>
                                            <ul class="list-group" data-bind="if: resultFindMedicines().length == 0">
                                                <div class="text-center alert-danger cursor-pointer" data-bind="click: closeNotFoundMedicine">
                                                    {{ __('Medicine not found!') }}
                                                </div>
                                            </ul>
                                        </div>
                                        <div class="over-full-screen hide" id="over-medicine-full-screen" data-bind="click: closeNotFoundMedicine"></div>
                                    </div>
                                    <div class="col-sm-1 pull-left">
                                        <a href="#" data-toggle="tooltip" class="btn btn-danger" data-bind="click: $root.deleteItem" title="{{ __('Delete Item') }}">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </div>
                                    <div class="input-group col-sm-6 padding-15px padding-right-15px padding-left-15px pull-left">
                                        {!! Form::text('amount[]', '', ['class' => 'form-control', 'placeholder' => __('Amount per day'), 'required' => 'true', 'data-bind' => 'value: amout']) !!}
                                        <span class="input-group-addon" data-bind="text: unitMedicine"></span>
                                    </div>
                                    <div class="input-group col-sm-6 padding-15px padding-left-15px padding-right-15px pull-left">
                                        {!! Form::text('qty_purchased[]', '', ['class' => 'form-control', 'placeholder' => __('Time to use'), 'required' => 'true', 'data-bind' => 'value: qty_purchased']) !!}
                                        <span class="input-group-addon">{{ __('day') }}</span>
                                    </div>
                                    <div class="col-sm-12">
                                        {!! Form::textarea('item_guide[]', '', ['class' => 'form-control', 'placeholder' => __('How to use medicine.'), 'rows' => '2']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
     <div class="indicator hide">
        <div class="spinner"></div>
    </div>
</div>

@endsection

@section('custom-javascript')
<script src="{!! url('js/frontend/prescrition.js') !!}"></script>
<script>

    var data = [];
    ko.applyBindings(
        new AddPrescriptionViewModel().initData(data, '{{ __('Are you delete?')}}'),
        document.getElementById('area-add-prescription')
    );
</script>
@endsection
