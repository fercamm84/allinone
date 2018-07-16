<tr>
    <td>
        @if(sizeof($orderDetail->product->imageProducts)>0)
            @foreach($orderDetail->product->imageProducts as $imageProduct)
                <img src="{{ asset('imagenes/'.$imageProduct->image->name) }}" width="100px" height="100px">
                <img src="{{ asset('imagenes/'.$imageProduct->image->name) }}" alt="" class="img-responsive">
            @endforeach
        @else
            <img src="{{ asset('/img/default-no-image.png') }}" alt="" class="img-responsive">
        @endif
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
