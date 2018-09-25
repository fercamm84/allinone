<!-- Entity Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('entity_id', 'Entity Id:') !!}
    {!! Form::number('entity_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Attribute Value Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('attribute_value_id', 'Attribute Value Id:') !!}
    {!! Form::number('attribute_value_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('attributeValueEntities.index') !!}" class="btn btn-default">Cancel</a>
</div>
