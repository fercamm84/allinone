@extends('layouts.details')

@section('details')

    <script>
        $( function() {
            $( "#datepicker" ).datepicker({ minDate: 1, maxDate: "+0M +15D" });
            $('#day_selected').val($( "#datepicker" ).datepicker("option", "dateFormat", 'yy-mm-dd').val());
        } );

        $('#datepicker').change(function() {
            $('#day_selected').val($( "#datepicker" ).datepicker("option", "dateFormat", 'yy-mm-dd').val());
        });
    </script>

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
                                            <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Primer información del BAR</a>
                                        </h6>
                                    </div>
                                    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <p>{{ $seller->subtitle }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" role="tab" id="headingTwo">
                                        <h6 class="mb-0">
                                            <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Segunda información del BAR</a>
                                        </h6>
                                    </div>
                                    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body">
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
                                            @if($seller->reservations)
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
                                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13163.760663524647!2d-58.57393564469936!3d-34.428274933330194!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bca59cdfeb7b29%3A0x772afb6b26289992!2sItalia+461%2C+B1648EEE+Tigre%2C+Buenos+Aires!5e0!3m2!1ses-419!2sar!4v1531848018812"   height="380" frameborder="0" style="border-bottom:4px solid #362f2d; border-top:1px solid #CCC; border-right:1px solid #CCC; border-left:1px solid #CCC; width:inherit !important;" allowfullscreen></iframe>
                                                    </div>

                                                    <div class="col-md-6" style="margin-top:-3%; margin-bottom:4%;">
                                                        <h6>Tigre, Buenos Aires, Argentina<h6>
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
