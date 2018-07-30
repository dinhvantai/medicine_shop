@extends('frontend.layouts.master')

@section('title', __('Prescription List'))

@section('content')
<section class="site-section site-section-light site-section-top themed-background-dark">
    <div class="container text-center">
        <h1 class="animation-slideDown">
            <i class="fa fa-medkit"></i>
            <strong>{{ __('Prescription List') }}</strong>
        </h1>
    </div>
</section>
<div class="content position-relative" id="area-prescription-list">

    @include('frontend.components.show-message')

    <div class= "row">
        <div class="panel panel-success">
            <div class="panel-heading text-center">
                <div class="row padding-15px">
                    <div class="col-sm-11">
                        <h3 class="panel-title">{{ __('Prescription List') }}</h3>
                    </div>
                    <div class="col-sm-1">
                        <a href="{{ route('frontend.prescription.addnew') }}" class="btn btn-primary" data-toggle="tooltip" title="{{ __('Add New Prescription') }}">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="panel-body position-relative">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr class="warning">
                            <th>{{ __('ID #') }}</th>
                            <th>{{ __('Prescription Name') }}</th>
                            <th>{{ __('Created By') }}</th>
                            <th>{{ __('Created At') }}</th>
                            <th>{{ __('Updated At') }}</th>
                            <th class="text-center">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody data-bind="foreach: prescriptionDataArray">
                        <tr>
                            <td>
                                <span data-bind="text: id"></span>
                            </td>
                            <td>
                                <span data-bind="text: name_prescription"></span>
                            </td>
                            <td>
                                <!-- ko ifnot: doctor_id -->
                                    <span>{{ __('Yourself') }}</span>
                                <!-- /ko -->
                                <!-- ko if: doctor_id -->
                                    <span>{{ __('Doctor') }}:</span>
                                    <a target="_blank" data-bind="text: get_doctor.display_name, attr:{href: '/user/' + get_doctor.id + '/' + str_slug(get_doctor.display_name)}"></a>
                                <!-- /ko -->
                            </td>
                            <td>
                                <span data-bind="text: created_at"></span>
                            </td>
                            <td>
                                <span data-bind="text: updated_at"></span>
                            </td>
                            <td class="text-right">
                                {!! Form::open(['url' => '/', 'method' => 'DELETE', 'data-bind' => 'attr:{action: "/prescription/" + id}']) !!}
                                    <span class="text-right" data-toggle="modal" data-target="#showDetailPrescription" data-bind="click: $root.viewDetailPrescription">
                                        <a href="#" class="btn btn-primary" data-toggle="tooltip" title="{{ __('View Detail') }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </span>
                                    <!-- ko ifnot: (doctor_id && doctor_id != user_id) -->
                                        <span class="text-right">
                                            <a href="#" data-toggle="tooltip" class="btn btn-primary" data-toggle="tooltip" title="{{ __('Edit') }}" data-bind="attr:{href: '/prescription/' + id + '/edit'}">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        </span>
                                    <!-- /ko -->
                                    <a data-text="{{ __('Do you want to delete?') }}" data-toggle="tooltip" class="btn btn-danger" onclick="confirmButtonBeforeSubmit(this)" title="{{ __('Delete') }}">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    </tbody>
                    <tbody data-bind="if: prescriptionDataArray().length === 0">
                        <tr>
                            <td colspan="7" class="text-center">
                                {{ __('No Prescription') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="indicator hide">
                    <div class="spinner"></div>
                </div>
            </div>
            <div class="col-sm-12 text-center">
                <ul class="pagination">
                    <li data-bind="if: currentPage() > 1">
                        <a href="javascript:void(0)" data-bind="click: prePage"><i class="fa  fa-angle-double-left"></i></a>
                    </li>
                    <li class="active" data-bind="if: totalPage() > 0">
                        <a href="javascript:void(0)" data-bind="text: currentPage() + '/' + totalPage()">
                        </a>
                    </li>
                    <li data-bind="if: currentPage() < totalPage()">
                        <a href="javascript:void(0)" data-bind="click: nextPage"><i class="fa  fa-angle-double-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- ko if: (prescriptionDetail()) -->
        <div class="modal fade" id="showDetailPrescription" tabindex="-1" role="dialog" aria-labelledby="detailPrescriptionLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center" id="detailPrescriptionLabel">{{ __('Detail Prescription') }}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="panel panel-info">
                            <div class="panel-heading well">
                                <h3 class="panel-title text-center">
                                    <span>{{ __('Prescription Name') }} : </span>
                                    <strong data-bind="text: prescriptionDetail().name_prescription"></strong>
                                </h3>
                            </div>
                            <div class="panel-body">
                                <div class="row well">
                                    <div class="col-sm-6">
                                        <span class="">{{ __('Created By') }} : </span>
                                        <!-- ko ifnot: prescriptionDetail().doctor_id -->
                                            <strong>{{ __('Yourself') }}</strong>
                                        <!-- /ko -->
                                        <!-- ko if: prescriptionDetail().doctor_id -->
                                            <span>{{ __('Doctor') }} : </span>
                                            <strong>
                                                <a target="_blank" data-bind="text: prescriptionDetail().get_doctor.display_name, attr:{href: '/user/' + prescriptionDetail().get_doctor.id + '/' + str_slug(prescriptionDetail().get_doctor.display_name)}"></a>
                                            </strong>
                                        <!-- /ko -->
                                    </div>
                                    <div class="col-sm-6">
                                        <span>{{ __('Created At') }} : </span>
                                        <strong data-bind="text: prescriptionDetail().created_at"></strong>
                                    </div>
                                </div>
                                <div class="row well">
                                    <div class="col-sm-12">
                                        <strong>{{ __('Diagnose') }} : </strong>
                                        <span data-bind="text: prescriptionDetail().diagnose"></span>
                                    </div>
                                </div>
                                <div class="row well">
                                    <div class="col-sm-12">
                                        <strong>{{ __('Guide') }} : </strong>
                                        <span data-bind="text: prescriptionDetail().guide"></span>
                                    </div>
                                </div>
                                <div class="row padding-15px">
                                    <div class="col-sm-12">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <td colspan="5" class="text-center success">
                                                        {{ __('Items List') }}
                                                    </td>
                                                </tr>
                                                <tr class="info">
                                                    <th>{{ __('ID #') }}</th>
                                                    <th>{{ __('Medicine Name') }}</th>
                                                    <th>{{ __('Amout') }}</th>
                                                    <th>{{ __('Status') }}</th>
                                                    <th>{{ __('Created At') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody data-bind="foreach: prescriptionDetail().get_all_item_prescriptions">
                                                <tr>
                                                    <td>
                                                        <span data-bind="text: id"></span>
                                                    </td>
                                                    <td>
                                                        <span data-bind="text: name_medicine"></span>
                                                    </td>
                                                    <td>
                                                        <span data-bind="text: amount"></span>
                                                        <!-- ko if: medicine_id -->
                                                            <span data-bind="text: get_medicine.unit"></span>
                                                        <!-- /ko -->
                                                        <span> / {{ __('day') }}</span><br/>
                                                        <!-- ko if: qty_purchased -->
                                                            <span>{{ __('Uses in')  }}</span>
                                                            <span data-bind="text: qty_purchased"></span>
                                                            <span>{{ __('day') }}</span>
                                                        <!-- /ko -->
                                                    </td>
                                                    <td>
                                                        <span data-bind="text: $parent.statusItem[status]"></span>
                                                    </td>
                                                    <td>
                                                        <span data-bind="text: created_at"></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td colspan="5">
                                                        <strong>{{ __('Instruction') }} :</strong>
                                                        <span data-bind="text: guide"></span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            
                                            <tbody data-bind="if: prescriptionDetail().get_all_item_prescriptions.length === 0">
                                                <tr>
                                                    <td colspan="5" class="text-center">
                                                        {{ __('No Item') }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer text-right">
                                <a class="btn btn-primary" data-toggle="tooltip" title="" data-original-title="{{ __('Convert Prescription to Order.') }}" data-bind="attr:{href: '/convert-prescription/'+ prescriptionDetail().id +'/order'}">
                                    <i class="fa fa-share-square-o"></i>
                                    {{ __('Convert Prescription to Order.') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- /ko -->
</div>

@endsection

@section('custom-javascript')
<script src="{!! url('js/frontend/prescrition.js') !!}"></script>
<script>
    @php
        $optionStatusItem = App\Eloquent\ItemPrescription::getOptionStatus();
    @endphp
    
    var statusOption = {!! json_encode($optionStatusItem) !!};
    ko.applyBindings(
        new PrescriptionViewModel().initData(statusOption),
        document.getElementById('area-prescription-list')
    );
</script>
@endsection
