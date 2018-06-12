<!-- Zone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('zone', 'Zone:') !!}
    {!! Form::text('zone', null, ['class' => 'form-control']) !!}
</div>

<!-- Country Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('country_id', 'Country Id:') !!}
    {!! Form::number('country_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('zones.index') !!}" class="btn btn-default">Cancel</a>
</div>
