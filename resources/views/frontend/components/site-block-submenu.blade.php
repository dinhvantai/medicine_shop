<div class="site-block text-center">
    <div class="btn-group portfolio-filter">
        <a href="{{ route('nav', [$parentLink]) }}" class="btn btn-primary {{ isset($subLink)? '' : 'active' }}" data-category="all">
        	{{ __('All') }}
        </a>
        @foreach( $subCategories as $subCategory)
	        <a href="{{ route('sub_Nav', [$parentLink, $subCategory->link]) }}" id="linkToSubcate" class="btn btn-primary {{ (isset($subLink) && $subLink == $subCategory->link) ? 'active' : '' }}" data-category="design">{{ $subCategory->name }}</a>
	        <input type="hidden" name="passingNameSubcateToAjax" id="subpassingName" value="{{ $subCategory->link }}">
	        <input type="hidden" name="passingNameParentcateToAjax" id="parentpassingName" value="{{ $parentLink }}">
        @endforeach
    </div>
</div>
