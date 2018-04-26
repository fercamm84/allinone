@extends('home.layouts.home')

@section('content')

    <section class="content-header">
        <h1>
            Carrito
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    Pago realizado exitosamente!
                    <BR><BR>
                    Comunicate a este email mencionando el nro de order #{{ $order->id }}
                </div>
            </div>
        </div>
    </div>

@endsection
