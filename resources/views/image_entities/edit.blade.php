@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Image Entity
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($imageEntity, ['route' => ['imageEntities.update', $imageEntity->id], 'method' => 'patch']) !!}

                        @include('image_entities.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection