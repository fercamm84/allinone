<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Order Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order', 'Order:') !!}
    {!! Form::number('order', null, ['class' => 'form-control']) !!}
</div>

<!-- Reservations Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reservations', 'Reservations:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('reservations', false) !!}
        {!! Form::checkbox('reservations', '1', null) !!} 1
    </label>
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::text('type', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('sellers.index') !!}" class="btn btn-default">Cancel</a>
</div>
