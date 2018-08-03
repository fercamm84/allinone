<table class="table table-responsive" id="sellers-table">
    <thead>
        <tr>
            <th>Description</th>
        <th>Order</th>
        <th>Type</th>
        <th>Entity Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($sellers as $seller)
        <tr>
            <td>{!! $seller->description !!}</td>
            <td>{!! $seller->order !!}</td>
            <td>{!! $seller->type !!}</td>
            <td>{!! $seller->entity_id !!}</td>
            <td>
                {!! Form::open(['route' => ['sellers.destroy', $seller->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('sellers.show', [$seller->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('sellers.edit', [$seller->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>