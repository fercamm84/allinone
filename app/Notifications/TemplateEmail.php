<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TemplateEmail extends Notification
{
    use Queueable;

    /**
     * The "level" of the notification (info, success, error).
     *
     * @var string
     */
    public $level = 'info';

    /**
     * The subject of the notification.
     *
     * @var string
     */
    public $subject;

    /**
     * The notification's greeting.
     *
     * @var string
     */
    public $greeting;

    /**
     * The notification's salutation.
     *
     * @var string
     */
    public $salutation;

    /**
     * The "intro" lines of the notification.
     *
     * @var array
     */
    public $introLines = [];

    /**
     * The "outro" lines of the notification.
     *
     * @var array
     */
    public $outroLines = [];

    /**
     * The text / label for the action.
     *
     * @var string
     */
    public $actionText;

    /**
     * The action URL.
     *
     * @var string
     */
    public $actionUrl;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $MailMessage = new MailMessage;
        $MailMessage->level($this->level);
        $MailMessage->subject($this->subject);
        $MailMessage->greeting($this->greeting);
        $MailMessage->salutation($this->salutation);
        $MailMessage->introLines = $this->introLines;
        $MailMessage->outroLines = $this->outroLines;
        $MailMessage->actionText = $this->actionText;
        $MailMessage->actionUrl = $this->actionUrl;

        return $MailMessage;
//        return (new MailMessage)
////          ->subject('Your Subject') // it will use this class name if you don't specify
////          ->greeting('') // example: Dear Sir, Hello Madam, etc ...
//            ->level('info')// It is kind of email. Available options: info, success, error. Default: info
//            ->line('The introduction to the notification.')
//            ->action('Notification Action', url('/'))
//            ->line('Thank you for using our application!');
////          ->salutation('')  // example: best regards, thanks, etc ...
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray()
    {
        return [
            'level' => $this->level,
            'subject' => $this->subject,
            'greeting' => $this->greeting,
            'salutation' => $this->salutation,
            'introLines' => $this->introLines,
            'outroLines' => $this->outroLines,
            'actionText' => $this->actionText,
            'actionUrl' => $this->actionUrl,
        ];
    }
}
