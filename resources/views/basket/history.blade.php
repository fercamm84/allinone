@extends('home.layouts.home')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <section class="content-header">
        <h1>
            Carrito
        </h1>
    </section>
    {{ Form::open(array('id'=>'formularioMP', 'route' => array('basket.paymentResult'))) }}
    {!! Form::hidden('payment_state', false, array('id' => 'payment_state')) !!}
    {!! Form::hidden('payment_task', false, array('id' => 'payment_task')) !!}
    {{ Form::close() }}
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @if(!empty($orders))
                        @foreach($orders as $order)
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
                                        <tr>
                                            <td>
                                                @foreach($orderDetail->product->imageProducts as $imageProduct)
                                                    <img src="{{ asset('imagenes/'.$imageProduct->image->name) }}" width="100px" height="100px">
                                                @endforeach
                                            </td>
                                            <td>
                                                <p>{{ $orderDetail->product->name }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $orderDetail->volume }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $orderDetail->product->price }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $orderDetail->volume * $orderDetail->product->price }}</p>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>
                                                <p>Estado: </p>
                                            </td>
                                            <td>
                                                <p>{{ $order->state }}</p>
                                            </td>
                                        </tr>
                                    </tfoot>
                            </table>
                        @endforeach
                    @endif
                </div>
            </div>
            <div>
                <a href="/basket">Pedido en curso</a>
            </div>
        </div>
    </div>

@endsection
