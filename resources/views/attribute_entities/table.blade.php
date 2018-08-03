<table class="table table-responsive" id="attributeEntities-table">
    <thead>
        <tr>
            <th>Entity Id</th>
        <th>Attribute Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($attributeEntities as $attributeEntity)
        <tr>
            <td>{!! $attributeEntity->entity_id !!}</td>
            <td>{!! $attributeEntity->attribute_id !!}</td>
            <td>
                {!! Form::open(['route' => ['attributeEntities.destroy', $attributeEntity->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('attributeEntities.show', [$attributeEntity->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('attributeEntities.edit', [$attributeEntity->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>