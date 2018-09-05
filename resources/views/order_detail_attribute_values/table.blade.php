<table class="table table-responsive" id="orderDetailAttributeValues-table">
    <thead>
        <tr>
            <th>Attribute Value Id</th>
        <th>Order Detail Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($orderDetailAttributeValues as $orderDetailAttributeValue)
        <tr>
            <td>{!! $orderDetailAttributeValue->attribute_value_id !!}</td>
            <td>{!! $orderDetailAttributeValue->order_detail_id !!}</td>
            <td>
                {!! Form::open(['route' => ['orderDetailAttributeValues.destroy', $orderDetailAttributeValue->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('orderDetailAttributeValues.show', [$orderDetailAttributeValue->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('orderDetailAttributeValues.edit', [$orderDetailAttributeValue->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>