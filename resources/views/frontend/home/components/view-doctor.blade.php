<!-- Section: team -->
<div class="container marginbot-50">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="wow fadeInDown" data-wow-delay="0.1s">
                <div class="section-heading text-center">
                    <h2 class="h-bold">{{ __('Doctors') }}</h2>
                    <p>{{ __('Doctors with high trust') }}</p>
                </div>
            </div>
            <div class="divider-short"></div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-12">

            <div id="filters-container" class="cbp-l-filters-alignLeft">
                <div data-filter="*" class="cbp-filter-item-active cbp-filter-item">{{ __('All') }} (<div class="cbp-filter-counter"></div>)</div>
                @php
                    $check = [];
                @endphp
                @foreach($doctor_list as $value_doctor_list)
                    @if( !empty($value_doctor_list->specialize))
                        @if(in_array($value_doctor_list->specialize, $check))
                            @continue;
                        @else
                            @php
                                $check[] = $value_doctor_list->specialize ;
                            @endphp
                        @endif
                        
                        <div data-filter=".{{ str_slug($value_doctor_list->specialize) }}" class="cbp-filter-item">{{ $value_doctor_list->specialize }}(<div class="cbp-filter-counter"></div>)</div>
                    @else
                        @continue;
                    @endif
                @endforeach
            </div>

            <div id="grid-container" class="cbp-l-grid-team">
                <ul>
                @foreach($doctor_list as $value_doctor_list)
               
                    @if(empty($value_doctor_list->specialize))
                        @continue;
                    @else
                        <li class="cbp-item {{ str_slug($value_doctor_list->specialize) }}">
                            <a href="{{ route('frontend.user.different.profiles',[$value_doctor_list->id, str_slug($value_doctor_list->display_name)]) }}" class="cbp-caption">
                                <div class="cbp-caption-defaultWrap">
                                    <img src="{{ App\Helpers\Helper::getLinkUserAvatar($value_doctor_list->avatar) }}" alt="" width="100%">
                                </div>
                                <div class="cbp-caption-activeWrap">
                                    <div class="cbp-l-caption-alignCenter">
                                        <div class="cbp-l-caption-body">
                                            <div class="cbp-l-caption-text">{{ __('VIEW PROFILE') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="{{ route('frontend.user.different.profiles', [$value_doctor_list->id, str_slug($value_doctor_list->display_name)]) }}" class="cbp-l-grid-team-name">{{ $value_doctor_list->display_name }}</a>
                            <div class="cbp-l-grid-team-position">{{ $value_doctor_list->specialize }}</div>
                        </li>
                    @endif
                @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Section: team -->