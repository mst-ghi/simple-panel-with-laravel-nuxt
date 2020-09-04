<?php

namespace App\Tools\SMS;

use Illuminate\Notifications\Notification;

class SmsChannel
{
    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param Notification $notification
     * @param Sms $sms
     * @return void
     */
    public function send($notifiable, Notification $notification , Sms $sms)
    {
        $message = $notification->toSms($notifiable);

        $sms->setTo($message['to'])->send($message['text']);
    }
}
