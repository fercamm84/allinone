<div class="container">
    <div class="col-md-12">
        <div id="main-slider">
            <div class="item">
                <img src="img/main-slider1.jpg" alt="" class="img-responsive">
            </div>
            <div class="item">
                <img class="img-responsive" src="img/main-slider2.jpg" alt="">
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
                    @foreach($section->sectionEntities as $sectionEntity)
                        <?php $category = $sectionEntity->entity->entidad(); ?>
                        <div class="item">
                            <div class="product">
                                @if(sizeof($category->entity->imageEntities)>0)
                                    <div class="flip-container">
                                        <div class="flipper">
                                            <div class="front">
                                                <a href="/cat/{{ $category->id }}">
                                                    <img src="{{ asset('imagenes/'.$category->entity->imageEntities{0}->image->name) }}" class="img-responsive">
                                                </a>
                                            </div>
                                            @if(sizeof($category->entity->imageEntities)>1)
                                                <div class="back">
                                                    <a href="/cat/{{ $category->id }}">
                                                        <img src="{{ asset('imagenes/'.$category->entity->imageEntities{1}->image->name) }}" class="img-responsive">
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <div class="flip-container">
                                        <div class="front">
                                            <a href="/cat/{{ $category->id }}">
                                                <img src="{{ asset('/img/default-no-image.png')}}" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="/cat/{{ $category->id }}">
                                                <img src="{{ asset('/img/default-no-image.png')}}" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                @endif
                                <a href="/cat/{{ $category->id }}" class="invisible" >
                                    <img src="{{ asset('/img/default-no-image.png')}}" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3><a href="/cat/{{ $category->id }}">{{ $category->description }} </a></h3>
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