<ul class="product-menu-links d-flex align-items-center justify-content-center">
    @if(!empty($categories))
        @foreach($categories as $key => $category)
        @php
            $exists = Storage::disk('s3')->has('categories/' . $category['image']);
        @endphp
        <li class="dropdown">
            <span class="submenu-button"></span>
            <a href="{{ route('frontend.show_category_product', ['category' => $category['slug']]) }}" data-src="@if ($category['image']){{ ($exists === true) ? asset($cloudFrontUrl.$category['image']) :  '' }}@endif" class="dropdown-toggle" id="newarrivalsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ file_exists(public_path('uploads/category/'.$category['icon'])) ? asset('uploads/category/'.$category['icon']) :  '' }}" alt="" class="me-2 p-m-img"><span>{{$category->name}}</span> </a>
            @if($category->children()->count() > 0)
            <div  class="dropdown-menu"  aria-labelledby="newarrivalsDropdown">
                <div class="container">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-4">
                            <ul class="category-list">
                                <li>By Category</li>
                                <li><a href="{{ route('frontend.show_category_product', ['category' => $category['slug']]) }}" data-src="@if ($category['image']){{ ($exists === true) ? asset($cloudFrontUrl.$category['image']) :  '' }}@endif"><span>All {{$category->name}}</span></a></li>
                                @foreach($category->children as $key => $subcategory)
                                <li><a href="{{ route('frontend.show_sub_category_product', ['category' => $category['slug'],'subcategory' => $subcategory->slug]) }}" data-src="@if ($subcategory['image']){{ ($exists === true) ? asset($cloudFrontUrl.$subcategory['image']) :  '' }}@endif"><span>{{$subcategory->name}}</span></a></li>
                                @endforeach
                            </ul>
                        </div>
                        @if($category->image)
                            <div class="col-lg-4 d-none d-lg-block">
                                <div class="image-holder" >
                                <img src="@if ($category['image']){{ ($exists === true) ? asset($cloudFrontUrl.$category['image']) :  '' }}@endif" alt="">
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </li>
        @endforeach
    @endif
	{{-- <li>
		<a href="{{ route('frontend.page', 'about-us') }}"><img src="{{ asset('images/icons/about.svg') }}" alt="" class="me-2 p-m-img"><span>About</span></a>
	</li> --}}
    <li class="dropdown">
        <span class="submenu-button"></span>
        <a href="{{ route('frontend.page', 'our-story') }}" class="dropdown-toggle active" id="aboutDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('images/icons/about.svg') }}" alt="" class="me-2 p-m-img"><span>About</span>  </a>
        <div  class="dropdown-menu"  aria-labelledby="aboutDropdown">
            <div class="container">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-4">
                        <ul class="category-list">
                            <li>Pages</li>
                            <li><a href="{{ route('frontend.page', 'our-story') }}"><span>Our Story</span></a></li>
                            <li><a href="{{ route('frontend.page', 'our-team') }}"><span>Our Team</span></a></li>
                            <li><a href="{{ route('frontend.page', 'sustainablity') }}"><span>sustainablity</span></a></li>
                            <li><a href="{{ route('frontend.blogs') }}"><span>blog</span></a></li>
                            <li><a href="{{ route('frontend.faq') }}"><span style="text-transform: uppercase;">faq</span></a></li>
                            <li><a href="{{ route('frontend.page', 'bonica5bs3') }}"><span>bonica-5bs-3</span></a></li>
                            <li><a href="{{ route('frontend.page', 'size-guide') }}"><span>size-guide</span></a></li>
                        </ul>
                    </div>
                    @php
                        $cmsPageImage = App\Models\CmsPage::Active()->where('slug','about-us')->value('image');
                    @endphp
                    @if($cmsPageImage)
                        <div class="col-lg-4 d-none d-lg-block">
                            <div class="image-holder" >
                            <img src="@if ($cmsPageImage){{ file_exists(public_path('uploads/cmspage/'.$cmsPageImage)) ? asset('uploads/cmspage/'.$cmsPageImage) :  '' }}@endif" alt="">
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </li>
</ul>
@push('js')
<script>
$(".product-menu-links li a").hover( function() {

    var value = $(this).attr('data-src');

    $(".image-holder img").hide();
    if(value != ''){
        $(".image-holder img").show();
        $(".image-holder img").attr("src", value);
    }
});
</script>
@endpush
