@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Seller Reservation
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($sellerReservation, ['route' => ['sellerReservations.update', $sellerReservation->id], 'method' => 'patch']) !!}

                        @include('seller_reservations.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection