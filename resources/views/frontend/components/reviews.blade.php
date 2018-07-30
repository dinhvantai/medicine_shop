<div class="row">
    <div class="col-sm-12 col-xs-12">
        <div class="wrap-rating-info">
            <div class="row">
                <div class="col-sm-6 col-xs-6 rating-header">
                    <h3>{{ $medicine->name . __(' rating') }}</h3>
                </div>
                <div class="col-sm-6 col-xs-6">
                    <div class="right-showform-review">
                       <button class="btn btn-success rating-button">
                           {{ __('Rating & Review') }}
                       </button>
                   </div>
               </div>
            </div>
                
            @for ($i=0; $i < 5; $i++)
                @php
                    if(!$medicine->total_rate) {
                        $starPercent[] = 0;  
                    } else {
                        $starPercent[] = ($countStar[$i]/$medicine->total_rate) * 100;
                    }
                @endphp
            @endfor
            <div class="row">
                <div class="col-sm-9 col-xs-12">
                    <div class="left-rating">
                        <div class="row wrap-avg-rating">
                            <div class="col-sm-6 col-xs-6">
                                <div class="star-input-rating">
                                    <input data-readonly="true" data-show-clear="false" data-show-caption="false" id="star-main" name="star-main" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="{{ $medicine->avg_rate }}">
                                    <span class="rating-info">
                                        <em>
                                            {{ App\Helpers\Helper::numberFloatFormat($medicine->avg_rate) }}
                                        </em>
                                        {{ __('per 5') }}
                                    </span><br>
                                    <span class="rating-number-text"> {{ $medicine->total_rate . __(' ratings and reviews') }}</span>
                                </div>
                            </div>
                            
                            <div class="col-sm-6 col-xs-6">
                                <div class="bar-div-rating">
                                    <span class="rating-bar-label">
                                        {{ __(':num stars', ['num' => 5]) }}
                                    </span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="200" style="width:
                                        {{ $starPercent[4] }}%"
                                        ></div>
                                    </div>
                                    <span class="rating-bar-count">{{ $countStar[4] }}</span>
                                </div>
                                <div class="bar-div-rating">
                                    <span class="rating-bar-label">
                                        {{ __(':num stars', ['num' => 4]) }}
                                    </span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="200" style="width:{{ $starPercent[3] }}%"></div>
                                    </div>
                                    <span class="rating-bar-count">{{ $countStar[3] }}</span>
                                </div>
                                <div class="bar-div-rating">
                                    <span class="rating-bar-label">
                                        {{ __(':num stars', ['num' => 3]) }}
                                    </span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="200" style="width:{{ $starPercent[2] }}%"></div>
                                    </div>
                                    <span class="rating-bar-count">{{ $countStar[2] }}</span>
                                </div>
                                <div class="bar-div-rating">
                                    <span class="rating-bar-label">
                                        {{ __(':num stars', ['num' => 2]) }}
                                    </span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="200" style="width:{{ $starPercent[1] }}%">
                                        </div>
                                    </div>
                                    <span class="rating-bar-count">{{ $countStar[1] }}</span>
                                </div>
                                <div class="bar-div-rating">
                                    <span class="rating-bar-label">
                                        {{ __(':num stars', ['num' => 1]) }}
                                    </span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="200" style="width:{{ $starPercent[0] }}%"></div>
                                    </div>
                                    <span class="rating-bar-count">{{ $countStar[0] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </div>

        <div class="row col-sm-12 col-xs-12">
            <div class="wrap-form-rating-review">
                <h3>{{ __('Your rating and review about this medicines') }}</h3>
                <div class="row wrap-form">
                    <div class="col-sm-12 col-xs-12">
                        <div class="form-reviews margin-bottom-0px">
                            {{ Form::text('star-main', '', array('class' => 'rating rating-loading', 'id' => 'star-main2', 'data-min' => '0', 'data-max' => '5', 'data-step' => '1')) }}
                            <span class="rating-star-hint">
                                {{ __('Click here to start rating') }}
                            </span>
                            <div class="div-overlap div-overlap-active div-overlap-none-active"></div>
                            <div class="form-group">
                                {{ Form::text('review-title', '', ['class' => 'form-control review-title ', 'placeholder' => __('Title review'), 'id' => 'review-title']) }}
                            </div>
                            <div class="form-group margin-bottom-0px">
                                {{ Form::textarea('review-content', '',  ['class' => 'form-control review-content', 'placeholder' => __('Please enter the content for the review.'), 'rows' => '4', 'id' => 'review-content']) }}
                            </div>
                            <a href="javascript:void(0)" class="btn btn-success rating-send-form" data-medicine-id ="{{ $medicine->id }}">
                                {{ __('Add Review') }}
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-3 ">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="frontend-area-review" class="position-relative">
    <ul class="media-list">
        @foreach ($reviewInformation as $valueReview)
            <li class="media">
                @if ($valueReview->getUser)
                    <a href="{{ route('frontend.user.different.profiles', [$valueReview->getUser->id, str_slug($valueReview->getUser->display_name)]) }}" class="pull-left">
                        <img src="{{ App\Helpers\Helper::getLinkUserAvatar($valueReview->getUser->avatar) }}" alt="{{ __('Avatar') }}" class="img-circle">
                @else
                    <a href="javascript:void(0)" class="pull-left">
                        <img src="{{ App\Helpers\Helper::getLinkUserAvatar('') }}" alt="{{ __('Avatar') }}" class="img-circle">
                @endif
                </a>
                <div class="media-body">
                    <div class="text-warning pull-right">
                        <input name="star-main" class="detail-rating rating rating-loading" data-min="0" data-max="5" data-step="1" data-readonly="true" data-size="xs" data-show-clear="false" data-show-caption="false" value="{{ $valueReview->point_rate }}">
                    </div>
                    <span class="title-review"> {{ $valueReview->title }} </span><br>
                    @if(empty($valueReview->user_id))
                        <em>
                            <span class="review-according">
                                {{ __('According to an ') }}
                                <a href="javascript:void(0)">{{ __('unregister user') }}</a>
                            </span>
                        </em><br>
                    @else
                        <em>
                            <span class="review-according">
                                {{ __('According to ') }}
                                <a target="_blank" href="{{ route('frontend.user.different.profiles', [$valueReview->getUser->id, str_slug($valueReview->getUser->display_name)]) }}">
                                    <strong class="username-review">{{ $valueReview->getUser->display_name }}</strong>
                                </a>
                            </span>
                        </em><br>
                    @endif

                    <span class="text-muted pull-right"><small><em>{{ $valueReview->created_at }} </em></small></span>
                    <p class="margin-bottom-0px">{{ $valueReview->content }}</p>
                </div>
            </li>
        @endforeach
    </ul>
    <div class="indicator hide" id="frontend-review-indicator">
        <div class="spinner"></div>
    </div>
</div>
<div id="frontend-review-paginate">
    {{ $reviewInformation->links('frontend.components.paginate-review') }}
</div>
