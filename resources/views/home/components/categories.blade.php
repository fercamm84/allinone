<section class="top-discount-area d-md-flex align-items-center">
    <!-- Single Discount Area -->
    <div class="single-discount-area">
        <h5>Free Shipping &amp; Returns</h5>
        <h6><a href="#">BUY NOW</a></h6>
    </div>
    <!-- Single Discount Area -->
    <div class="single-discount-area" style="background:#d8a633 !important;">
        <h5>20% Discount for all dresses</h5>
        <h6>USE CODE: Colorlib</h6>
    </div>
    <!-- Single Discount Area -->
    <div class="single-discount-area">
        <h5>20% Discount for students</h5>
        <h6>USE CODE: Colorlib</h6>
    </div>
</section>

<div id="wrapper">
    <!-- ****** Welcome Slides Area Start ****** -->
    <section class="welcome_area">
        <div class="welcome_slides owl-carousel">
            @foreach($sections as $section)
                @if($section->type == 'home_slider')
                    @foreach($section->sectionEntities as $sectionEntity)
                        <?php $entidad = $sectionEntity->entity->entidad(); ?>
                        <!-- Single Slide Start -->
                        <div class="single_slide height-800 bg-img background-overlay" style="background-image: url({{ asset('imagenes/'.$entidad->entity->imageEntities{0}->image->name) }});">
                            <div class="container h-100">
                                <div class="row h-100 align-items-center">
                                    <div class="col-12">
                                        <div class="welcome_slide_text">
                                            <h6 data-animation="bounceInDown" data-delay="0" data-duration="500ms">{{$entidad->subtitle}}</h6>
                                            <h2 data-animation="fadeInUp" data-delay="500ms" data-duration="500ms">{{$entidad->title}}</h2>
                                            <a href="#" class="btn karl-btn" data-animation="fadeInUp" data-delay="1s" data-duration="500ms">conocer más</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            @endforeach
        </div>
    </section>
    <!-- ****** Welcome Slides Area End ****** -->

    <!-- ****** Top Catagory Area Start ****** -->
    <section class="top_catagory_area d-md-flex clearfix">
        <!-- Single Catagory -->
        <div class="single_catagory_area d-flex align-items-center bg-img" style="background-image: url(https://sm.askmen.com/askmen_latam/photo/default/cerveza-hamburguesa-equivalencia_cqdp.jpg);">
            <div class="catagory-content">
                <h6>On Accesories</h6>
                <h2>Sale 30%</h2>
                <a href="#" class="btn karl-btn">SHOP NOW</a>
            </div>
        </div>
        <!-- Single Catagory -->
        <div class="single_catagory_area d-flex align-items-center bg-img" style="background-image: url(https://mlm-s1-p.mlstatic.com/684504-MLM25680669188_062017-F.jpg);">
            <div class="catagory-content">
                <h6>in Bags excepting the new collection</h6>
                <h2>Designer bags</h2>
                <a href="#" class="btn karl-btn">SHOP NOW</a>
            </div>
        </div>
    </section>
    <!-- ****** Top Catagory Area End ****** -->
</div>

<div id="hot">

    <?php $mostrarCategorias = true; ?>
    @foreach($sections as $section)
        @if($section->type == 'home_principal')
            @foreach($section->sectionEntities as $sectionEntity)
                <?php $entidad = $sectionEntity->entity->type != 'category'; ?>
                <?php $mostrarCategorias = false; ?>
            @endforeach
        @endif
    @endforeach
    @if($mostrarCategorias)
        <div class="box">
            <div class="container">
                <div class="col-md-12">
                    <h2>Categorias</h2>
                </div>
            </div>
        </div>
    @endif


    @foreach($sections as $section)
        @if($section->type == 'home_principal')
            @foreach($section->sectionEntities as $sectionEntity)
                <?php $entidad = $sectionEntity->entity; ?>

                <!-- ****** Quick View Modal Area Start ****** -->
                <div class="modal fade quickview" id="quickview{{ $entidad->id }}" tabindex="-1" role="dialog" aria-labelledby="quickview" aria-hidden="true">
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
                                                    @if(sizeof($entidad->imageEntities)>0)
                                                        <img src="{{ asset('imagenes/'.$entidad->imageEntities{0}->image->name) }}" alt="">
                                                    @else
                                                        <img src="{{ asset('/img/default-no-image.png')}}" alt="">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-7">
                                                <div class="quickview_pro_des">
                                                    <h4 class="title">{{ $entidad->entidad()->title }}</h4>
                                                    <div class="top_seller_product_rating mb-15">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>
                                                    <h5 class="price">{{ $entidad->entidad()->subtitle }}</h5>
                                                    <p>{{ $entidad->description }}</p>
                                                    
                                                    <a href="/entity/{{ $entidad->id }}">Ver más</a>

                                                    <p>{{ $entidad->entidad()->description }}</p>

                                                    <div class="share_wf mt-30">
                                                        <p>Share With Friend</p>
                                                        <div class="_icon">
                                                            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                                            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                                            <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                                            <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
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
                <!-- ****** Quick View Modal Area End ****** -->

            @endforeach
        @endif
    @endforeach


    <!-- ****** Bares Start ****** -->
    <section class="new_arrivals_area section_padding_100_0 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_heading text-center">
                        <h2>Servicios y profesionales destacados</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- FILTRO por BARRIOS (location) -->
        <div class="karl-projects-menu mb-100">
            <div class="text-center portfolio-menu">
                <button class="btn active" data-filter="*">TODAS</button>
                <?php $locations = array(); ?>
                @foreach($sections as $section)
                    @if($section->type == 'home_principal')
                        @foreach($section->sectionEntities as $sectionEntity)
                            <?php $entidad = $sectionEntity->entity->entidad(); ?>
                            <?php array_push($locations, $entidad->entity->location); ?>
                        @endforeach
                        <?php $locations = array_unique($locations); ?>
                    @endif
                @endforeach
                @foreach($locations as $location)
                    @if(!empty($location))
                        <button class="btn" data-filter=".filtro_dinamico_{{ $location->id }}">{{ $location->description }}</button>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="container">
            <div class="row karl-new-arrivals">

                @foreach($sections as $section)
                    @if($section->type == 'home_principal')
                        @foreach($section->sectionEntities as $sectionEntity)
                            <?php $entidad = $sectionEntity->entity; ?>
                            @if(!empty($entidad->location))
                                <div class="col-12 col-sm-6 col-md-4 single_gallery_item filtro_dinamico_{{ $entidad->location->id }} wow fadeInUpBig" data-wow-delay="0.2s">
                                    <!-- Product Image -->
                                    <div class="product-img">
                                        @if(sizeof($entidad->imageEntities)>0)
                                            <img src="{{ asset('imagenes/'.$entidad->imageEntities{0}->image->name) }}" alt="">
                                            <div class="product-quicview">
                                                <a href="/entity/{{ $entidad->id }}" data-toggle="modal" data-target="#quickview{{ $entidad->id }}"><i class="ti-plus"></i></a>
                                            </div>
                                        @else
                                            <img src="{{ asset('/img/default-no-image.png')}}" alt="">
                                            <div class="product-quicview">
                                                <a href="/entity/{{ $entidad->id }}" data-toggle="modal" data-target="#quickview{{ $entidad->id }}"><i class="ti-plus"></i></a>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Product Description -->
                                    <div class="product-description">
                                        <h4 class="product-price">{{ $entidad->entidad()->title }}</h4>
                                        <p>{{ $entidad->entidad()->description }}</p>
                                        <a href="/entity/{{ $entidad->id }}" class="add-to-cart-btn" data-toggle="modal" data-target="#quickview{{ $entidad->id }}">Ver más</a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                @endforeach

            </div>
        </div>
    </section>
    <!-- ****** New Arrivals Area End ****** -->

</div>