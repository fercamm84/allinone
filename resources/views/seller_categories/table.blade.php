<table class="table table-responsive" id="sellerCategories-table">
    <thead>
        <tr>
            <th>Seller Id</th>
        <th>Category Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($sellerCategories as $sellerCategory)
        <tr>
            <td>{!! $sellerCategory->seller_id !!}</td>
            <td>{!! $sellerCategory->category_id !!}</td>
            <td>
                {!! Form::open(['route' => ['sellerCategories.destroy', $sellerCategory->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('sellerCategories.show', [$sellerCategory->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('sellerCategories.edit', [$sellerCategory->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>