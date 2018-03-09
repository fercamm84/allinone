<table class="table table-responsive" id="categoryProducts-table">
    <thead>
        <tr>
            <th>Category Id</th>
        <th>Product Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($categoryProducts as $categoryProduct)
        <tr>
            <td>{!! $categoryProduct->category_id !!}</td>
            <td>{!! $categoryProduct->product_id !!}</td>
            <td>
                {!! Form::open(['route' => ['categoryProducts.destroy', $categoryProduct->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('categoryProducts.show', [$categoryProduct->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('categoryProducts.edit', [$categoryProduct->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>