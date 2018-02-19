@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Parameter
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($parameter, ['route' => ['parameters.update', $parameter->id], 'method' => 'patch']) !!}

                        @include('parameters.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection