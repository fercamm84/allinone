@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Seller
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($seller, ['route' => ['sellers.update', $seller->id], 'method' => 'patch']) !!}

                        @include('sellers.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection