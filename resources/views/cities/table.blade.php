<table class="table table-responsive" id="cities-table">
    <thead>
        <tr>
            <th>Description</th>
        <th>Zone Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($cities as $city)
        <tr>
            <td>{!! $city->description !!}</td>
            <td>{!! $city->zone_id !!}</td>
            <td>
                {!! Form::open(['route' => ['cities.destroy', $city->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('cities.show', [$city->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('cities.edit', [$city->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>