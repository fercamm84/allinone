<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $attributeEntity->id !!}</p>
</div>

<!-- Entity Id Field -->
<div class="form-group">
    {!! Form::label('entity_id', 'Entity Id:') !!}
    <p>{!! $attributeEntity->entity_id !!}</p>
</div>

<!-- Attribute Id Field -->
<div class="form-group">
    {!! Form::label('attribute_id', 'Attribute Id:') !!}
    <p>{!! $attributeEntity->attribute_id !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $attributeEntity->updated_at !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $attributeEntity->created_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $attributeEntity->deleted_at !!}</p>
</div>

