<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RestoreVerifiedAccountCredentialsNotification extends Notification
{
    use Queueable;

    protected $password;
    public $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($password, $user)
    {
        $this->password = $password;
        $this->user = $user;
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
            ->greeting('Hello ' . $this->user->name . '!')
            ->line('Your account credentials have been restored.')
            ->line('Here are your new login details:')
            ->line('Email: ' . $this->user->email)
            ->line('Password: ' . $this->password)
            ->action('Login Now', url('/login'))
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
            'email' => $this->user->email,
        ];
    }
}
