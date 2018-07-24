<?php

namespace app\Http\Helpers;

use App\Notifications\TemplateEmail;
use App\User;

class SendMailHelper {

    public function __construct()
    {
    }

    public function sendEmailContactUs($mailing = null)
    {
        $user = new User();
        $user->email = 'fercamm@gmail.com';// This is the email you want to send to.
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

        $TemplateEmail->actionText = 'Go home';
        $TemplateEmail->actionUrl = env('APP_URL');

        $user->notify($TemplateEmail);
    }

}