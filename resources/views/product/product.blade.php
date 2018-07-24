@extends('layouts.details')

@section('details')

    <div class="col-md-9">

        <div class="row" id="productMain">
            <div class="col-sm-6">
                <div id="mainImage">
                    @if(sizeof($product->imageProducts)>0)
                        <img src="{{ asset('imagenes/'.$product->imageProducts{0}->image->name) }}"alt="" class="img-responsive">
                    @else
                        <img src="{{ asset('/img/default-no-image.png') }}"alt="" class="img-responsive">
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="box">
                    <h1 class="text-center">{!! $product->title !!}</h1>
                    <p class="goToDescription">
                        <a href="#details" class="scroll-to">Ir a ver detalle del producto</a>
                    </p>
                    <p class="price">${!! $product->price !!}</p>

                    <p class="text-center buttons">
                        {{ Form::open(array('id' => 'formulario', 'action' => 'BasketController@add')) }}
                        {{ Form::hidden('product_id', $product->id) }}
                        {{ Form::number('stock', 1, ['class' => 'form-control', 'min' => '1', 'max' => $product->stock - $stock_solicitado, 'required' => true]) }}
                        <button class='btn btn-primary' type='submit' value='submit'>
                            <i class='fa fa-shopping-cart'></i> Add to cart
                        </button>
                        {{ Form::close() }}
                    </p>


                </div>

                <div class="row" id="thumbs">
                    @foreach($product->imageProducts as $imageProduct)
                        <div class="col-xs-4">
                            <a href="{{ asset('imagenes/'.$imageProduct->image->name) }}" class="thumb">
                                <img src="{{ asset('imagenes/'.$imageProduct->image->name) }}" alt="" class="img-responsive">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>


        <div class="box" id="details">
            <p>
            <h4>{!! $product->name !!}</h4>
            <p>{!! $product->short_description !!}</p>
            <h4>Precio</h4>
            <ul>
                <li>$ {!! $product->price !!}</li>
            </ul>
            <h4>Stock Disponible</h4>
            <ul>
                <li>{!! $product->stock !!}</li>
            </ul>

            <blockquote>
                <p><em>{!! $product->description !!}</em>
                </p>
            </blockquote>

            <hr>
            <div class="social">
                <h4>Show it to your friends</h4>
                <p>
                    @if($product->link_facebook != null)
                        <a class="post_share_facebook external facebook" data-animate-hover="pulse" href="{{ $product->link_facebook }}"><i class="fa fa-facebook"></i></a>
                    @endif
                    <a href="#" class="external gplus" data-animate-hover="pulse"><i class="fa fa-google-plus"></i></a>
                    <a href="#" class="external twitter" data-animate-hover="pulse"><i class="fa fa-twitter"></i></a>
                    <a href="#" class="email" data-animate-hover="pulse"><i class="fa fa-envelope"></i></a>
                </p>
            </div>
        </div>
    </div>
    <!-- /.col-md-9 -->
    </div>




{{--
    <section class="content-header">
        <h1>
            Product
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('product.show_fields')
                    @foreach($product->imageProducts as $imageProduct)
                        <img src="{{ asset(imageness/'.$imageProduct->image->name) }}" width="500px" height="500px">
                    @endforeach
                    {{ Form::open(array('id' => 'formulario', 'action' => 'BasketController@add')) }}
                        {{ Form::hidden('product_id', $product->id) }}
                        {{ Form::number('stock', 1, ['class' => 'form-control', 'min' => '1', 'max' => $product->stock - $stock_solicitado, 'required' => true]) }}
                        {{ Form::submit('Comprar', ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
--}}
@endsection
