@extends('frontend.layouts.master')

@section('title', $medicine->name)

@section('content')
<section class="site-section site-section-detail site-section-light site-section-top themed-background-dark">
    <div class="container text-center">
        <h1 class="animation-slideDown">
            <strong>{{ $medicine->name }}</strong>
        </h1>
        <h3 class="animation-slideDown">
            <strong>{{ $medicine->symptom }}</strong>
        </h3>
    </div>
</section>
<!-- Product View -->
<section class="site-content site-section">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-4 col-lg-3">
                <aside class="sidebar site-block">
                    <!-- Store Menu -->
                    <!-- Store Menu functionality is initialized in js/app.js -->
                    <div class="sidebar-block">
                        <ul class="store-menu">
                            @foreach($frontendAllParentCategories as $frontendAllParentCategory)
                                <li class="open">
                                    <a href="javascript:void(0)" class="submenu">
                                        <i class="fa fa-angle-right"></i>
                                        {{ $frontendAllParentCategory->name }}
                                    </a>
                                    <ul>
                                        @foreach($frontendAllParentCategory->getSubCategories as $getSubCategory)
                                            <li><a href="{{ route('sub_Nav', [$frontendAllParentCategory->link, $getSubCategory->link]) }}">{{ $getSubCategory->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                            <li class="open">
                                {{-- This class show what open onload page --}}
                            </li>
                        </ul>
                    </div>
                    <!-- END Store Menu -->
                </aside>
            </div>
            <!-- END Sidebar -->

            <!-- Product Details -->
            <div class="col-md-8 col-lg-9">
                <div class="row" data-toggle="lightbox-gallery">
                    <!-- Images -->
                    <div class="col-sm-6 push-bit">
                        @if(empty($medicine->getAllImages->first()))
                            <a href="javascript:void(0)" class="gallery-link"><img src="{{ asset("/images/no-image-available.jpg") }}" alt="" class="img-responsive push-bit"></a>
                        @else
                            @foreach($medicine->getAllImages as $getAllImagesValue)
                                @if($loop->index==0)
                                    <a href="{{ asset($getAllImagesValue->path_origin) }}" class="gallery-link"><img src="{{ asset($getAllImagesValue->path_origin) }}" alt="" class="img-responsive push-bit"></a>
                                    @if($loop->count == 1)
                                        <div class="row push-bit">
                                    @endif
                                @else
                                    @if($loop->index == 1)
                                        <div class="row push-bit">
                                            <div class="col-xs-4">
                                                <a href="{{ asset($getAllImagesValue->path_origin) }}" class="gallery-link"><img src="{{ asset($getAllImagesValue->path_origin) }}" alt="" class="img-responsive"></a>
                                            </div>
                                    @else
                                        <div class="col-xs-4">
                                            <a href="{{ asset($getAllImagesValue->path_origin) }}" class="gallery-link"><img src="{{ asset($getAllImagesValue->path_origin) }}" alt="" class="img-responsive"></a>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        @endif
                    </div>
                    @if(!empty($medicine->getAllImages->first()))
                        </div>
                    @endif
                    <!-- END Images -->

                    <!-- Info -->
                    <div class="col-sm-6 push-bit">
                        <div class="clearfix">
                            <div class="product-name">
                                <span class= "h1">{{ $medicine->name }}</span>
                            </div>
                            <div class="pull-right">
                                <span class="h2">
                                    <strong>{{ App\Helpers\Helper::formatPrice($medicine->price) }}</strong>
                                </span>
                            </div>
                            <span class="h4">
                                <small>{{ __('Status') }}: </small>
                                @if($medicine->quantity > 0)
                                    <strong class="text-success h4-left">{{ __('IN STOCK') }}</strong>
                                @else
                                    <strong class="text-success h4-left">{{ __('OUT OF STOCK') }}</strong>
                                @endif
                            </span>
                        </div>
                        <hr>
                        <div class= "short-description">
                            <span>
                                <h3><strong>{{ __('Product informations') }}</strong></h3>
                            </span>
                            <div class="info-left-margin">
                                <span>
                                    @if($medicine->allowed_buy == App\Eloquent\Medicine::ALLOWED_BUY)
                                        <i class="text-success fa fa-check" aria-hidden="true"></i>
                                        <strong class="text-success h4-left">{{ $option['allowedToBuy'][App\Eloquent\Medicine::ALLOWED_BUY] }}</strong>
                                    @else
                                        <i class="text-danger fa fa-times" aria-hidden="true"></i>
                                        <strong class="text-danger h4-left">{{ $option['allowedToBuy'][App\Eloquent\Medicine::NOT_ALLOWED_BUY] }}</strong>
                                    @endif
                                </span>
                                <ul class="short-info">
                                    <li>
                                        <strong>{{ __('Quantity') }}:</strong>
                                        <strong class="text-danger">
                                            {{ App\Helpers\Helper::numberIntegerFormat($medicine->quantity) }}
                                        </strong>
                                        <span>{{ $medicine->unit }}</span>
                                    </li>
                                    @if ($medicine->ingredient)
                                        <li>
                                            <strong>{{ __('Symptom') }}:</strong>
                                            <span>{{ $medicine->symptom }}</span>
                                        </li>
                                    @endif
                                    @if ($medicine->ingredient)
                                        <li>
                                            <strong>{{ __('Ingredient') }}:</strong>
                                            <span>{{ $medicine->ingredient }}</span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <hr/>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-justify">
                                <span>{{ $medicine->short_describer }}</span>
                            </p>
                        </div>
                        <div class="col-sm-3">
                            @if (Auth::check()) 
                                <div class="add-to-box border-heart add-medicine-to-box" title="{{ __('Add to box') }}" medicine_id="{{ $medicine->id }}">
                            @else
                                <div class="add-to-box border-heart" data-toggle="modal" data-target="#showNotLogin" title="{{ __('Add to box') }}">
                            @endif
                                <span class="span-heart">
                                    @if(empty($check_marked))
                                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                                    @else
                                        <i class="fa fa-heart" aria-hidden="true"></i>
                                    @endif
                                </span>
                            </div>
                        </div>
                        
                    </div>
                    <!-- END Info -->

                    <!-- More Info Tabs -->
                    <div class="col-xs-12 site-block boder-1px">
                        <ul class="nav nav-tabs push-bit" data-toggle="tabs">
                            <li class="active"><a href="#product-detail">{{ __('Details') }}</a></li>
                            <li><a href="#product-guide">{{ __('Guide') }}</a></li>
                            <li><a href="#product-description">{{ __('Questions - answers') }}</a></li>
                            <li><a href="#product-reviews">{{ __('Reviews') }}</a></li>
                        </ul>
                        <div class="tab-content">
                            
                            <div class="tab-pane active" id="product-detail">
                                
                                <div class= "short-description">
                                    <div class="info-left-margin">
                                        {!! $medicine->detail !!}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="product-guide">
                                {!! $medicine->guide !!}
                            </div>

                            <div class="tab-pane" id="product-description">
                                <!-- Comment -->
                                <div class="container position-relative" id="area-comment-medicine">
                                     <div class="indicator hide" id="comment-indicator">
                                        <div class="spinner"></div>
                                    </div>
                                    @if (!Auth::check())
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="alert alert-warning" role="alert">
                                                    <p>{{ __('You are not logged in. Please login to question or answer!') }}</p>
                                                    <a href="{{route('login')}}">{{ __('Login') }}</a>
                                                    <span>{{ __('or') }}</span>
                                                    <a href="{{ route('register') }}">{{ __('Register') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="row">
                                            <div class="col-sm-12 text-right margin-bottom-30px">
                                                {!! Form::textarea('', '', ['rows' => '4', 'class' => 'form-control', 'placeholder' => __('Please write a question here...'), 'id' => 'comment-content-textarea']) !!}
                                                {!! Form::button(__('Add question'), ['data-toggle' => 'tooltip', 'class' => 'btn btn-primary', 'title' => __('Add question'), 'data-bind' => 'click: sendComment']) !!}
                                                <div class="indicator hide" id="comment-indicator-add-question">
                                                    <div class="spinner"></div>
                                                </div>
                                            </div><!-- /col-sm-12 -->
                                        </div><!-- /row -->
                                    @endif
                                    <div class="row" data-bind="foreach: commentDataArray">
                                        <div class="col-sm-12">
                                            <div class="panel panel-white post panel-shadow">
                                                <div class="post-heading">
                                                    <div class="pull-left image">
                                                        <img class="img-circle avatar" data-bind="attr:{src: $root.getLinkAvatarUser(itemData().get_user.avatar)}">
                                                    </div>
                                                    <div class="pull-left meta">
                                                        <div class="title h5">
                                                            <a data-bind="attr:{href: $root.getLinkProfileUser(itemData().get_user.id, itemData().get_user.display_name)}" target="_blank">
                                                                <b data-bind="text: itemData().get_user.display_name"></b>
                                                            </a>
                                                            <span class="label label-warning" data-bind="text: $root.getLabelPermission(itemData().get_user.permission)"></span>
                                                        </div>
                                                        <h6 class="text-muted time" data-bind="text: itemData().updated_at"></h6>
                                                    </div>
                                                </div> 
                                                <div class="post-description text-right position-relative">
                                                    <p data-bind="text: itemData().content, attr:{id: 'cm-show-parent-' + itemData().id}, event:{dblclick: $root.editParentComment}" class="text-left margin-bottom-0px"></p>
                                                    {!! Form::textarea('', '', ['rows' => '3', 'class' => 'form-control hide', 'data-bind' => 'attr:{id: "cm-parent-textarea-" + itemData().id}, event:{keyup: $root.pressEscParentComment}']) !!}
                                                    <!-- ko if: $root.currentUserId() == itemData().get_user.id -->
                                                        <a href="javascript:void(0)" class="text-primary" data-bind="event: {click: $root.editParentComment}, attr:{id: 'cm-parent-button-edit-' + itemData().id}">
                                                            <i class="fa fa-edit"></i>
                                                            {{ __('Edit') }}
                                                        </a>
                                                    <!-- /ko -->
                                                    <a href="javascript:void(0)" class="text-primary hide" data-bind="event: {click: $root.saveParentComment}, attr:{id: 'cm-parent-button-save-' + itemData().id}">
                                                        <i class="fa fa-save"></i>
                                                        {{ __('Save') }}
                                                    </a>
                                                    <div class="indicator hide" data-bind="attr:{id: 'comment-parent-indicator-edit-' + itemData().id}">
                                                        <div class="spinner"></div>
                                                    </div>
                                                </div>
                                                <div class="post-footer">
                                                    <div class="input-group padding-left-30px">
                                                        @if (Auth::check())
                                                            <input class="form-control" placeholder="{{ __('Add a answer or a comment!') }}" type="text" data-bind="attr:{id: 'cm-children-input-' + itemData().id}, event:{keyup: $root.enterAddChildrenComment}">
                                                            <span class="input-group-addon" data-bind="click: $root.addChidrenComment">
                                                                <a href="javascript:void(0)" class="text-primary stat-item">
                                                                    <i class="fa fa-plus-circle"></i>
                                                                </a>  
                                                            </span>
                                                        @else
                                                            <input class="form-control" placeholder="{{ __('Please login to add a answer or a comment!') }}" type="text" disabled>
                                                            <span class="input-group-addon">
                                                                <a href="javascript:void(0)" class="text-danger stat-item" disabled><i class="fa fa-ban"></i></a>  
                                                            </span>
                                                        @endif
                                                        <div class="indicator hide" data-bind="attr:{id: 'comment-children-indicatora-' + itemData().id}">
                                                            <div class="spinner"></div>
                                                        </div>
                                                    </div>
                                                    <ul class="comments-list padding-left-30px" data-bind="foreach: childrenItems()">
                                                        <li class="comment">
                                                            <a class="pull-left" href="javascrip:void
                                                            (0)">
                                                                <img class="avatar" data-bind="attr:{src: $root.getLinkAvatarUser(get_user.avatar)}">
                                                            </a>
                                                            <div class="comment-body">
                                                                <div class="comment-heading">
                                                                    <h4 class="user">
                                                                        <a href="javascript:void(0)" data-bind="text: get_user.display_name, attr:{href: $root.getLinkProfileUser(get_user.id, get_user.display_name)}" target="_blank"></a>
                                                                    </h4>
                                                                    <span class="label label-warning" data-bind="text: $root.getLabelPermission(get_user.permission)"></span>
                                                                    <h5 class="time" data-bind="text: updated_at"></h5>
                                                                    <!-- ko if: $root.currentUserId() == get_user.id -->
                                                                        <a href="javascript:void(0)" class="text-primary stat-item padding-left-30px" data-bind="click: $root.editChildrenComment">
                                                                            <i class="fa fa-pencil icon"></i>
                                                                        </a>
                                                                        <a href="javascript:void(0)" class="text-danger stat-item padding-left-30px" data-bind="click: $root.deleteChildrenComment">
                                                                            <i class="fa fa-trash-o icon"></i>
                                                                        </a>
                                                                    <!-- /ko -->
                                                                </div>
                                                                <p class="margin-bottom-0px" data-bind="text: content, attr:{id: 'cm-children-show-content-' + id}, event:{dblclick: $root.editChildrenComment}"></p>
                                                                <div class="input-group hide" data-bind="attr:{id: 'cm-children-area-edit-' + id}">
                                                                    <input class="form-control" placeholder="{{ __('Add a answer or a comment!') }}" type="text" data-bind="event:{keyup: $root.enterEditChildrenComment}">
                                                                    <span class="input-group-addon" data-bind="event:{click: $root.saveChildrenComment}">
                                                                        <a href="javascript:void(0)" class="text-primary"><i class="fa fa-save icon"></i></a>  
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="indicator hide" data-bind="attr:{id: 'comment-children-indicatora-update-' + id}">
                                                                <div class="spinner"></div>
                                                            </div>
                                                        </li>
    
                                                    </ul>
                                                    
                                                </div>

                                            </div>
                                        </div>
                                        <!-- Button trigger modal -->

                                        <button type="button" id="comment-button-show-emty" class="hide" data-toggle="modal" data-target="#modal-require-text-comment">
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modal-require-text-comment" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">{{ __('Please enter text to question or answer!') }}</h4>
                                                    </div>
                                                </div>
                                            </div>
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
                            </div>

                            <div class="tab-pane" id="product-reviews">

                                @include('frontend.components.reviews')
                                
                            </div>
                        </div>
                    </div>
                    <!-- END More Info Tabs -->
                </div>
            <!-- END Product Details -->
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="showNotLogin" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ __('Notification') }}</h4>
                </div>
                <div class="modal-body">
                    <p>
                        {{ __('You have to login to mark medicines!') }}
                    </p>
                    <a href="{{route('login')}}">{{ __('Login') }}</a>
                    <span>{{ __('or') }}</span>
                    <a href="{{ route('register') }}">{{ __('Register') }}</a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END Product View -->
@endsection

@section('custom-javascript')
    <script src="{!! url('js/frontend/pagination.js') !!}"> </script>
    <script src="{!! url('js/frontend/medicine-comment.js') !!}"></script>
    <script>
        ko.applyBindings(
            new CommentViewModel().initData('{{ $medicine->id }}'),
            document.getElementById('area-comment-medicine')
        );
    </script>
@endsection
