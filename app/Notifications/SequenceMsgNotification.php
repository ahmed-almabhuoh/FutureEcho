<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SequenceMsgNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $user;
    public $memory;
    public $message;

    /**
     * Create a new notification instance.
     */
    public function __construct($user, $memory, $message)
    {
        $this->onQueue('memories-msg');

        $this->user = $user;
        $this->memory = $memory;
        $this->message = $message;
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
            ->subject('Notification Reminder')
            ->greeting('Hello, ' . $this->user->name)
            ->line($this->message->message)
            ->action('View Memory Details', route('memories.seq.msgs', ['memory' => $this->memory->id]))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification for database storage.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'user_id' => $this->user->id,
            'memory_id' => $this->memory->id,
            'message' => $this->message,
            'timestamp' => now(),
        ];
    }
}
