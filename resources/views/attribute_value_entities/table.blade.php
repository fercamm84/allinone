<table class="table table-responsive" id="attributeValueEntities-table">
    <thead>
        <tr>
            <th>Entity Id</th>
        <th>Attribute Value Id</th>
        <th>Amount</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($attributeValueEntities as $attributeValueEntity)
        <tr>
            <td>{!! $attributeValueEntity->entity_id !!}</td>
            <td>{!! $attributeValueEntity->attribute_value_id !!}</td>
            <td>{!! $attributeValueEntity->amount !!}</td>
            <td>
                {!! Form::open(['route' => ['attributeValueEntities.destroy', $attributeValueEntity->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('attributeValueEntities.show', [$attributeValueEntity->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('attributeValueEntities.edit', [$attributeValueEntity->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>