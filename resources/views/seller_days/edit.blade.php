@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Seller Day
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($sellerDay, ['route' => ['sellerDays.update', $sellerDay->id], 'method' => 'patch']) !!}

                        @include('seller_days.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection