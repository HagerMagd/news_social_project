<?php

namespace App\Notifications;

use Generator;
use Ichtrojan\Otp\Otp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendOtpNotifi extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $otp ;
    public function __construct()
    {
        $this->otp=new Otp;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $otp=$this->otp->generate($notifiable->email,'numeric',5,40); // generate code by otp packdege 

        return (new MailMessage)
                    ->greeting('Otp Code')
                    ->line('vreify your code .')
                    ->line('code : '. $otp->token);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
