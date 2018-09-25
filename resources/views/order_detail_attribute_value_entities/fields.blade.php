<!-- Attribute Value Entity Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('attribute_value_entity_id', 'Attribute Value Entity Id:') !!}
    {!! Form::number('attribute_value_entity_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Order Detail Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order_detail_id', 'Order Detail Id:') !!}
    {!! Form::number('order_detail_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('orderDetailAttributeValueEntities.index') !!}" class="btn btn-default">Cancel</a>
</div>
