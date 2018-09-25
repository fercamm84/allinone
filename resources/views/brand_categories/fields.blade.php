<!-- Brand Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('brand_id', 'Brand Id:') !!}
    {!! Form::number('brand_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_id', 'Category Id:') !!}
    {!! Form::number('category_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('brandCategories.index') !!}" class="btn btn-default">Cancel</a>
</div>
