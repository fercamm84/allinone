{{-- @foreach($sections as $section)
    @if($section->type == 'home_principal')
        @foreach($section->sectionCategories as $sectionCategory)
            @foreach($sectionCategory->category->categoryProducts as $productCategory)
                <a href="/cat/{!! $productCategory->category->id !!}">{!! $productCategory->category->description !!}</a>
                @foreach($productCategory->category->imageCategories as $categoryImage)
                    <img src="{{ asset('images/'.$categoryImage->image->name) }}" width="500px" height="500px">
                @endforeach
                {{--@foreach($productCategory->product->imageProducts as $productImage)--}}
                    {{--<img src="{{ asset('images/'.$productImage->image->name) }}">--}}
                {{--@endforeach--}}
{{--           @endforeach
       @endforeach
   @endif
@endforeach
--}}

<div class="container">
    <div class="col-md-12">
        <div id="main-slider">
            <div class="item">
                <img src="img/main-slider1.jpg" alt="" class="img-responsive">
            </div>
            <div class="item">
                <img class="img-responsive" src="img/main-slider2.jpg" alt="">
            </div>
            <div class="item">
                <img class="img-responsive" src="img/main-slider3.jpg" alt="">
            </div>
            <div class="item">
                <img class="img-responsive" src="img/main-slider4.jpg" alt="">
            </div>
        </div>
        <!-- /#main-slider -->
    </div>
</div>

<div id="hot">

    <div class="box">
        <div class="container">
            <div class="col-md-12">
                <h2>Categorias</h2>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="product-slider">
            @foreach($sections as $section)
                @if($section->type == 'home_principal')
                    @foreach($section->sectionCategories as $sectionCategory)
                        @foreach($sectionCategory->category->categoryProducts as $productCategory)

            <div class="item">
                <div class="product">
                    <div class="flip-container">
                        <div class="flipper">
                            @foreach($productCategory->category->imageCategories as $categoryImage)
                                <div class="front">
                                    <a href="/cat/{!! $productCategory->category->id !!}">
                                        <img src="{{ asset('images/'.$categoryImage->image->name) }}" class="img-responsive">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <a href="detail.html" class="invisible">
                        <img src="img/product1.jpg" alt="" class="img-responsive">
                    </a>
                    <div class="text">
                        <h3><a href="/cat/{!! $productCategory->category->id !!}">{!! $productCategory->category->description !!} </a></h3>
                    </div>
                    <!-- /.text -->
                </div>
                <!-- /.product -->
            </div>
                        @endforeach
                    @endforeach
                @endif
            @endforeach
        </div>
    </div>
</div>