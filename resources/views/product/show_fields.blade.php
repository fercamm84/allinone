<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{!! $product->description !!}</p>
</div>

<!-- Short Description Field -->
<div class="form-group">
    {!! Form::label('short_description', 'Short Description:') !!}
    <p>{!! $product->short_description !!}</p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{!! $product->title !!}</p>
</div>

<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', 'Price:') !!}
    <p>{!! $product->price !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $product->name !!}</p>
</div>

<!-- Stock Field -->
<div class="form-group">
    {!! Form::label('stock', 'Stock:') !!}
    <p>{!! $product->stock - $stock_solicitado !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'Vendedor:') !!}
    <p>{!! $product->user->nickname !!}</p>
</div>

{{ Form::open(array('id' => 'formulario', 'action' => 'BasketController@add')) }}
    {{ Form::hidden('product_id', $product->id) }}
    {{ Form::number('stock', 1, ['class' => 'form-control', 'min' => '1', 'max' => $product->stock - $stock_solicitado, 'required' => true]) }}
    {{ Form::submit('Comprar', ['class' => 'btn btn-primary']) }}
{{ Form::close() }}


