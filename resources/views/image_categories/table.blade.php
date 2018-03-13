<table class="table table-responsive" id="imageCategories-table">
    <thead>
        <tr>
            <th>Category Id</th>
        <th>Image Id</th>
        <th>Active</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($imageCategories as $imageCategory)
        <tr>
            <td>{!! $imageCategory->category_id !!}</td>
            <td>{!! $imageCategory->image_id !!}</td>
            <td>{!! $imageCategory->active !!}</td>
            <td>
                {!! Form::open(['route' => ['imageCategories.destroy', $imageCategory->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('imageCategories.show', [$imageCategory->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('imageCategories.edit', [$imageCategory->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>