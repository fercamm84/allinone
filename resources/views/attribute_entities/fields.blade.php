<!-- Entity Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('entity_id', 'Entity Id:') !!}
    {!! Form::number('entity_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Attribute Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('attribute_id', 'Attribute Id:') !!}
    {!! Form::number('attribute_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('attributeEntities.index') !!}" class="btn btn-default">Cancel</a>
</div>
