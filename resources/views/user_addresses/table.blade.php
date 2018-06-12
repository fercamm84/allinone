<table class="table table-responsive" id="userAddresses-table">
    <thead>
        <tr>
            <th>User Id</th>
        <th>Address Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($userAddresses as $userAddress)
        <tr>
            <td>{!! $userAddress->user_id !!}</td>
            <td>{!! $userAddress->address_id !!}</td>
            <td>
                {!! Form::open(['route' => ['userAddresses.destroy', $userAddress->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('userAddresses.show', [$userAddress->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('userAddresses.edit', [$userAddress->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>