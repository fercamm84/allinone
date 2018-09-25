@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Brand Category
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($brandCategory, ['route' => ['brandCategories.update', $brandCategory->id], 'method' => 'patch']) !!}

                        @include('brand_categories.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection