<?php

namespace app\Http\Helpers;

use App\Notifications\TemplateEmail;
use App\User;
use App\Models\Payment;

class SendMailHelper {

    public function __construct()
    {
    }

    public function sendEmailContactUs($mailing = null)
    {
        $user = new User();
        $user->email = env('APP_MAIL');// This is the email you want to send to.
        
        $TemplateEmail = new TemplateEmail();
        $TemplateEmail->subject = 'Contact from "Contact us section"';
        $TemplateEmail->greeting = 'Contacted by:';
        $TemplateEmail->salutation = 'Bye!';

        if($mailing!=null){
            $TemplateEmail->introLines = [
                                          'Email: ' . $mailing->email,
                                          'Telephone: ' . $mailing->telephone,
                                          'First name: ' . $mailing->first_name,
                                          'Last name: ' . $mailing->last_name,
                                          'Comments: ' . $mailing->comments
                                         ];
//            $TemplateEmail->outroLines = ['son', 'outro', 'lines'];
        }

        $TemplateEmail->actionText = 'My account';
        $TemplateEmail->actionUrl = env('APP_URL');

        $user->notify($TemplateEmail);
    }

    public function paymentProcessed($process = null)
    {
        $user = User::find($process->user_id);
        $user->email = env('APP_MAIL');// This is the email you want to send to.

        //Pruebo usando Reflection para instanciar un objeto de tipo Order
        $tabla = 'App\\Models\\'.explode('_', $process->comment)[0];
        $tabla_id = explode('_', $process->comment)[1];
        $Tabla = new $tabla;
        $order = $Tabla::find($tabla_id);

        $payment = Payment::where([['order_id', '=', $order->id]])->first();
        
        $TemplateEmail = new TemplateEmail();
        $TemplateEmail->subject = 'Estado de tu orden de compra';
        $TemplateEmail->greeting = 'Hola ' . $user->firstname . ',';
        $TemplateEmail->salutation = 'Saludos!';

        $TemplateEmail->introLines = [
                                        'El estado del pago es para la orden de compra #' . $order->id . 
                                        ' es ' . $payment->state . '.'
                                        ];

        $TemplateEmail->actionText = 'Mi carrito';
        $TemplateEmail->actionUrl = env('APP_URL').'/basket';

        $user->notify($TemplateEmail);
    }

    public function successfulSale($process = null)
    {
        $user = User::find($process->user_id);
        $user->email = env('APP_MAIL');// This is the email you want to send to.

        //Pruebo usando Reflection para instanciar un objeto de tipo Order
        $tabla = 'App\\Models\\'.explode('_', $process->comment)[0];
        $tabla_id = explode('_', $process->comment)[1];
        $Tabla = new $tabla;
        $order = $Tabla::find($tabla_id);

        $TemplateEmail = new TemplateEmail();
        $TemplateEmail->subject = 'Recibiste una compra';
        $TemplateEmail->greeting = 'Hola ' . $user->firstname . ',';
        $TemplateEmail->salutation = 'Saludos!';

        //Para dicha orden, buscar los productos del seller que pertenece al usuario $process->user_id
        $TemplateEmail->introLines[] = 'Te compraron:';
        $TemplateEmail->introLines[] = '';
        foreach($order->orderDetails as $orderDetail){
            if($orderDetail->product->seller->user->id == $process->user_id){
                $TemplateEmail->introLines[] = '\#'.$orderDetail->product->id.' - '.$orderDetail->product->description.' - $'.$orderDetail->product->price.' - Cantidad: '.$orderDetail->volume;
                if(!empty($orderDetail->sellerReservation)){
                    $TemplateEmail->introLines[] = ' - Horario: ' . $orderDetail->sellerReservation->from_hour;
                }
            }
        }

        $TemplateEmail->actionText = 'Mis ventas';
        $TemplateEmail->actionUrl = env('APP_URL').'/mySales';

        $user->notify($TemplateEmail);
    }

}