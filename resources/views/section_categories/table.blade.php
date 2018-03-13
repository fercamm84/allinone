<table class="table table-responsive" id="sectionCategories-table">
    <thead>
        <tr>
            <th>Category Id</th>
        <th>Section Id</th>
        <th>Active</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($sectionCategories as $sectionCategory)
        <tr>
            <td>{!! $sectionCategory->category_id !!}</td>
            <td>{!! $sectionCategory->section_id !!}</td>
            <td>{!! $sectionCategory->active !!}</td>
            <td>
                {!! Form::open(['route' => ['sectionCategories.destroy', $sectionCategory->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('sectionCategories.show', [$sectionCategory->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('sectionCategories.edit', [$sectionCategory->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>