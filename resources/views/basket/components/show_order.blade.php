<tr>
    <td>
        @foreach($orderDetail->product->imageProducts as $imageProduct)
            <img src="{{ asset('images/'.$imageProduct->image->name) }}" width="100px" height="100px">
        @endforeach
    </td>
    <td>
        <p>{{ $orderDetail->product->name }}</p>
    </td>
    <td>
        <p>{{ $orderDetail->volume }}</p>
    </td>
    <td>
        <p>{{ $orderDetail->product->price }}</p>
    </td>
    <td>
        <p>{{ $orderDetail->volume * $orderDetail->product->price }}</p>
    </td>
    <td>
        {{ Form::open(array('route' => array('basket.delete.item', $orderDetail->id))) }}
            {{ Form::submit('Eliminar', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}
    </td>
</tr>
