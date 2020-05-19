<tr>
    <td class="cart_product_img d-flex align-items-center">
        <a href="#">
            @foreach($orderDetail->product->entity->imageEntities as $imageEntity)
                <img src="{{ asset('imagenes/'.$imageEntity->image->name) }}" width="100px" height="100px">
                <?php break; ?>
            @endforeach
        </a>
        <h6>{{ $orderDetail->product->name }} - {{ $orderDetail->product->description }}
            @if(!empty($orderDetail->sellerReservation))
                - Horario: {{ $orderDetail->sellerReservation->from_hour }}
            @endif
        </h6>
    </td>
    <td class="price"><span>${{ $orderDetail->unitPrice() }}</span></td>
    <td class="qty">
        {{ $orderDetail->volume }}
    </td>

    <td class="total_price cart-footer"><span>${{ $orderDetail->total() }}</span></td>

    <td>
        <div class="update-checkout w-50 text-right">
            {{ Form::open(array('route' => array('basket.delete.item', $orderDetail->id), 'onsubmit' => 'return confirm("Do you want to delete this item?")')) }}
                {{ Form::submit('Eliminar', ['class' => 'btn btn-primary']) }}
            {{ Form::close() }}
        </div>
    </td>
</tr>
