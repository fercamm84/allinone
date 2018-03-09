<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $categoryAttribute->id !!}</p>
</div>

<!-- Category Id Field -->
<div class="form-group">
    {!! Form::label('category_id', 'Category Id:') !!}
    <p>{!! $categoryAttribute->category_id !!}</p>
</div>

<!-- Attribute Id Field -->
<div class="form-group">
    {!! Form::label('attribute_id', 'Attribute Id:') !!}
    <p>{!! $categoryAttribute->attribute_id !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $categoryAttribute->updated_at !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $categoryAttribute->created_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $categoryAttribute->deleted_at !!}</p>
</div>

