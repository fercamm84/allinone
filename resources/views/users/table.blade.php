<table class="table table-responsive" id="users-table">
    <thead>
        <tr>
            <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Password</th>
        <th>User Type</th>
        <th>Twitter Id</th>
        <th>Facebook Id</th>
        <th>Created</th>
        <th>Remember Token</th>
        <th>Nickname</th>
        <th>Name</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{!! $user->firstname !!}</td>
            <td>{!! $user->lastname !!}</td>
            <td>{!! $user->email !!}</td>
            <td>{!! $user->password !!}</td>
            <td>{!! $user->user_type !!}</td>
            <td>{!! $user->twitter_id !!}</td>
            <td>{!! $user->facebook_id !!}</td>
            <td>{!! $user->created !!}</td>
            <td>{!! $user->remember_token !!}</td>
            <td>{!! $user->nickname !!}</td>
            <td>{!! $user->name !!}</td>
            <td>
                {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('users.show', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('users.edit', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>