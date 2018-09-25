<table class="table table-responsive" id="brandCategories-table">
    <thead>
        <tr>
            <th>Brand Id</th>
        <th>Category Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($brandCategories as $brandCategory)
        <tr>
            <td>{!! $brandCategory->brand_id !!}</td>
            <td>{!! $brandCategory->category_id !!}</td>
            <td>
                {!! Form::open(['route' => ['brandCategories.destroy', $brandCategory->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('brandCategories.show', [$brandCategory->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('brandCategories.edit', [$brandCategory->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>