@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            User Address
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($userAddress, ['route' => ['userAddresses.update', $userAddress->id], 'method' => 'patch']) !!}

                        @include('user_addresses.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection