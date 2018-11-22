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
                                            <h6 data-animation="bounceInDown" data-delay="0" data-duration="500ms">{{$entidad->type}}</h6>
                                            <h2 data-animation="fadeInUp" data-delay="500ms" data-duration="500ms">{{$entidad->description}}</h2>
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
                <?php $entidad = $sectionEntity->entity->entidad(); ?>

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
                                                    @if(sizeof($entidad->entity->imageEntities)>0)
                                                        <img src="{{ asset('imagenes/'.$entidad->entity->imageEntities{0}->image->name) }}" alt="">
                                                    @else
                                                        <img src="{{ asset('/img/default-no-image.png')}}" alt="">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-7">
                                                <div class="quickview_pro_des">
                                                    <h4 class="title">{{ $entidad->description }}</h4>
                                                    <div class="top_seller_product_rating mb-15">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>
                                                    <!-- <h5 class="price">$120.99 <span>$130</span></h5> -->
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia expedita quibusdam aspernatur, sapiente consectetur accusantium perspiciatis praesentium eligendi, in fugiat?</p>
                                                    <a href="/{{ $entidad->url() }}/{{ $entidad->id }}">Entrar a {{ $entidad->description }}</a>
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
                        <h2>Cervecerías artesanales destacadas</h2>
                    </div>
                </div>
            </div>
        </div>

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
                    <button class="btn" data-filter=".location_{{ $location->id }}">{{ $location->description }}</button>
                @endforeach
            </div>
        </div>

        <div class="container">
            <div class="row karl-new-arrivals">

                @foreach($sections as $section)
                    @if($section->type == 'home_principal')
                        @foreach($section->sectionEntities as $sectionEntity)
                            <?php $entidad = $sectionEntity->entity->entidad(); ?>
                            <div class="col-12 col-sm-6 col-md-4 single_gallery_item location_{{ $entidad->entity->location->id }} wow fadeInUpBig" data-wow-delay="0.2s">
                                <!-- Product Image -->
                                <div class="product-img">
                                    @if(sizeof($entidad->entity->imageEntities)>0)
                                        <img src="{{ asset('imagenes/'.$entidad->entity->imageEntities{0}->image->name) }}" alt="">
                                        <div class="product-quicview">
                                            <a href="/{{ $entidad->url() }}/{{ $entidad->id }}" data-toggle="modal" data-target="#quickview{{ $entidad->id }}"><i class="ti-plus"></i></a>
                                        </div>
                                    @else
                                        <img src="{{ asset('/img/default-no-image.png')}}" alt="">
                                        <div class="product-quicview">
                                            <a href="/{{ $entidad->url() }}/{{ $entidad->id }}" data-toggle="modal" data-target="#quickview{{ $entidad->id }}"><i class="ti-plus"></i></a>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Product Description -->
                                <div class="product-description">
                                    <!-- <h4 class="product-price">Belgrano</h4> -->
                                    <a href="/{{ $entidad->url() }}/{{ $entidad->id }}"><p>{{ $entidad->description }}</p></a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach

            </div>
        </div>
    </section>
    <!-- ****** New Arrivals Area End ****** -->

</div>