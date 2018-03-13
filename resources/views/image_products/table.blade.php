<table class="table table-responsive" id="imageProducts-table">
    <thead>
        <tr>
            <th>Product Id</th>
        <th>Image Id</th>
        <th>Active</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($imageProducts as $imageProduct)
        <tr>
            <td>{!! $imageProduct->product_id !!}</td>
            <td>{!! $imageProduct->image_id !!}</td>
            <td>{!! $imageProduct->active !!}</td>
            <td>
                {!! Form::open(['route' => ['imageProducts.destroy', $imageProduct->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('imageProducts.show', [$imageProduct->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('imageProducts.edit', [$imageProduct->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>