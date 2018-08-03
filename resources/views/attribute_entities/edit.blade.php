@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Attribute Entity
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($attributeEntity, ['route' => ['attributeEntities.update', $attributeEntity->id], 'method' => 'patch']) !!}

                        @include('attribute_entities.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection