<table class="table table-responsive" id="sellerDays-table">
    <thead>
        <tr>
        <th>Seller Day Id</th>
        <th>Seller Id</th>
        <th>Date</th>
        <th>Total</th>
        <th>Available</th>
        <th>From Hour</th>
        <th>To Hour</th>
        <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($sellerDays as $sellerDay)
        <tr>
            <td>{!! $sellerDay->id !!}</td>
            <td>{!! $sellerDay->seller_id !!}</td>
            <td>{!! $sellerDay->date !!}</td>
            <td>{!! $sellerDay->total !!}</td>
            <td>{!! $sellerDay->available !!}</td>
            <td>{!! $sellerDay->from_hour !!}</td>
            <td>{!! $sellerDay->to_hour !!}</td>
            <td>
                {!! Form::open(['route' => ['sellerDays.destroy', $sellerDay->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('sellerDays.show', [$sellerDay->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('sellerDays.edit', [$sellerDay->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>