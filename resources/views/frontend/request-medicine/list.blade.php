@extends('frontend.layouts.master')

@section('title', __('Request Medicine List'))

@section('content')
<section class="site-section site-section-light site-section-top themed-background-dark">
    <div class="container text-center">
        <h1 class="animation-slideDown">
            <p><strong>{{ __('Request Medicine List') }}</strong></p>
        </h1>
    </div>
</section>
<section class="site-content site-section padding-15px">
    <div class="container">
        
        @include('frontend.components.show-message')

        <div class="row">
            <div class="col-sm-12 padding-15px">
                <a href="{!! route('frontend.request-medicine.addnew') !!}" class="btn btn-primary" data-toggle="tooltip" title="{{ __('Add New Request Medicine') }}">
                    <i class="fa fa-plus"></i>
                    {{ __('Add New Request Medicine') }}
                </a>
            </div>
            <div class="col-xs-12" id="frontend-area-request-medicine">
                <div class="row store-items">
                    @forelse ($requestMedicines as $requestMedicine)

                        @php
                            $imagesCollection = $requestMedicine->getAllImages();
                            $image = $imagesCollection->orderBy('is_main', 'desc')->first();
                            $image_show = config('custom.medicine.image_default'); //default Image
                            if ($image) $image_show = $image->path_origin;
                        @endphp

                        <div class="col-md-3 animation-fadeInQuick" data-toggle="animation-appear" data-animation-class="animation-fadeInQuick" data-element-offset="-100">
                            <div class="store-item">
                                <div class="store-item-image">
                                    <span data-toggle="modal" data-id="{{ $requestMedicine->id }}" data-target="#showDetailRequestPrescription" data-bind="click: viewDetailRequestMedicine">
                                        <img src="{{ url($image_show) }}" data-id="{{ $requestMedicine->id }}" alt="{{ $requestMedicine->medicine_name }}" class="img-responsive">
                                    </span>
                                </div>
                                <div class="store-item-info clearfix">
                                    
                                    <a href="javascript:void(0)">
                                        <strong>{{ str_limit($requestMedicine->medicine_name, 25) }}</strong>
                                    </a><br>
                                    <div class="row">
                                        <ul class="list-inline pull-left margin-top-5px col-sm-12">
                                            <li class="col-sm-12">
                                                <i class="fa fa-calendar"></i>
                                                {{ date_format($requestMedicine->created_at, 'F d, Y') }}
                                            </li>
                                            <li class="col-sm-12">
                                                {{ __('Status') }} :
                                                @if ($requestMedicine->status == App\Eloquent\RequestMedicine::STATUS_NOT_SEEN)
                                                    <span class="text-success">
                                                        <i class="fa fa-envelope"></i>
                                                        {{ $optionStatus[$requestMedicine->status] }}
                                                    </span>
                                                @endif

                                                @if ($requestMedicine->status == App\Eloquent\RequestMedicine::STATUS_WATCHED)
                                                    <span class="text-primary">
                                                        <i class="fa fa-eye-slash"></i>
                                                        {{ $optionStatus[$requestMedicine->status] }}
                                                    </span>
                                                @endif

                                                @if ($requestMedicine->status == App\Eloquent\RequestMedicine::STATUS_HAS_RESPONDED)
                                                    <span class="text-danger">
                                                        <i class="fa fa-reply"></i>
                                                        {{ $optionStatus[$requestMedicine->status] }}
                                                    </span>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-12 animation-fadeInQuick text-center" data-toggle="animation-appear" data-animation-class="animation-fadeInQuick" data-element-offset="-100">
                            <div class="alert alert-danger alert-dismissible">
                                {{ __('No medicine required') }}
                            </div>
                        </div>
                    @endforelse
                </div>
                <!-- Pagination -->
                <div class="text-center">
                    {{ $requestMedicines->links() }}
                </div>
                <!-- END Pagination -->
                
                <!-- Detail Request -->
                <div class="modal fade" id="showDetailRequestPrescription" tabindex="-1" role="dialog" aria-labelledby="detailPrescriptionLabel">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title text-center" id="detailPrescriptionLabel">
                                    {{ __('Detail Request Medicine') }}
                                </h4>
                            </div>
                            <div class="modal-body">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title text-center">
                                            <span data-bind="text: data().medicine_name"></span>
                                        </h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row well well-sm">
                                            <div class="col-sm-12">
                                                <span class="label label-warning">
                                                    {{ __('Short Describe') }}
                                                </span> 
                                                <span data-bind="text: data().short_describer"></span>
                                            </div>
                                        </div>
                                        <!-- ko if: data().respone_admin -->
                                            <div class="row well well-sm" data-bind="">
                                                <div class="col-sm-12">
                                                    <span class="label label-warning">
                                                        {{ __('Respone By Admin') }}
                                                    </span> 
                                                    <span data-bind="text: data().respone_admin"></span>
                                                </div>
                                            </div>
                                        <!-- /ko -->

                                        <!-- ko if: data().get_all_images.length != 0 -->
                                            <div class="row well well-sm" data-bind="foreach: data().get_all_images">
                                                <div class="col-sm-3">
                                                    <img data-bind="attr:{ src:'/' + path_origin }" class="img-thumbnail">
                                                </div>
                                            </div>
                                        <!-- /ko -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Detail -->

            </div>
        </div>
    </div>
</section>
@endsection

@section('custom-javascript')
    <script src="{!! url('js/frontend/request-medicine.js') !!}"></script>
    <script type="text/javascript">
        ko.applyBindings(
            new RequestMedicineViewModel(),
            document.getElementById('frontend-area-request-medicine')
        );
    </script>
@endsection
