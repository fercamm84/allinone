   <!-- <<<<<<<<<<<<<<<<<<<< Breadcumb Area Start <<<<<<<<<<<<<<<<<<<< -->
    <div class="breadcumb_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ol class="breadcrumb d-flex align-items-center">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        @if(isset($seller))
                            <li class="breadcrumb-item"><a href="/seller/{{ $seller->id }}">{{ $seller->title }}</a></li>
                            @if(isset($category))
                                <li class="breadcrumb-item"><a href="/cat/{{ $category->id }}">{{ $category->title }}</a></li>
                                @if(isset($product))
                                    <!-- <li class="breadcrumb-item active"><a href="/prod/{{ $product->id }}">{{ $product->description }}</a></li> -->
                                    <li class="breadcrumb-item active">{{ $product->title }}</li>
                                @endif
                            @endif
                        @else
                            @if(isset($category))
                                <li class="breadcrumb-item"><a href="/cat/{{ $category->id }}">{{ $category->title}}</a></li>
                                @if(isset($product))
                                    <!-- <li class="breadcrumb-item active"><a href="/prod/{{ $product->id }}">{{ $product->description }}</a></li> -->
                                    <li class="breadcrumb-item active">{{ $product->title }}</li>
                                @endif
                            @endif
                        @endif
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- <<<<<<<<<<<<<<<<<<<< Breadcumb Area End <<<<<<<<<<<<<<<<<<<< -->