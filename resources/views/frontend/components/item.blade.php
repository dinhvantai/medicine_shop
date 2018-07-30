@foreach($items as $item)

<div class="col-md-4 visibility-none" data-toggle="animation-appear" data-animation-class="animation-fadeInQuick" data-element-offset="-100">
    <div class="store-item wrap-cateitem">
        <div class="store-item-rating text-warning">
            <input id="star-main" name="star-main" class="rating rating-loading" data-min="0" data-max="5" data-step="1" readonly="true" data-show-clear="false" data-size="sm" data-show-caption="false" value="{{ $item->avg_rate }}">
        </div>
        <div class="store-item-image">
            <a href="{{ route('detail', [$item->id, str_slug($item->name)]) }}">
            @if(empty($item->getAllImages->first()))
                <img src="{{ asset("/images/no-image-available.jpg") }}" alt="" class="img-responsive">
            @else
                <img src="{{ asset($item->getAllImages->first()->path_origin) }}" alt="" class="img-responsive">
            @endif
            </a>
            
        </div>
        <div class="store-item-info clearfix">
            <span class="store-item-price themed-color-dark pull-right">{{ App\Helpers\Helper::formatPrice($item->price) }}</span>
            <a href="{{ route('detail', [$item->id, str_slug($item->name)]) }}"><strong>{{ $item->name }}</strong></a><br>
            <span>
                @if($item->allowed_buy == App\Eloquent\Medicine::ALLOWED_BUY)
                    <i class="text-success fa fa-check" aria-hidden="true"></i>
                    <strong class="text-success">
                        {{ $option['allowedToBuy'][App\Eloquent\Medicine::ALLOWED_BUY] }}
                    </strong>
                @else
                    <i class="text-danger fa fa-times" aria-hidden="true"></i>
                    <strong class="text-danger">
                        {{ $option['allowedToBuy'][App\Eloquent\Medicine::NOT_ALLOWED_BUY] }}
                    </strong>
                @endif
            </span><br/>
            <strong>{{ __('Symptom') }}:</strong>
            <span>{{ str_limit($item->symptom, 65) }}</span>
        </div>
    </div>
</div>
@endforeach
