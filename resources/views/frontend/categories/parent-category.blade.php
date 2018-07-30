@extends('frontend.layouts.master')

@section('title', $parentCategory->name)

@section('content')
<!-- Media Container -->
<div class="media-container media2">
    <!-- For best results use an image with a resolution of 2560x279 pixels -->
    <div class="container banner-title">
        <h1 class="text-center animation-slideDown"><strong>{{ $parentCategory->name }}</strong></h1>
    </div>
    <img src="{{ asset('/images/mountain.jpg') }}" alt="Image" class="media-image animation-pulseSlow">
</div>
<!-- END Media Container -->
<section class="site-content site-section">
    {{-- Slide products --}}

    {{-- End slide --}}
    @include('frontend.components.site-block-submenu')

    <div class="row portfolio">
        @include('frontend.components.item')

        <div class="text-center">
            {{ $items->links() }}
        </div>
    </div>

    {{-- Slide --}}
    <h2 class="site-heading"><strong>{{ __('Newest') }}</strong> {{ __('Medicines') }}</h2>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="Carousel" class="carousel slide">

                    <ol class="carousel-indicators">
                        <li data-target="#Carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#Carousel" data-slide-to="1"></li>
                        <li data-target="#Carousel" data-slide-to="2"></li>
                    </ol>
                    
                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        @include('frontend.components.slide-logicexcecute')
                        
                    </div><!--.carousel-inner-->
                </div><!--.Carousel-->

            </div>
        </div>


        <!-- END Slide -->
    </div>
</section>
@endsection
