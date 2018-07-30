@extends('frontend.layouts.master')

@section('title', __('Request Prescription List'))

@section('content')
<section class="site-section site-section-light site-section-top themed-background-dark">
    <div class="container text-center">
        <h1 class="animation-slideDown">
            <p><strong>{{ __('Request Prescription List') }}</strong></p>
        </h1>
    </div>
</section>
<section class="site-content site-section padding-15px">
    <div class="container">
        
        @include('frontend.components.show-message')

        <div class="row">
            <div class="col-sm-12 padding-15px">
                <a href="{!! route('request-prescription.addnew') !!}" class="btn btn-primary" data-toggle="tooltip" title="{{ __('Add New Request Prescription') }}">
                    <i class="fa fa-plus"></i>
                    {{ __('Add New Request Prescription') }}
                </a>
            </div>
            <div class="col-xs-12" id="frontend-area-request-prescition">
                <div class="row store-items">
                    @forelse ($requestPrescriptions as $requestPrescription)

                        @php
                            $imagesCollection = $requestPrescription->getAllImages();
                            $image = $imagesCollection->orderBy('is_main', 'desc')->first();
                            $image_show = config('custom.medicine.image_default'); //default Image
                            if ($image) $image_show = $image->path_origin;
                        @endphp

                        <div class="col-md-3 animation-fadeInQuick" data-toggle="animation-appear" data-animation-class="animation-fadeInQuick" data-element-offset="-100">
                            <div class="store-item">
                                <div class="store-item-image">
                                    <span data-toggle="modal" data-id="{{ $requestPrescription->id }}" data-target="#showDetailRequestPrescription" data-bind="click: viewDetailRequestPrescription">
                                        <img src="{{ url($image_show) }}" data-id="{{ $requestPrescription->id }}" alt="{{ $requestPrescription->title }}" class="img-responsive">
                                    </span>
                                </div>
                                <div class="store-item-info clearfix">
                                    
                                    <a href="javascript:void(0)">
                                        <strong>{{ str_limit($requestPrescription->title, 25) }}</strong>
                                    </a><br>
                                    <div class="row">
                                        <ul class="list-inline pull-left margin-top-5px col-sm-12">
                                            <li class="col-sm-12">
                                                <i class="fa fa-calendar"></i>
                                                {{ date_format($requestPrescription->created_at, 'F d, Y') }}
                                            </li>
                                            <li class="col-sm-12">
                                                <a href="javascript:void(0)">
                                                    <i class="fa fa-stethoscope"></i>
                                                    {{ __(':number prescriptions', 
                                                        ['number' => $requestPrescription->getAllPrescription()->count()]) 
                                                    }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-12 animation-fadeInQuick text-center" data-toggle="animation-appear" data-animation-class="animation-fadeInQuick" data-element-offset="-100">
                            <div class="alert alert-danger alert-dismissible">
                                {{ __('No prescription required') }}
                            </div>
                        </div>
                    @endforelse
                </div>
                <!-- Pagination -->
                <div class="text-center">
                    {{ $requestPrescriptions->links() }}
                </div>
                <!-- END Pagination -->
                
                <!-- Detail Request -->
                <div class="modal fade" id="showDetailRequestPrescription" tabindex="-1" role="dialog" aria-labelledby="detailPrescriptionLabel">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title text-center" id="detailPrescriptionLabel">
                                    {{ __('Detail Request Prescription') }}
                                </h4>
                            </div>
                            <div class="modal-body">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title text-center">
                                            <span data-bind="text: data().title"></span>
                                        </h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row well well-sm">
                                            <div class="col-sm-12">
                                                <span data-bind="text: data().describer"></span>
                                            </div>
                                        </div>
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
    <script src="{!! url('js/frontend/request-prescription.js') !!}"></script>
    <script type="text/javascript">
        ko.applyBindings(
            new RequestPrescriptionViewModel(),
            document.getElementById('frontend-area-request-prescition')
        );
    </script>
@endsection
