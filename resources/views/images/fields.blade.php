<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::text('type', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- ProductImage -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'New image:') !!}
    {!! Form::file('image') !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('images.index') !!}" class="btn btn-default">Cancel</a>
</div>

<div class="form-group">
    <a class="gallery_img" href="{{ asset('imagenes/'.$image->name) }}" target="_blank">
        <img class="d-block w-100" src="{{ asset('imagenes/'.$image->name) }}" alt="{{ $image->name }}">
    </a>
</div>