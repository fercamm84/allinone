<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Short Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('short_description', 'Short Description:') !!}
    {!! Form::text('short_description', null, ['class' => 'form-control']) !!}
</div>

<!-- Link Facebook Field -->
<div class="form-group col-lg-12">
    {!! Form::label('link_facebook', 'Link Facebook:') !!}
    {!! Form::text('link_facebook', null, ['class' => 'form-control']) !!}
</div>

<!-- Link Twitter Field -->
<div class="form-group col-lg-12">
    {!! Form::label('link_twitter', 'Link Twitter:') !!}
    {!! Form::text('link_twitter', null, ['class' => 'form-control']) !!}
</div>

<!-- Link Instagram Field -->
<div class="form-group col-lg-12">
    {!! Form::label('link_instagram', 'Link Instagram:') !!}
    {!! Form::text('link_instagram', null, ['class' => 'form-control']) !!}
</div>

<!-- Link external Field -->
<div class="form-group col-lg-12">
    {!! Form::label('link_external', 'Link external:') !!}
    {!! Form::text('link_external', null, ['class' => 'form-control']) !!}
</div>

<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::number('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Order Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order', 'Order:') !!}
    {!! Form::number('order', null, ['class' => 'form-control']) !!}
</div>

<!-- Visible Field -->
<div class="form-group col-sm-6">
    {!! Form::label('visible', 'Visible:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('visible', false) !!}
        {!! Form::checkbox('visible', '1', null) !!} 1
    </label>
</div>

<!-- Stock Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stock', 'Stock:') !!}
    {!! Form::number('stock', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- ProductImage -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'New image:') !!}
    {!! Form::file('image') !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('products.index') !!}" class="btn btn-default">Cancel</a>
</div>
