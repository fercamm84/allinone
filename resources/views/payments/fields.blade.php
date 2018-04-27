<!-- Order Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order_id', 'Order Id:') !!}
    {!! Form::number('order_id', null, ['class' => 'form-control']) !!}
</div>

<!-- State Field -->
<div class="form-group col-sm-6">
    {!! Form::label('state', 'State:') !!}
    {!! Form::text('state', null, ['class' => 'form-control']) !!}
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Merchant Order Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('merchant_order_id', 'Merchant Order Id:') !!}
    {!! Form::number('merchant_order_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Total Paid Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total_paid_amount', 'Total Paid Amount:') !!}
    {!! Form::number('total_paid_amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Detail Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status_detail', 'Status Detail:') !!}
    {!! Form::text('status_detail', null, ['class' => 'form-control']) !!}
</div>

<!-- Payment Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('payment_type', 'Payment Type:') !!}
    {!! Form::text('payment_type', null, ['class' => 'form-control']) !!}
</div>

<!-- Operation Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('operation_type', 'Operation Type:') !!}
    {!! Form::text('operation_type', null, ['class' => 'form-control']) !!}
</div>

<!-- Payment Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('payment_id', 'Payment Id:') !!}
    {!! Form::number('payment_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Preapproval Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('preapproval_id', 'Preapproval Id:') !!}
    {!! Form::text('preapproval_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('payments.index') !!}" class="btn btn-default">Cancel</a>
</div>
