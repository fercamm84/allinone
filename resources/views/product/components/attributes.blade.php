<div class="container">
    <div class="col-md-12">
        @foreach($attributes as $attribute)
            <p>{{ $attribute->description }}:</p>
            @foreach($product->entity->attributeValueEntities as $attributeValueEntity)
                @if($attribute->id == $attributeValueEntity->attributeValue->attribute->id)
                    <p>{{ Form::radio('attr_'.$attributeValueEntity->attributeValue->attribute->id, $attributeValueEntity->id, false, ['amount' => $attributeValueEntity->amount, 'onmouseup' => 'changePrice(this)', 'required']) }} {{ $attributeValueEntity->attributeValue->description }}</p>
                @endif
            @endforeach
            <BR>
        @endforeach
    </div>
</div>

<script>
    function changePrice(element){
        var anterior = 0;
        if($( 'input[name='+$(element).attr('name')+']:checked' ).val() != undefined){
            anterior = $( 'input[name='+$(element).attr('name')+']:checked' ).attr('amount');
        }
        $('#price').html(parseFloat($('#price').html()) + parseFloat($(element).attr('amount')) - parseFloat(anterior));
    }
</script>