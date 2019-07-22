@extends('layouts.base')

@section('content')

<div id="wrapper">
    
    <!-- <<<<<<<<<<<<<<<<<<<< Breadcumb Area Start <<<<<<<<<<<<<<<<<<<< -->
    <div class="breadcumb_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ol class="breadcrumb d-flex align-items-center">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        @if(isset($seller))
                            <li class="breadcrumb-item"><a href="/seller/{{ $seller->id }}">{{ $seller->title}}</a></li>
                            @if(isset($category))
                                <li class="breadcrumb-item"><a href="/cat/{{ $category->id }}">{{ $category->title}}</a></li>
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

    <section class="shop_grid_area">
        <div class="container">
            <div class="row">

                <div class="col-12 col-md-4 col-lg-3">
                    <div class="shop_sidebar_area">
                        
                        <div class="widget catagory mb-50">
                            <!--  Side Nav  -->
                            <div class="nav-side-menu">
                                <h5 class="mb-0">Catagories</h5>
                                <div class="menu-list">
                                    <ul id="menu-content2" class="menu-content collapse out">
                                        <!-- Single Item -->

                                        @if(isset($categories))
                                            @foreach($categories as $category)
                                                <li data-toggle="collapse" data-target="#women2">
                                                    <a href="/cat/{{ $category->id }}">{{ $category->title }}</a>
                                                    <!-- <ul class="sub-menu collapse show" id="women2">
                                                        <li><a href="/cat/{{ $category->id }}">{{ $category->description }}</a></li>
                                                    </ul> -->
                                                </li>
                                            @endforeach
                                        @else
                                            @foreach($sections as $section)
                                                @if($section->type == 'home_principal')
                                                    @foreach($section->sectionEntities as $sectionEntity)
                                                        <?php $category = $sectionEntity->entity->entidad(); ?>
                                                        <li data-toggle="collapse" data-target="#women2">
                                                            <a href="/cat/{{ $category->id }}">{{ $category->title }}</a>
                                                            <!-- <ul class="sub-menu collapse show" id="women2">
                                                                <li><a href="/cat/{{ $category->id }}">{{ $category->description }}</a></li>
                                                            </ul> -->
                                                        </li>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-8 col-lg-9">
                    <div class="shop_grid_product_area">
                        <div class="row">

                            @yield('details')

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>

@endsection
