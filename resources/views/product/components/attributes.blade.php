<div class="container">
    <div class="col-md-12">
        @foreach($product->entity->attributeEntities as $attributeEntity)
            <p>{{ $attributeEntity->attribute->description }}:</p>
            @foreach($attributeEntity->attribute->attributeValues as $attributeValue)
                {{ Form::radio('attr_'.$attributeValue->attribute->id, $attributeValue->id, false, ['amount' => $attributeValue->amount, 'onmouseup' => 'changePrice(this)', 'required']) }} {{ $attributeValue->description }}<BR>
            @endforeach
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