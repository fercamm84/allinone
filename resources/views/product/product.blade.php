@extends('layouts.details')

@section('content')

    @include('components.breadcrumb')

    <!-- <<<<<<<<<<<<<<<<<<<< Single Product Details Area Start >>>>>>>>>>>>>>>>>>>>>>>>> -->
    <section class="single_product_details_area section_padding_0_100">
        <div class="container">
            <div class="row">

                <div class="col-12 col-md-6">
                    <div class="single_product_thumb">
                        <div id="product_details_slider" class="carousel slide" data-ride="carousel">

                            <ol class="carousel-indicators">
                                @if(sizeof($product->entity->imageEntities)>0)
                                    <?php $i = 0; ?>
                                    @foreach($product->entity->imageEntities as $imageEntity)
                                        <?php if ($i == 0) { ?>
                                            <li class="active" data-target="#product_details_slider" data-slide-to="{{ $i }}" style="background-image: url({{ asset('imagenes/'.$imageEntity->image->name) }});"></li>
                                        <?php } else { ?>
                                            <li data-target="#product_details_slider" data-slide-to="{{ $i }}" style="background-image: url({{ asset('imagenes/'.$imageEntity->image->name) }});"></li>
                                        <?php } ?>
                                        <?php $i++; ?>
                                    @endforeach
                                @else
                                    <li class="active" data-target="#product_details_slider" data-slide-to="0" style="background-image: url({{ asset('/img/default-no-image.png') }});"></li>
                                @endif
                            </ol>

                            <div class="carousel-inner">
                                @if(sizeof($product->entity->imageEntities)>0)
                                    <?php $i = 0; ?>
                                    @foreach($product->entity->imageEntities as $imageEntity)
                                        <?php if ($i == 0) { ?>
                                            <div class="carousel-item active">
                                                <a class="gallery_img" href="{{ asset('imagenes/'.$imageEntity->image->name) }}">
                                                    <img class="d-block w-100" src="{{ asset('imagenes/'.$imageEntity->image->name) }}" alt="{{ $imageEntity->image->name }}">
                                                </a>
                                            </div>
                                        <?php } else { ?>
                                            <div class="carousel-item">
                                                <a class="gallery_img" href="{{ asset('imagenes/'.$imageEntity->image->name) }}">
                                                    <img class="d-block w-100" src="{{ asset('imagenes/'.$imageEntity->image->name) }}" alt="{{ $imageEntity->image->name }}">
                                                </a>
                                            </div>
                                            <li data-target="#product_details_slider" data-slide-to="{{ $i }}" style="background-image: url({{ asset('imagenes/'.$imageEntity->image->name) }});"></li>
                                        <?php } ?>
                                        <?php $i++; ?>
                                    @endforeach
                                @else
                                    <div class="carousel-item active">
                                        <a class="gallery_img" href="{{ asset('/img/default-no-image.png') }}">
                                            <img class="d-block w-100" src="{{ asset('/img/default-no-image.png') }}" alt="First slide">
                                        </a>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="single_product_desc">

                        <h4 class="title"><a href="#">{!! $product->title !!}</a></h4>

                        <!-- <h4 class="price">$ {!! $product->price !!}</h4> -->

                        <p class="available">Available: <span class="text-muted">In Stock</span></p>

                        <div class="single_product_ratings mb-15">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                        </div>

                        {{ Form::open(array('id' => 'formulario', 'action' => 'BasketController@add')) }}
                            
                            @include('product.components.attributes')

                            
                            <h2 class="mb-50 price">$<span id="price">{!! $product->price !!}</span></h2>

                            <div class="cart clearfix mb-50 d-flex">
                                <p class="text-center buttons">
                                    {{ Form::hidden('product_id', $product->id) }}

                                    <div class="quantity">
                                        <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                        <input type="number" class="qty-text" id="qty" step="1" min="1" max="{{ $product->stock - $stock_solicitado }}" name="stock" value="1">
                                        <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) && qty < {{ $product->stock - $stock_solicitado }}) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                    </div>
                                    <button type="submit" name="addtocart" value="5" class="btn cart-submit d-block">Add to cart</button>
                                </p>
                            </div>

                            <div class="share_wf mt-30">
                                <p>Share With Friend</p>
                                <div class="_icon">
                                    @if($product->link_facebook != null)
                                        <a class="post_share_facebook external facebook" data-animate-hover="pulse" href="{{ $product->link_facebook }}"><i class="fa fa-facebook"></i></a>
                                    @endif
                                    <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        {{ Form::close() }}

                        <div id="accordion" role="tablist">

                            <div class="card">
                                <div class="card-header" role="tab" id="headingOne">
                                    <h6 class="mb-0">
                                        <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Information 1</a>
                                    </h6>
                                </div>

                                <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        <p>{{ $product->description }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" role="tab" id="headingTwo">
                                    <h6 class="mb-0">
                                        <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Information 2</a>
                                    </h6>
                                </div>
                                <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="card-body">
                                        <p>{{ $product->description }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <<<<<<<<<<<<<<<<<<<< Single Product Details Area End >>>>>>>>>>>>>>>>>>>>>>>>> -->

@endsection
