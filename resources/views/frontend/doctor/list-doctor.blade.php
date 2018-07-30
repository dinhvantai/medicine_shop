@extends('frontend.layouts.master')

@section('title', __('Doctors List'))

@section('content')
<!-- Media Container -->
<div class="media-container media2">
    <!-- For best results use an image with a resolution of 2560x279 pixels -->
    <div class="container banner-title">
        <h1 class="text-center animation-slideDown"><strong>{{ __('Doctors List') }}</strong></h1>
        <h3 class="h3 animation-slideUp text-center">
            <strong id="doctor-count-doctor"></strong>
            {{ __('doctors') }}!
        </h3>
    </div>
    <img src="{{ asset('/images/mountain.jpg') }}" alt="Image" class="media-image animation-pulseSlow">
</div>
<!-- END Media Container -->

<section class="site-content site-section" id="doctor-area-list">
    <div class="container">
        <div class="row">

            <!-- Products -->
            <div class="col-sm-12">
                <div class="push-bit clearfix">
                    <!-- Refine Search -->
                    
                    
                    <div class="col-sm-4 pull-right form-horizontal">
                        {!! Form::text('doctor', '', ['class' => 'form-control', 'placeholder' => __('Search by name, specialty, place of work ...'), 'data-bind' => 'event: {keyup: keyupDoctorSeach}']) !!}
                    </div>
                    <!-- END Refine Search -->
                </div>
                
                <div class="row position-relative">

                    <div class="indicator hide" id="doctor-list-indicator">
                        <div class="spinner"></div>
                    </div>

                    <div data-bind="foreach: doctorDataArray">
                        <div class="col-sm-3">
                            <!-- Customer Info Block -->
                            <div class="block">
                                <!-- Customer Info Title -->
                                <div class="block-title">
                                    <h4>
                                        <a data-bind="attr:{href: $root.getLinkProfileUser(id, display_name)}">
                                            <i class="fa fa-user-md"></i>
                                            <strong data-bind="text: display_name"></strong>
                                        </a>
                                    </h4>
                                </div>
                                <!-- END Customer Info Title -->

                                <!-- Customer Info -->
                                <div class="block-section text-center doctor-wrap">
                                    <a data-bind="attr:{href: $root.getLinkProfileUser(id, display_name)}">
                                        <img class="img-circle" data-bind="attr: {src: $root.getLinkAvatarUser(avatar)}">
                                    </a>
                                    <div class="quick-view" data-toggle="modal" data-target="#doctor-show-detail" data-bind="click: $root.viewDetailDoctor">
                                        <a>
                                            <i class="fa fa-eye"></i>
                                            {{ __('Quick view') }}
                                        </a>
                                    </div>
                                </div>

                                <div class="table table-borderless table-vcenter">
                                    <p class="doctor-info-p">
                                        <span class="label label-warning text-right">{{ __('Specialize') }}</span>
                                        <span data-bind="text: specialize"></span>
                                    </p>
                                    <p class="doctor-info-p">
                                        <span class="label label-warning text-right">{{ __('Experience') }}</span>
                                        <span data-bind="text: experience"></span>
                                    </p>
                                </div>
                                <!-- END Customer Info -->
                            </div>
                            <!-- END Customer Info Block -->

                        </div>
                    </div>
                    <div data-bind="if: doctorDataArray().length == 0">
                        <div class="alert alert-danger alert-dismissible text-center">
                            {{ __('No doctor') }}
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
            <!-- END Products -->
            </div>
        </div>
    </div>

    <div class="modal fade" id="doctor-show-detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('Close') }}"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" data-bind="text: doctorDetail().display_name"></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <strong>{{ __('Specialize') }}:</strong>
                            <span data-bind="text: doctorDetail().specialize"></span>
                        </div>
                        <div class="col-sm-6">
                            <strong>{{ __('Experience') }}:</strong>
                            <span data-bind="text: doctorDetail().experience"></span>
                        </div>
                    </div><hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <strong>{{ __('Gender') }}:</strong>
                            <span data-bind="text: getLabelGender(doctorDetail().gender)"></span>
                        </div>
                        <div class="col-sm-6">
                            <strong>{{ __('Birthday') }}:</strong>
                            <span data-bind="text: doctorDetail().birthday"></span>
                        </div>
                    </div><hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <strong>{{ __('Certificate') }}:</strong>
                            <span data-bind="text: doctorDetail().certificate"></span>
                        </div>
                        <div class="col-sm-6">
                            <strong>{{ __('Workplace') }}:</strong>
                            <span data-bind="text: doctorDetail().workplace"></span>
                        </div>
                    </div><hr/>
                    <div class="row">
                        <div class="col-sm-12">
                            <strong>{{ __('Short Describe') }}:</strong>
                            <span data-bind="text: doctorDetail().about_you"></span>
                        </div>
                    </div><hr/>
                    <div class="row">
                        <div class="col-sm-6">
                            <strong>{{ __('Address') }}:</strong>
                            <span data-bind="text: doctorDetail().address"></span>
                        </div>
                        <div class="col-sm-6">
                            <strong>{{ __('Phone') }}:</strong>
                            <span data-bind="text: doctorDetail().phone"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('custom-javascript')
<script src="{!! url('js/frontend/doctor-list.js') !!}"></script>
<script>
    var genderOption = {!! json_encode($genderOption) !!};
    ko.applyBindings(
        new DoctorListViewModel().initData(genderOption),
        document.getElementById('doctor-area-list')
    );
</script>
@endsection
