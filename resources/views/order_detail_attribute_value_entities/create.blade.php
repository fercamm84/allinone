@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Order Detail Attribute Value Entity
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'orderDetailAttributeValueEntities.store']) !!}

                        @include('order_detail_attribute_value_entities.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
