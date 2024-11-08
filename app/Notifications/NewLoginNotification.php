<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewLoginNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $name;
    protected $code;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected string $twoFACode, public string $username)
    {
        $this->onQueue('auth');
        $this->name = $username;
        $this->code = $twoFACode;
    }

    /**
     * Get the notification's delivery channels.
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
            ->subject('Your Two-Factor Authentication (2FA) Code')
            ->greeting("Hello, {$this->name}!")
            ->line('You recently attempted to log into your account. For security, please use the following code to complete your login:')
            ->line("**2FA Code: {$this->code}**")
            ->line('This code is valid for the next 10 minutes. Do not share this code with anyone.')
            ->line('If you did not attempt to log in, please secure your account immediately.')
            ->salutation('Thank you for keeping your account secure!');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'username' => $this->name,
            'twoFACode' => $this->code,
        ];
    }
}
