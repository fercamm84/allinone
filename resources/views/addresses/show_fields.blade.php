<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $address->id !!}</p>
</div>

<!-- Address Field -->
<div class="form-group">
    {!! Form::label('address', 'Address:') !!}
    <p>{!! $address->address !!}</p>
</div>

<!-- Zip Code Field -->
<div class="form-group">
    {!! Form::label('zip_code', 'Zip Code:') !!}
    <p>{!! $address->zip_code !!}</p>
</div>

<!-- Location Id Field -->
<div class="form-group">
    {!! Form::label('location_id', 'Location Id:') !!}
    <p>{!! $address->location_id !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $address->updated_at !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $address->created_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $address->deleted_at !!}</p>
</div>

