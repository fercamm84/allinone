<table class="table table-responsive" id="sectionEntities-table">
    <thead>
        <tr>
            <th>Entity Id</th>
        <th>Section Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($sectionEntities as $sectionEntity)
        <tr>
            <td>{!! $sectionEntity->entity_id !!}</td>
            <td>{!! $sectionEntity->section_id !!}</td>
            <td>
                {!! Form::open(['route' => ['sectionEntities.destroy', $sectionEntity->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('sectionEntities.show', [$sectionEntity->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('sectionEntities.edit', [$sectionEntity->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>