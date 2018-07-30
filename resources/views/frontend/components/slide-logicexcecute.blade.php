@php
    $index_loop = 0;

@endphp

@foreach ($itemSlideInCategories as $itemSlideInCategory)
    @if ($loop->index % 4 == 0)
        @php
            $index_loop = $loop->index + 3;
        @endphp
            <div class="item
                @if ($loop->index == 0)
                    {{ 'active' }}
                @endif
            ">
    @endif

    @php 
        $imageItemSlide = $itemSlideInCategory->getAllImages()->first();
    @endphp
    <div class="col-sm-3 portfolio-item animation-fadeInQuick" data-category="design">
        <a href="{{ route('detail', [$itemSlideInCategory->id, str_slug($itemSlideInCategory->name)]) }}">
            @if(empty($imageItemSlide))
                <img src="{{ asset("/images/no-image-available.jpg") }}" alt="" class="img-responsive">
            @else
                <img src="{{ asset($imageItemSlide->path_origin) }}" alt="{{ $itemSlideInCategory->name }}" class="img-responsive-slider" >
            @endif
            <span class="portfolio-item-info">
                <strong>{{ $itemSlideInCategory->name }}</strong>
            </span>
        </a>
    </div>
    @if ($loop->index == $index_loop || $loop->index == $loop->last)
        @if ($loop->index != 0)
            </div><!--.row-->
        @endif
    @endif

@endforeach
