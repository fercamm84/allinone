@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Section Entity
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($sectionEntity, ['route' => ['sectionEntities.update', $sectionEntity->id], 'method' => 'patch']) !!}

                        @include('section_entities.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection