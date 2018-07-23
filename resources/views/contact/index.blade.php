@extends('home.layouts.home')

@section('content')

<section class="content-header">
    <h1>
        Contact
    </h1>
</section>
<div class="content">
    @include('adminlte-templates::common.errors')
    <div class="box box-primary">

        <div class="box-body">
            <div class="row">
                {!! Form::open(['route' => 'contact.store']) !!}

                    <!-- Comments Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('comments', 'Comments:') !!}
                        {!! Form::textarea('comments', null, ['class' => 'form-control', 'required']) !!}
                    </div>

                    <!-- Email Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('email', 'Email:') !!}
                        {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
                    </div>

                    <!-- Telephone Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('telephone', 'Telephone:') !!}
                        {!! Form::text('telephone', null, ['class' => 'form-control', 'required']) !!}
                    </div>

                    <!-- First Name Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('first_name', 'First Name:') !!}
                        {!! Form::text('first_name', null, ['class' => 'form-control', 'required']) !!}
                    </div>

                    <!-- Last Name Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('last_name', 'Last Name:') !!}
                        {!! Form::text('last_name', null, ['class' => 'form-control', 'required']) !!}
                    </div>

                    <!-- Submit Field -->
                    <div class="form-group col-sm-12">
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ url('/contact') }}" class="btn btn-default">Cancel</a>
                    </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
