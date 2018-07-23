<table class="table table-responsive" id="mailings-table">
    <thead>
        <tr>
            <th>Comments</th>
        <th>Email</th>
        <th>User Id</th>
        <th>Country Id</th>
        <th>Telephone</th>
        <th>First Name</th>
        <th>Last Name</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($mailings as $mailing)
        <tr>
            <td>{!! $mailing->comments !!}</td>
            <td>{!! $mailing->email !!}</td>
            <td>{!! $mailing->user_id !!}</td>
            <td>{!! $mailing->country_id !!}</td>
            <td>{!! $mailing->telephone !!}</td>
            <td>{!! $mailing->first_name !!}</td>
            <td>{!! $mailing->last_name !!}</td>
            <td>
                {!! Form::open(['route' => ['mailings.destroy', $mailing->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('mailings.show', [$mailing->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('mailings.edit', [$mailing->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>