@foreach($attributes as $attribute)
    <div class="widget size mb-50">
        <h6 class="widget-title">{{ $attribute->description }}</h6>
        <div class="widget-desc">
            <ul>
                @foreach($product->entity->attributeValueEntities as $attributeValueEntity)
                    @if($attribute->id == $attributeValueEntity->attributeValue->attribute->id)
                        <li>
                            <!-- <a href="#" onmouseup="javascript:changePrice(this)" amount="{{ $attributeValueEntity->amount }}" required="required" 
                            name="attr_{{ $attributeValueEntity->attributeValue->attribute->id }}" value="1">{{ $attributeValueEntity->attributeValue->description }}</a> -->
                            <p>{{ Form::radio('attr_'.$attributeValueEntity->attributeValue->attribute->id, $attributeValueEntity->id, false, ['amount' => $attributeValueEntity->amount, 'onmouseup' => 'changePrice(this)', 'required']) }} {{ $attributeValueEntity->attributeValue->description }}</p>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
@endforeach

<script>
    function changePrice(element){
        var anterior = 0;
        if($( 'input[name='+$(element).attr('name')+']:checked' ).val() != undefined){
            anterior = $( 'input[name='+$(element).attr('name')+']:checked' ).attr('amount');
        }
        $('#price').html(parseFloat($('#price').html()) + parseFloat($(element).attr('amount')) - parseFloat(anterior));
    }
</script>