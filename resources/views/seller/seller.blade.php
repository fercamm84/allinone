@extends('layouts.details')

@section('details')

    <div class="col-md-9">
        <section class="single_product_details_area section_padding_0_100">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="single_product_thumb">
                            <div id="product_details_slider" class="carousel slide" data-ride="carousel">

                                <ol class="carousel-indicators">
                                    @if(sizeof($seller->entity->imageEntities)>0)
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
                                    @if(sizeof($seller->entity->imageEntities)>0)
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
                                    <div class="card-header" role="tab" id="headingThree">
                                        <h6 class="mb-0">
                                            <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Reservas</a>
                                        </h6>
                                    </div>
                                    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                                        <div class="card-body">
                                            @if($seller->reservations == 2 && !empty($sellerProducts))
                                                <script src="{{asset('js/datetimepicker/jquery.datetimepicker.js') }}"></script>
                                                <link href="{{asset('css/datetimepicker/jquery.datetimepicker.css') }}" rel="stylesheet">
                                                <div class="row">
                                                    <!-- {{ Form::open(array('id' => 'formulario', 'action' => 'SellerShowController@reserve', 'class' => 'col-xs-12')) }} -->
                                                    {{ Form::open(array('id' => 'formulario', 'action' => 'BasketController@add', 'class' => 'col-xs-12')) }}
                                                        <p class="text-center buttons">
                                                            {{ Form::hidden('seller_id', $seller->id) }}
                                                            {{ Form::hidden('product_id', $sellerProducts->product_id) }}
                                                            <?php //$max_reservas = $sellerDay!=null ? $sellerDay->total : 10; ?>
                                                            <?php $max_reservas = 1; ?>
                                                            <div style="display: none;">Asientos:&nbsp;{{ Form::number('number_of_reservations', 1, ['class' => 'form-control', 'style' => 'width: 50px !important; display: inline;', 'maxlength' => 2, 'min' => '1', 'max' => $max_reservas, 'required' => true]) }}</div>
                                                            {{ Form::hidden('day_selected', '', ['id' => 'day_selected']) }}
                                                            <input type="text" id="datetimepicker" name="fecha_reserva"/>
                                                            <button class='btn btn-primary' type='submit' value='submit' style="margin-top:3%;">
                                                                <i class='fa fa-user'></i> Reservar por ${{$sellerProducts->product->price}}
                                                            </button>
                                                        </p>
                                                    {{ Form::close() }}
                                                </div>
                                                <script>
                                                    let availableDays = <?php echo $availableDays; ?>;
                                                    let allowDates = [];
                                                    let defaultDate = null;
                                                    $.each(availableDays, function( fecha, horas ) {
                                                        if(defaultDate == null){
                                                            defaultDate = fecha
                                                        }
                                                        allowDates.push(fecha)
                                                    });
                                                    $('#datetimepicker').datetimepicker({
                                                        inline:true,
                                                        allowDates:allowDates,
                                                        formatDate:'Y-m-d',
                                                        format:	'Y-m-d H:i',
                                                        defaultDate: defaultDate
                                                    });
                                                    var logic = function( currentDateTime ){
                                                        let datetimepicker = this
                                                        $.each(availableDays, function( fecha, horas ) {
                                                            allowDates.push(fecha)
                                                            if( currentDateTime.getFullYear()+'-'+(currentDateTime.getMonth()+1+'').padStart(2,'0')+'-'+(currentDateTime.getDate()+'').padStart(2,'0') == fecha ){
                                                                datetimepicker.setOptions({
                                                                    inline:true,
                                                                    allowTimes:horas,
                                                                    formatDate:	'Y-m-d',
                                                                    format:	'Y-m-d H:i',
                                                                });
                                                            }
                                                        });
                                                    };
                                                    $('#datetimepicker').datetimepicker({
                                                        onSelectDate:logic,
                                                        onGenerate:logic,
                                                    });
                                                    // https://xdsoft.net/jqplugins/datetimepicker/
                                                </script>
                                            @elseif($seller->reservations == 2)
                                                <script src="{{asset('js/datetimepicker/jquery.datetimepicker.js') }}"></script>
                                                <link href="{{asset('css/datetimepicker/jquery.datetimepicker.css') }}" rel="stylesheet">
                                                <div class="row">
                                                    {{ Form::open(array('id' => 'formulario', 'action' => 'SellerShowController@reservation', 'class' => 'col-xs-6')) }}
                                                        <p class="text-center buttons">
                                                            {{ Form::hidden('seller_id', $seller->id) }}
                                                            <?php $max_reservas = $sellerDay!=null ? $sellerDay->total : 10; ?>
                                                            Cantidad de personas: {{ Form::number('number_of_reservations', 1, ['class' => 'form-control', 'min' => '1', 'max' => $max_reservas, 'required' => true]) }}
                                                            {{ Form::hidden('day_selected', '', ['id' => 'day_selected']) }}
                                                            <div id="datepicker"></div>
                                                            <button class='btn btn-primary' type='submit' value='submit' style="margin-top:3%;">
                                                                <i class='fa fa-user'></i> Reservar
                                                            </button>
                                                        </p>
                                                    {{ Form::close() }}
                                                </div>
                                            @else
                                                No hay fechas disponibles de reservas.
                                            @endif
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

    <div class="col-md-9">
        <section class="new_arrivals_area section_padding_100_0 clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="section_heading text-center">
                                <h2>Categorías</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row karl-new-arrivals" style="position: relative; height: 1813.5px;">
                        @include('search.search')
                    </div>
                </div>
        </section>
    </div>

@endsection
