@foreach($sections as $section)
    @if($section->type == 'home_principal')
        @foreach($section->sectionCategories as $sectionCategory)
            @foreach($sectionCategory->category->categoryProducts as $productCategory)
                <a href="/cat/{!! $productCategory->category->id !!}">{!! $productCategory->category->description !!}</a>
                @foreach($productCategory->category->imageCategories as $categoryImage)
                    <img src="{{ asset('images/'.$categoryImage->image->name) }}">
                @endforeach
                {{--@foreach($productCategory->product->imageProducts as $productImage)--}}
                    {{--<img src="{{ asset('images/'.$productImage->image->name) }}">--}}
                {{--@endforeach--}}
            @endforeach
        @endforeach
    @endif
@endforeach