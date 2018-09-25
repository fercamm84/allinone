<table class="table table-responsive" id="sellerReservations-table">
    <thead>
        <tr>
        <th>Seller Day Reservation Id</th>
        <th>Seller Day Id</th>
        <th>User Id</th>
        <th>Total</th>
        <th>From Hour</th>
        <th>To Hour</th>
        <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($sellerReservations as $sellerReservation)
        <tr>
            <td>{!! $sellerReservation->id !!}</td>
            <td>{!! $sellerReservation->seller_day_id !!}</td>
            <td>{!! $sellerReservation->user_id !!}</td>
            <td>{!! $sellerReservation->total !!}</td>
            <td>{!! $sellerReservation->from_hour !!}</td>
            <td>{!! $sellerReservation->to_hour !!}</td>
            <td>
                {!! Form::open(['route' => ['sellerReservations.destroy', $sellerReservation->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('sellerReservations.show', [$sellerReservation->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('sellerReservations.edit', [$sellerReservation->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>