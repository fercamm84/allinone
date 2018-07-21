@extends('home.layouts.home')

@section('content')
    <section class="content-header">
        <h1>
            My account
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::model($user, ['route' => ['myAccount.update', $user->id], 'method' => 'patch']) !!}

                    <!-- Firstname Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('firstname', 'Firstname:') !!}
                        {!! Form::text('firstname', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Lastname Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('lastname', 'Lastname:') !!}
                        {!! Form::text('lastname', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Nickname Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('nickname', 'Nickname:') !!}
                        {!! Form::text('nickname', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Submit Field -->
                    <div class="form-group col-sm-12">
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                        <a href="{!! route('myAccount.changePassword') !!}" class="btn btn-default">Change password</a>
                        <a href="{!! route('address.index') !!}" class="btn btn-default">Addresses</a>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
