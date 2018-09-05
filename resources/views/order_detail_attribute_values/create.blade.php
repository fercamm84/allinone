@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Order Detail Attribute Value
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'orderDetailAttributeValues.store']) !!}

                        @include('order_detail_attribute_values.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
