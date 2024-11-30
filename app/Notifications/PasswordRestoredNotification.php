<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordRestoredNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The name of the user.
     */
    public string $name;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $name)
    {
        $this->onQueue('auth');
        $this->name = $name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Password Restored Successfully')
            ->greeting('Hello, ' . $this->name)
            ->line('We are notifying you that your password has been successfully restored.')
            ->line('If you did not perform this action, please contact our support team immediately.')
            ->action('Visit Our Website', config('app.url'))
            ->line('Thank you for trusting us!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Your password was restored successfully.',
            'name' => $this->name,
            'timestamp' => now(),
        ];
    }
}
