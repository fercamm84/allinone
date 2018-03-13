@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Image Category
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($imageCategory, ['route' => ['imageCategories.update', $imageCategory->id], 'method' => 'patch']) !!}

                        @include('image_categories.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection