<tr>
    <td>
        @foreach($orderDetail->product->entity->imageEntities as $imageEntity)
            <img src="{{ asset('imagenes/'.$imageEntity->image->name) }}" width="100px" height="100px">
        @endforeach
    </td>
    <td>
        <p>{{ $orderDetail->product->name }}</p>
    </td>
    <td>
        <p>{{ $orderDetail->volume }}</p>
    </td>
    <td>
        <?php $attribute_value_total = 0; ?>
        @foreach($orderDetail->orderDetailAttributeValues as $orderDetailAttributeValue)
            <?php $attribute_value_total += $orderDetailAttributeValue->attributeValue->amount; ?>
        @endforeach
        <p>{{ $orderDetail->unitPrice() }}</p>
    </td>
    <td>
        <p>{{ $orderDetail->total() }}</p>
    </td>
    <td>
        {{ Form::open(array('route' => array('basket.delete.item', $orderDetail->id))) }}
            {{ Form::submit('Eliminar', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}
    </td>
</tr>
