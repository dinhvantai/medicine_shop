@extends('frontend.layouts.master')

@section('title', __('Search Medicine'))

@section('content')
<section class="site-section site-section-light site-section-top themed-background-dark">
    <div class="container text-center">
        <h1 class="animation-slideDown">
            <p>
                {{ __('Search results for keywords:') }}
                {{ ' "' . $keyword . '"' }}
            </p>
        </h1>
    </div>
</section>
<section class="site-content site-section padding-15px">
    <div class="container">
    
        @include('frontend.components.item')
                        
        @if (count($items) == 0)
            <div class="text-center v-x2-padding">
                {{ __('No Item') }}
            </div>
        @endif

        <div class="text-center">
            {{ $items->appends(['keyword' => $keyword])->links() }}
        </div>
        
    </div>
</section>
@endsection
