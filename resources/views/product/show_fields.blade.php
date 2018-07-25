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

<!-- Link Facebook Field -->
<div class="form-group">
    {!! Form::label('link_facebook', 'Link Facebook:') !!}
    <p>{!! $product->link_facebook !!}</p>
</div>

<!-- Link Twitter Field -->
<div class="form-group">
    {!! Form::label('link_twitter', 'Link Twitter:') !!}
    <p>{!! $product->link_twitter !!}</p>
</div>

<!-- Link Instagram Field -->
<div class="form-group">
    {!! Form::label('link_instagram', 'Link Instagram:') !!}
    <p>{!! $product->link_instagram !!}</p>
</div>

<!-- Link external Field -->
<div class="form-group">
    {!! Form::label('link_external', 'Link external:') !!}
    <p>{!! $product->link_external !!}</p>
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



