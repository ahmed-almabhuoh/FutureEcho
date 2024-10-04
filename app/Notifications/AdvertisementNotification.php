<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdvertisementNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public string $advertisement;
    public string $name;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $advertisement, string $name)
    {
        $this->advertisement = $advertisement;
        $this->name = $name;

        // Set the notification queue
        $this->onQueue('management');
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Advertisement Notification')
            ->greeting('Hello ' . $this->name . ',')  // Personalized greeting
            ->line('We are excited to share the following advertisement with you:')
            ->line(new \Illuminate\Support\HtmlString('<strong>' . nl2br(e($this->advertisement)) . '</strong>'))  // Advertisement text with HTML formatting
            ->line('We hope this information is useful for you.')
            ->action('View More', url('/'))  // You can replace the URL with your application link
            ->salutation('Thank you for being with us!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'advertisement' => $this->advertisement,
            'name' => $this->name,
        ];
    }
}
