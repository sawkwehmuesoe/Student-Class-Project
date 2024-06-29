<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactEmailNotify extends Notification implements ShouldQueue
{
    use Queueable;

    private $data;

    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
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
        return (new MailMessage)
                    ->greeting("New Contact Created")
                    ->line("Full Name : ".$this->data["firstname"]." ".$this->data['lastname'])
                    ->line("Birth Date : ".$this->data["birthday"])
                    ->line("Relative : ".$this->data["relative"])
                    ->action('Visit Site', $this->data['url']);
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



// =>Gmail Integrate

// Gmail > Setting Icon > See all setting > Forwarding and POP/IMAP >

// php artisan queue:table
// php artisan migrate
// .env > QUEUE_CONNECTON=database (if sync that is not work for queue)
// Note: class ContactEmailNotify extend Notification implements ShouldQueue
// implements ShouldQueue (use Illuminate\Contracts\Queue\ShouldQueue;)
// php artisan queue:work       //must run after queue
// (or)
// php artisan queue:listen     //must run after queue
