<!-- Seller Day Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('seller_day_id', 'Seller Day Id:') !!}
    {!! Form::number('seller_day_id', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Total Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total', 'Total:') !!}
    {!! Form::number('total', null, ['class' => 'form-control']) !!}
</div>

<!-- From Hour Field -->
<div class="form-group col-sm-6">
    {!! Form::label('from_hour', 'From Hour:') !!}
    {!! Form::number('from_hour', null, ['class' => 'form-control']) !!}
</div>

<!-- To Hour Field -->
<div class="form-group col-sm-6">
    {!! Form::label('to_hour', 'To Hour:') !!}
    {!! Form::number('to_hour', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('sellerReservations.index') !!}" class="btn btn-default">Cancel</a>
</div>
