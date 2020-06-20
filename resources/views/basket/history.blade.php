@extends('home.layouts.home')

@section('content')

    <!-- ****** Cart Area Start ****** -->
    <div class="cart_area section_padding_100 clearfix">
        <div class="container">
            <div class="row">
                @if(!empty($orders))
                    @foreach($orders as $order)
                        <div class="col-12">
                            <div class="cart-table clearfix">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th colspan="1">
                                                Estado de orden de compra: {{ $order->state == 2 ? 'PAGADO' : 'CANCELADO' }}
                                            </th>
                                            <th colspan="3">
                                                {{ (new DateTime($order->updated_at))->format('d/m/Y H:i') }}
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Precio Unitario</th>
                                            <th>Cantidad</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->orderDetails as $orderDetail)
                                            <tr>
                                                <td class="cart_product_img d-flex align-items-center">
                                                    <a href="/entity/{{$orderDetail->product->entity->id}}">
                                                        @foreach($orderDetail->product->entity->imageEntities as $imageEntity)
                                                            <img src="{{ asset('imagenes/'.$imageEntity->image->name) }}" width="100px" height="100px" alt="Product">
                                                            <?php break; ?>
                                                        @endforeach
                                                    </a>
                                                    <h6>{{ $orderDetail->product->name }}</h6>
                                                </td>
                                                <td class="price"><span>${{ $orderDetail->unitPrice() }}</span></td>
                                                <td class="qty">
                                                    <span>{{ $orderDetail->volume }}</span>
                                                </td>
                                                <td class="total_price"><span>${{ $orderDetail->total() }}</span></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>
                                                <p class="pull-right">Estado: </p>
                                            </td>
                                            <td>
                                                <p class="pull-left">{{ $order->state }}</p>
                                            </td>
                                            <td>
                                                <p class="pull-right">Total: </p>
                                            </td>
                                            <td>
                                                <p class="pull-left">${{ $order->total() }}</p>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <a href="/basket">Pedido actual</a>
        </div>
    </div>
    <!-- ****** Cart Area End ****** -->

@endsection
