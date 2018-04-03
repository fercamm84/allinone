@extends('home.layouts.home')

@section('content')

    <section class="content-header">
        <h1>
            Product
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('product.show_fields')
                </div>
            </div>
        </div>
    </div>

@endsection
