<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $orderDetailAttributeValue->id !!}</p>
</div>

<!-- Attribute Value Id Field -->
<div class="form-group">
    {!! Form::label('attribute_value_id', 'Attribute Value Id:') !!}
    <p>{!! $orderDetailAttributeValue->attribute_value_id !!}</p>
</div>

<!-- Order Detail Id Field -->
<div class="form-group">
    {!! Form::label('order_detail_id', 'Order Detail Id:') !!}
    <p>{!! $orderDetailAttributeValue->order_detail_id !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $orderDetailAttributeValue->updated_at !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $orderDetailAttributeValue->created_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $orderDetailAttributeValue->deleted_at !!}</p>
</div>

