<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AnnouncementNotify extends Notification
{
    use Queueable;

    protected $tbid;
    protected $title;
    protected $img;

    public function __construct($id,$title,$img)
    {
        $this->tbid = $id;
        $this->title = $title;
        $this->img = $img;
    }


    public function via(object $notifiable): array
    {
        return ['database'];
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


    public function toArray(object $notifiable): array
    {
        return [
            "id"=>$this->tbid,
            "title"=>$this->title,
            "img"=>$this->img,
        ];
    }
}
