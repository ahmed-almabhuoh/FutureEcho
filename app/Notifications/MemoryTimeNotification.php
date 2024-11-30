<?php

namespace App\Notifications;

use App\Models\Memory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MemoryTimeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $user;
    protected $memory;

    /**
     * Create a new notification instance.
     */
    public function __construct($user, $memory_id)
    {
        $this->onQueue('memories');
        $this->user = $user;
        $this->memory = Memory::findOrFail($memory_id);
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
            ->subject('Your Memory Time Has Arrived!')
            ->greeting('Hello, ' . $this->user->name)
            ->line('It is time to revisit a memory you saved.')
            ->line('Memory Title: ' . $this->memory->title)
            ->action('View Memory', route('memories.receivers', $this->memory->id))
            ->line('Thank you for using Future Echo to save your precious moments!');
    }

    /**
     * Get the array representation of the notification for database storage.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'memory_id' => $this->memory->id,
            'memory_title' => $this->memory->title,
            'user_id' => $this->user->id,
            'notification_time' => now(),
        ];
    }
}
