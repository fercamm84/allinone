@extends('home.layouts.home')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{ Form::open(array('id'=>'formularioMP', 'route' => array('basket.paymentResult'))) }}
    {!! Form::hidden('payment_state', false, array('id' => 'payment_state')) !!}
    {!! Form::hidden('payment_task', false, array('id' => 'payment_task')) !!}
    {{ Form::close() }}

    <!-- ****** Cart Area Start ****** -->
    <div class="cart_area section_padding_100 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cart-table clearfix">
                        @if(!empty($order))
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->orderDetails as $orderDetail)
                                        @include('basket.components.show_order')
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3">
                                        </td>
                                        <td class="pull-left">
                                            <p>Total: </p>
                                        </td>
                                        <td class="pull-right">
                                            <p>{{ $order->total() }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">
                                            <div class="cart-footer d-flex mt-30">
                                                <div class="back-to-shop w-50">
                                                    &nbsp;
                                                </div>
                                                <div class="w-50 text-right coupon-code-area">
                                                    <a id="boton_pago" href="javascript:solicitarMercadoPago();" class="btn karl-checkout-btn" style="width:250px;">PAGAR</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
            <a href="/basket/history">Histórico de pedidos</a>
        </div>
    </div>
    <!-- ****** Cart Area End ****** -->

@endsection

<script type="text/javascript" src="http://mp-tools.mlstatic.com/buttons/render.js"></script>
<script type="text/javascript" src="https://www.mercadopago.com/org-img/jsapi/mptools/buttons/render.js"></script>
<script>
    (function () {
        function $MPBR_load() {
            window.$MPBR_loaded !== true && (function () {
                var s = document.createElement("script");
                s.type = "text/javascript";
                s.async = true;
                s.src = ("https:" == document.location.protocol ? "https://www.mercadopago.com/org-img/jsapi/mptools/buttons/" : "http://mp-tools.mlstatic.com/buttons/") + "render.js";
                var x = document.getElementsByTagName('script')[0];
                x.parentNode.insertBefore(s, x);
                window.$MPBR_loaded = true;
            })();
        }

        window.$MPBR_loaded !== true ? (window.attachEvent ? window.attachEvent('onload', $MPBR_load) : window.addEventListener('load', $MPBR_load, false)) : null;
    })();

    function execute_my_onreturn (json) {
        $('#payment_state').val(json.collection_status);
        $('#payment_task').val(json.external_reference);
        $('#formularioMP').submit();
    }

    function mobileCheck() {
        var check = false;
        (function (a, b) {
            if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4)))check = true
        })(navigator.userAgent || navigator.vendor || window.opera);
        return check;
    }

    function solicitarMercadoPago() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: "/basket/solicitar",
            cache: false,
            success: function (html) {
                if (html != '') {
                    var obj = null;
                    try {
                        console.log(html);
                        obj = JSON.parse(html);
                        console.log(obj);
                    } catch (err) {
                    }
                    if (obj) {
                        redirigirMercadoPago(obj.preference);
                    } else {
                        alert('Se ha producido un error. Vuelva a intentarlo, por favor.');
                    }
                } else {
                    alert('Se ha producido un error. Vuelva a intentarlo, por favor.');
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert('Se ha producido un error. Vuelva a intentarlo, por favor.');
            }
        });
    }

    function redirigirMercadoPago(urlMercadoPago){
        $MPC.openCheckout({
            url: urlMercadoPago,
            mode: "modal",
            onreturn: execute_my_onreturn
        });
    }

</script>
