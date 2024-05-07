<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Kreait\Firebase\Messaging\Notification as MessageNotification;
use Kreait\Laravel\Firebase\Facades\FirebaseMessaging;

class PushNotification extends Notification
{
    use Queueable;



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
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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

    public function toFcm($notifiable)
    {
        return (new MessageNotification())
            ->title('New Notification')
            ->body('Hello, this is a test notification from Laravel and Firebase!')
            ->image('https://example.com/image.jpg')
            ->iosOptions([
                             'sound' => 'default',
                             'badge' => 1,
                         ]);
    }
}
