<table class="table table-responsive" id="zones-table">
    <thead>
        <tr>
            <th>Zone</th>
        <th>Country Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($zones as $zone)
        <tr>
            <td>{!! $zone->zone !!}</td>
            <td>{!! $zone->country_id !!}</td>
            <td>
                {!! Form::open(['route' => ['zones.destroy', $zone->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('zones.show', [$zone->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('zones.edit', [$zone->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>