<!-- Seller Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('seller_id', 'Seller Id:') !!}
    {!! Form::number('seller_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', 'Date:') !!}
    {!! Form::date('date', null, ['class' => 'form-control']) !!}
</div>

<!-- Total Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total', 'Total:') !!}
    {!! Form::number('total', null, ['class' => 'form-control']) !!}
</div>

<!-- Available Field -->
<div class="form-group col-sm-6">
    {!! Form::label('available', 'Available:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('available', false) !!}
        {!! Form::checkbox('available', '1', null) !!} 1
    </label>
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
    <a href="{!! route('sellerDays.index') !!}" class="btn btn-default">Cancel</a>
</div>
