<table class="table table-responsive" id="imageEntities-table">
    <thead>
        <tr>
            <th>Entity Id</th>
        <th>Image Id</th>
        <th>Active</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($imageEntities as $imageEntity)
        <tr>
            <td>{!! $imageEntity->entity_id !!}</td>
            <td>{!! $imageEntity->image_id !!}</td>
            <td>{!! $imageEntity->active !!}</td>
            <td>
                {!! Form::open(['route' => ['imageEntities.destroy', $imageEntity->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('imageEntities.show', [$imageEntity->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('imageEntities.edit', [$imageEntity->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>