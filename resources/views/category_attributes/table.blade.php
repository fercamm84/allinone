<table class="table table-responsive" id="categoryAttributes-table">
    <thead>
        <tr>
            <th>Category Id</th>
        <th>Attribute Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($categoryAttributes as $categoryAttribute)
        <tr>
            <td>{!! $categoryAttribute->category_id !!}</td>
            <td>{!! $categoryAttribute->attribute_id !!}</td>
            <td>
                {!! Form::open(['route' => ['categoryAttributes.destroy', $categoryAttribute->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('categoryAttributes.show', [$categoryAttribute->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('categoryAttributes.edit', [$categoryAttribute->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>