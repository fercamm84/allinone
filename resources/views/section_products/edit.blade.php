@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Section Product
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($sectionProduct, ['route' => ['sectionProducts.update', $sectionProduct->id], 'method' => 'patch']) !!}

                        @include('section_products.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection