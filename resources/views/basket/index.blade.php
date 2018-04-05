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
                    @if(!empty($order))
                        <table>
                            <thead>
                                <th>
                                </th>
                                <th>
                                    Nombre
                                </th>
                                <th>
                                    Cantidad
                                </th>
                                <th>
                                    Precio unitario
                                </th>
                                <th>
                                    Precio total
                                </th>
                            </thead>
                            <tbody>
                                @foreach($order->orderDetails as $orderDetail)
                                    @include('basket.components.show_order')
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
