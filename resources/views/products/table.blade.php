<table style="overflow-x:auto;" id="products-table">
    <thead>
        <tr>
            <th># Product</th>
            <th>Entity Id</th>
            <th>Description</th>
            <th>Short Description</th>
            <th>Link Facebook</th>
            <th>Link Twitter</th>
            <th>Link Instagram</th>
            <th>Link External</th>
            <th>Title</th>
            <th>Price</th>
            <th>Name</th>
            <th>Order</th>
            <th>Visible</th>
            <th>Stock</th>
            <th>User Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td>{!! $product->id !!}</td>
            <td>{!! $product->entity_id !!}</td>
            <td>{!! $product->description !!}</td>
            <td>{!! $product->short_description !!}</td>
            <td>{!! $product->link_facebook !!}</td>
            <td>{!! $product->link_twitter !!}</td>
            <td>{!! $product->link_instagram !!}</td>
            <td>{!! $product->link_external !!}</td>
            <td>{!! $product->title !!}</td>
            <td>{!! $product->price !!}</td>
            <td>{!! $product->name !!}</td>
            <td>{!! $product->order !!}</td>
            <td>{!! $product->visible !!}</td>
            <td>{!! $product->stock !!}</td>
            <td>{!! $product->user_id !!}</td>
            <td>
                {!! Form::open(['route' => ['products.destroy', $product->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('products.show', [$product->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('products.edit', [$product->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>