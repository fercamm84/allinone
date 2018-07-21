@extends('home.layouts.home')

@section('content')
    <section class="content-header">
        <h1>
            Change password
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::model($user, ['route' => ['myAccount.updatePassword']]) !!}

                    <!-- CurrentPassword Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('password', 'Current Password:') !!}
                        {!! Form::text('password', '', ['class' => 'form-control']) !!}
                    </div>

                    <!-- Lastname Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('new_password', 'New Password:') !!}
                        {!! Form::text('new_password', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Nickname Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('password_confirmation', 'Password Confirmation:') !!}
                        {!! Form::text('password_confirmation', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Submit Field -->
                    <div class="form-group col-sm-12">
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
