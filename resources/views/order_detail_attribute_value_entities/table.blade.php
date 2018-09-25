<table class="table table-responsive" id="orderDetailAttributeValueEntities-table">
    <thead>
        <tr>
            <th>Attribute Value Entity Id</th>
        <th>Order Detail Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($orderDetailAttributeValueEntities as $orderDetailAttributeValueEntity)
        <tr>
            <td>{!! $orderDetailAttributeValueEntity->attribute_value_entity_id !!}</td>
            <td>{!! $orderDetailAttributeValueEntity->order_detail_id !!}</td>
            <td>
                {!! Form::open(['route' => ['orderDetailAttributeValueEntities.destroy', $orderDetailAttributeValueEntity->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('orderDetailAttributeValueEntities.show', [$orderDetailAttributeValueEntity->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('orderDetailAttributeValueEntities.edit', [$orderDetailAttributeValueEntity->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>