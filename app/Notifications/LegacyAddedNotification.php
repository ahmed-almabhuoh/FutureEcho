<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Crypt;

class LegacyAddedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public User $user, public $twoFaCode)
    {
        //
        $this->onQueue('legacies');
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
    public function toMail($notifiable)
    {
        // Assuming you pass the specific user (the legacy user) and the 2FA code to the notification
        return (new MailMessage)
            ->subject('You Have Been Added as a Legacy Contact')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('You have been added as a legacy contact for ' . $this->user->name . '.')
            ->line('To complete this process, please use the following 2FA code:')
            ->line('**' . Crypt::decrypt($this->twoFaCode) . '**') // Display the 2FA code in bold
            ->action('Complete the Process', url('/complete-legacy')) // Example action URL
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
}
