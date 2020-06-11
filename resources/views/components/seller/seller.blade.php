<div class="col-md-12">
    <section class="single_product_details_area section_padding_0_100">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="single_product_thumb">
                        <div id="product_details_slider" class="carousel slide" data-ride="carousel">

                            <ol class="carousel-indicators">
                                @if(sizeof($seller->entity->imageEntities) > 0)
                                    <?php $i = 0; ?>
                                    @foreach($seller->entity->imageEntities as $imageEntity)
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
                                @if(sizeof($seller->entity->imageEntities) > 0)
                                    <?php $i = 0; ?>
                                    @foreach($seller->entity->imageEntities as $imageEntity)
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

                        <h4 class="title"><a href="#">{!! $seller->title !!}</a></h4>

                        <div id="accordion" role="tablist">

                            <div class="card">
                                <div class="card-header" role="tab" id="headingOne">
                                    <h6 class="mb-0">
                                        <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">+ info</a>
                                    </h6>
                                </div>
                                <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        <p>{{ $seller->subtitle }}</p>
                                        <p>{{ $seller->description }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" role="tab" id="headingFour">
                                    <h6 class="mb-0">
                                        <a class="collapsed" data-toggle="collapse" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">Ubicación</a>
                                    </h6>
                                </div>
                                <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour" data-parent="#accordion">
                                    <div class="card-body">
                                        <div id="content">
                                            <div class="container">
                                                UBICACIÓN

                                                <div class="google-maps" style="width:inherit !important; text-align:center !important;">
                                                    <iframe src="https://maps.google.com/maps?width=700&amp;height=440&amp;hl=en&amp;q=B1870CJD%2C%20Corbatta%20Oreste%20Omar%2028%2C%20B1870CJD%20Avellaneda%2C%20Buenos%20Aires+(Estadio%20Racing%20Club%20Avellaneda)&amp;ie=UTF8&amp;t=&amp;z=16&amp;iwloc=B&amp;output=embed"   height="380" frameborder="0" style="border-bottom:4px solid #362f2d; border-top:1px solid #CCC; border-right:1px solid #CCC; border-left:1px solid #CCC; width:inherit !important;" allowfullscreen></iframe>
                                                </div>

                                                <div class="col-md-6" style="margin-top:-3%; margin-bottom:4%;">
                                                    <h6>dirección...<h6>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@if(!empty($products))

    <div class="col-12">
        <h3>Servicios / Productos</h3>
        <BR>
    </div>

    @foreach($products as $product)
        <?php $entity = $product->entity; ?>
        <!-- Single gallery Item -->
        <div class="col-12 col-sm-6 col-lg-4 single_gallery_item wow fadeInUpBig" data-wow-delay="0.2s">
            <!-- Product Image -->
            <div class="product-img">
                @if(sizeof($entity->imageEntities)>0)                
                    <img src="{{ asset('imagenes/'.$entity->imageEntities{0}->image->name) }}" alt="">
                @else
                    <img src="{{ asset('/img/default-no-image.png') }}" alt="">
                @endif
                <div class="product-quicview">
                    <a href="/{!! $entity->url() !!}/{!! $entity->id !!}" data-toggle="modal" data-target="#quickview{{ $entity->id }}"><i class="ti-plus"></i></a>
                </div>
            </div>
            <!-- Product Description -->
            <div class="product-description">
                <h4 class="product-price">{!! $entity->entidad()->title !!}</h4>
                <p>{{ $entity->entidad()->short_description }}</p>
                @if($entity->getClassType() == 'product')
                    <h5 class="price">${!! $entity->entidad()->price !!} <span><!--{!! $entity->entidad()->price !!}--></span></h5>
                @endif
                <!-- Add to Cart -->
                <a href="/{!! $entity->url() !!}/{!! $entity->id !!}" class="add-to-cart-btn">Ver detalle</a>
            </div>
        </div>

        <!-- ****** Quick View Modal Area Start ****** -->
        <div class="modal fade quickview" id="quickview{{ $entity->id }}" tabindex="-1" role="dialog" aria-labelledby="quickview" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                    <div class="modal-body">
                        <div class="quickview_body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <div class="quickview_pro_img">
                                            @if(sizeof($entity->imageEntities)>0)                
                                                <img src="{{ asset('imagenes/'.$entity->imageEntities{0}->image->name) }}" alt="">
                                            @else
                                                <img src="{{ asset('/img/default-no-image.png') }}" alt="">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="quickview_pro_des">
                                            <h4 class="title">{!! $entity->entidad()->name !!}</h4>
                                            <div class="top_seller_product_rating mb-15">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </div>
                                            @if($entity->getClassType() == 'product')
                                                <h5 class="price">${!! $entity->entidad()->price !!} <span><!--{!! $entity->entidad()->price !!}--></span></h5>
                                            @endif
                                            <p>{{ $entity->description }}</p>
                                            <a href="/{!! $entity->url() !!}/{!! $entity->id !!}">Ver detalle</a>
                                        </div>
                                        <!-- Add to Cart Form -->
                                        <!-- <form class="cart" method="post">
                                            <div class="quantity">
                                                <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>

                                                <input type="number" class="qty-text" id="qty" step="1" min="1" max="12" name="quantity" value="1">

                                                <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                            </div>
                                            <button type="submit" name="addtocart" value="5" class="cart-submit">Add to cart</button>
                                                                                    
                                            <div class="modal_pro_wishlist">
                                                <a href="wishlist.html" target="_blank"><i class="ti-heart"></i></a>
                                            </div>
                                            
                                            <div class="modal_pro_compare">
                                                <a href="compare.html" target="_blank"><i class="ti-stats-up"></i></a>
                                            </div>
                                        </form>

                                        <div class="share_wf mt-30">
                                            <p>Share With Friend</p>
                                            <div class="_icon">
                                                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                                            </div>
                                        </div> -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ****** Quick View Modal Area End ****** -->

    @endforeach

@endif