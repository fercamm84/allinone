<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $payment->id !!}</p>
</div>

<!-- Order Id Field -->
<div class="form-group">
    {!! Form::label('order_id', 'Order Id:') !!}
    <p>{!! $payment->order_id !!}</p>
</div>

<!-- State Field -->
<div class="form-group">
    {!! Form::label('state', 'State:') !!}
    <p>{!! $payment->state !!}</p>
</div>

<!-- Amount Field -->
<div class="form-group">
    {!! Form::label('amount', 'Amount:') !!}
    <p>{!! $payment->amount !!}</p>
</div>

<!-- Merchant Order Id Field -->
<div class="form-group">
    {!! Form::label('merchant_order_id', 'Merchant Order Id:') !!}
    <p>{!! $payment->merchant_order_id !!}</p>
</div>

<!-- Total Paid Amount Field -->
<div class="form-group">
    {!! Form::label('total_paid_amount', 'Total Paid Amount:') !!}
    <p>{!! $payment->total_paid_amount !!}</p>
</div>

<!-- Status Detail Field -->
<div class="form-group">
    {!! Form::label('status_detail', 'Status Detail:') !!}
    <p>{!! $payment->status_detail !!}</p>
</div>

<!-- Payment Type Field -->
<div class="form-group">
    {!! Form::label('payment_type', 'Payment Type:') !!}
    <p>{!! $payment->payment_type !!}</p>
</div>

<!-- Operation Type Field -->
<div class="form-group">
    {!! Form::label('operation_type', 'Operation Type:') !!}
    <p>{!! $payment->operation_type !!}</p>
</div>

<!-- Payment Id Field -->
<div class="form-group">
    {!! Form::label('payment_id', 'Payment Id:') !!}
    <p>{!! $payment->payment_id !!}</p>
</div>

<!-- Preapproval Id Field -->
<div class="form-group">
    {!! Form::label('preapproval_id', 'Preapproval Id:') !!}
    <p>{!! $payment->preapproval_id !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $payment->updated_at !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $payment->created_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $payment->deleted_at !!}</p>
</div>

