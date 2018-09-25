<table class="table table-responsive" id="attributeValues-table">
    <thead>
        <tr>
            <th>Attribute Values Id</th>
            <th>Attribute Id</th>
            <th>Description</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($attributeValues as $attributeValue)
        <tr>
            <td>{!! $attributeValue->id !!}</td>
            <td>{!! $attributeValue->attribute_id !!}</td>
            <td>{!! $attributeValue->description !!}</td>
            <td>
                {!! Form::open(['route' => ['attributeValues.destroy', $attributeValue->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('attributeValues.show', [$attributeValue->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('attributeValues.edit', [$attributeValue->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>