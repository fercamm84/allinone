<table class="table table-responsive" id="payments-table">
    <thead>
        <tr>
            <th>Order Id</th>
        <th>State</th>
        <th>Amount</th>
        <th>Merchant Order Id</th>
        <th>Total Paid Amount</th>
        <th>Status Detail</th>
        <th>Payment Type</th>
        <th>Operation Type</th>
        <th>Payment Id</th>
        <th>Preapproval Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($payments as $payment)
        <tr>
            <td>{!! $payment->order_id !!}</td>
            <td>{!! $payment->state !!}</td>
            <td>{!! $payment->amount !!}</td>
            <td>{!! $payment->merchant_order_id !!}</td>
            <td>{!! $payment->total_paid_amount !!}</td>
            <td>{!! $payment->status_detail !!}</td>
            <td>{!! $payment->payment_type !!}</td>
            <td>{!! $payment->operation_type !!}</td>
            <td>{!! $payment->payment_id !!}</td>
            <td>{!! $payment->preapproval_id !!}</td>
            <td>
                {!! Form::open(['route' => ['payments.destroy', $payment->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('payments.show', [$payment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('payments.edit', [$payment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>