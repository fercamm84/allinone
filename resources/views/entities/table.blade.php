<table class="table table-responsive" id="entities-table">
    <thead>
        <tr>
            <th>Type</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($entities as $entity)
        <tr>
            <td>{!! $entity->type !!}</td>
            <td>
                {!! Form::open(['route' => ['entities.destroy', $entity->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('entities.show', [$entity->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('entities.edit', [$entity->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>