@extends('layouts.details')

@section('details')

    <div class="col-xs-12">
        <h1>{{ $entity_root->entidad()->description }}</h1>
    </div>

    @if(isset($entity_root) && in_array($entity_root->type, array('seller', 'product')))
        @render($entity_root->type, ['entity_id' => $entity_root->id])
    @endif

    @foreach($entity_children as $entityEntity)
        <?php $entity = $entityEntity->child_entity; ?>
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


@endsection
