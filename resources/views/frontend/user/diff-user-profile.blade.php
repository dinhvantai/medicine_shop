@extends('frontend.layouts.master')

@section('title', $userProfiles->display_name)

@section('content')
<div class="media-container media-diff-user">
    <div class="container banner-title">
    </div>
    <img src="{{ asset('images/mountain.jpg') }}" alt="Image" class="media-image animation-pulseSlow">
</div>

<section class="site-content site-section padding-15px">
    <div class="container">
        <div class="col-lg-12 col-sm-12">
            
            <div class="user-diff-info">
                <div class="tab-content margin-left-0px">
                        <div class="container padding-lr-0px">

                            <div class="twPc-div">
                                <a class="twPc-bg twPc-block"></a>
                                <div>

                                    <a title="{{ $userProfiles->display_name }}" href="https://twitter.com/mertskaplan" class="twPc-avatarLink">
                                        <img alt="{{ $userProfiles->display_name }}" src="{!! App\Helpers\Helper::getLinkUserAvatar($userProfiles->avatar) !!}" class="twPc-avatarImg"/>
                                    </a>

                          

                                    <div class="twPc-divUser">
                                        <div class="twPc-divName">
                                            <a href="javascript:void(0)">{{ $userProfiles->display_name }}</a>
                                            <span class="label label-warning">
                                                {{ $option['permission'][$userProfiles->permission] }}
                                            </span>
                                        </div>
                                    </div>

                                   <div class="twPc-divStats">
                                        <ul class="twPc-Arrange">
                                            <li class="twPc-ArrangeSizeFit">
                                                <a href="javascript:void(0)">
                                                    <span class="twPc-StatLabel twPc-block">
                                                        {{ __('Questions') }}
                                                    </span>
                                                    <span class="twPc-StatValue">
                                                        {{ App\Helpers\Helper::numberIntegerFormat($data['comment']['question']) }}
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="twPc-ArrangeSizeFit">
                                                <a href="javascript:void(0)">
                                                     <span class="twPc-StatLabel twPc-block">
                                                        {{ __('Answers') }}
                                                    </span>
                                                    <span class="twPc-StatValue">
                                                        {{ App\Helpers\Helper::numberIntegerFormat($data['comment']['answer']) }}
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="twPc-ArrangeSizeFit">
                                                <a href="javascript:void(0)">
                                                     <span class="twPc-StatLabel twPc-block">
                                                        {{ __('Reviews') }}
                                                    </span>
                                                    <span class="twPc-StatValue">
                                                        {{ App\Helpers\Helper::numberIntegerFormat($data['review']['count']) }}
                                                    </span>
                                                </a>
                                            </li>
                                            @if ($userProfiles->permission == App\Eloquent\User::PERMISSION_DOCTER)
                                                <li class="twPc-ArrangeSizeFit">
                                                    <a href="javascript:void(0)">
                                                         <span class="twPc-StatLabel twPc-block">
                                                            {{ __('Recieve Request') }}
                                                        </span>
                                                        <span class="twPc-StatValue">
                                                            {{ App\Helpers\Helper::numberIntegerFormat($data['doctor']['request']) }}
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="twPc-ArrangeSizeFit">
                                                    <a href="javascript:void(0)">
                                                         <span class="twPc-StatLabel twPc-block">
                                                            {{ __('Make Prescription') }}
                                                        </span>
                                                        <span class="twPc-StatValue">
                                                            {{ App\Helpers\Helper::numberIntegerFormat($data['doctor']['prescription']) }}
                                                        </span>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <!-- code end -->
                          
                        </div>

                        <h3 class="mgbt-xs-15 mgtp-10 font-semibold text-info">
                            <i class="icon-user mgr-10 profile-icon"></i>
                            {{ __('Short Describe') }}
                        </h3>
                        <div class="row">
                            <div class="col-sm-12">
                                {{ $userProfiles->about_you }}
                            </div>
                        </div><hr/>

                        @if($userProfiles->permission == App\Eloquent\User::PERMISSION_DOCTER)
                            <h3 class="mgbt-xs-15 mgtp-10 font-semibold text-info">
                                <i class="icon-user mgr-10 profile-icon"></i>
                                {{ __('Doctor Information') }}
                            </h3>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row mgbt-xs-0">
                                        <label class="col-xs-5 control-label">{{ __('Specialize') }}</label>
                                        <div class="col-xs-7 controls">{{ $userProfiles->specialize }}</div>
                                        <!-- col-sm-10 --> 
                                    </div><hr/>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row mgbt-xs-0">
                                        <label class="col-xs-5 control-label">{{ __('Experience') }}</label>
                                        <div class="col-xs-7 controls">{{ $userProfiles->experience }}</div>
                                        <!-- col-sm-10 --> 
                                    </div><hr/>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row mgbt-xs-0">
                                        <label class="col-xs-5 control-label">{{ __('Certificate') }}</label>
                                        <div class="col-xs-7 controls">{{ $userProfiles->certificate }}</div>
                                        <!-- col-sm-10 --> 
                                    </div><hr/>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row mgbt-xs-0">
                                        <label class="col-xs-5 control-label">{{ __('Workplace') }}</label>
                                        <div class="col-xs-7 controls">{{ $userProfiles->workplace }}</div>
                                        <!-- col-sm-10 --> 
                                    </div><hr/>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row mgbt-xs-0">
                                        <label class="col-xs-5 control-label">{{ __('Position') }}</label>
                                        <div class="col-xs-7 controls">{{ $userProfiles->position }}</div>
                                        <!-- col-sm-10 --> 
                                    </div><hr/>
                                </div>
                            </div>
                        @endif

                        <h3 class="mgbt-xs-15 mgtp-10 font-semibold text-info">
                            <i class="icon-user mgr-10 profile-icon"></i>
                            {{ __('User Information') }}
                        </h3>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row mgbt-xs-0">
                                    <label class="col-xs-5 control-label">{{ __('Gender') }}</label>
                                    <div class="col-xs-7 controls">
                                        @if (isset($option['gender'][$userProfiles->gender]))
                                            {{ $option['gender'][$userProfiles->gender] }}
                                        @else
                                           {{ __('Not selected') }}
                                        @endif
                                    </div>
                                    <!-- col-sm-10 --> 
                                </div><hr/>
                            </div>
                            <div class="col-sm-6">
                                <div class="row mgbt-xs-0">
                                    <label class="col-xs-5 control-label">{{ __('Phone') }}</label>
                                    <div class="col-xs-7 controls">
                                        {{ $userProfiles->phone }}
                                    </div>
                                    <!-- col-sm-10 --> 
                                </div><hr/>
                            </div>
                            <div class="col-sm-6">
                                <div class="row mgbt-xs-0">
                                    <label class="col-xs-5 control-label">{{ __('Date of birth') }}</label>
                                    <div class="col-xs-7 controls">
                                        {{ $userProfiles->birthday }}
                                    </div>
                                    <!-- col-sm-10 -->
                                </div><hr/>
                            </div>
                            <div class="col-sm-6">
                                <div class="row mgbt-xs-0">
                                    <label class="col-xs-5 control-label">{{ __('Address') }}</label>
                                    <div class="col-xs-7 controls">
                                        {{ $userProfiles->address }}
                                    </div>
                                    <!-- col-sm-10 -->
                                </div><hr/>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!-- For best results use an image with a resolution of 2560x279 pixels -->
    </div>
</section>
@endsection
