@extends('home.layouts.home')

@section('content')

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
                        <img src="{{ asset('images/'.$imageProduct->image->name) }}" width="500px" height="500px">
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

@endsection
