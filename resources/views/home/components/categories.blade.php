<div class="container">
    <div class="col-md-12">
        <div id="main-slider">
            @foreach($sections as $section)
                @if($section->type == 'home_slider')
                    @foreach($section->sectionEntities as $sectionEntity)
                        <?php $entidad = $sectionEntity->entity->entidad(); ?>
                        <div class="item">
                            <img src="{{ asset('imagenes/'.$entidad->entity->imageEntities{0}->image->name) }}" class="img-responsive">
                        </div>
                    @endforeach
                @endif
            @endforeach
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
                    @foreach($section->sectionEntities as $sectionEntity)
                        <?php $entidad = $sectionEntity->entity->entidad(); ?>
                        <div class="item">
                            <div class="product">
                                @if(sizeof($entidad->entity->imageEntities)>0)
                                    <div class="flip-container">
                                        <div class="flipper">
                                            <div class="front">
                                                <a href="/{{ $entidad->url() }}/{{ $entidad->id }}">
                                                    <img src="{{ asset('imagenes/'.$entidad->entity->imageEntities{0}->image->name) }}" class="img-responsive">
                                                </a>
                                            </div>
                                            @if(sizeof($entidad->entity->imageEntities)>1)
                                                <div class="back">
                                                    <a href="/{{ $entidad->url() }}/{{ $entidad->id }}">
                                                        <img src="{{ asset('imagenes/'.$entidad->entity->imageEntities{1}->image->name) }}" class="img-responsive">
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <div class="flip-container">
                                        <div class="front">
                                            <a href="/{{ $entidad->url() }}/{{ $entidad->id }}">
                                                <img src="{{ asset('/img/default-no-image.png')}}" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="/{{ $entidad->url() }}/{{ $entidad->id }}">
                                                <img src="{{ asset('/img/default-no-image.png')}}" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                @endif
                                <a href="/{{ $entidad->url() }}/{{ $entidad->id }}" class="invisible" >
                                    <img src="{{ asset('/img/default-no-image.png')}}" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3><a href="/{{ $entidad->url() }}/{{ $entidad->id }}">{{ $entidad->description }} </a></h3>
                                </div>
                                <!-- /.text -->
                            </div>
                            <!-- /.product -->
                        </div>
                    @endforeach
                @endif
            @endforeach
        </div>
    </div>
</div>