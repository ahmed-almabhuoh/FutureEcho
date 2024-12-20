<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResendTwoFANotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The user's name and the 2FA code.
     */
    public function __construct(public string $name, public int $code)
    {
        $this->onQueue('auth');  // Queue this notification on the 'auth' queue
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
        $backgroundColor = '#f9f9f9';  // Background color
        $borderColor = '#1bc5bd';      // Border color for the code block

        return (new MailMessage)
            ->subject('Your New 2FA Code')  // Email subject
            ->greeting('Hello ' . $this->name . ',')  // Personalized greeting
            ->line('We have generated a new Two-Factor Authentication (2FA) code for you.')  // Introduction line
            ->line(new \Illuminate\Support\HtmlString(  // Add HTML string for the 2FA code block
                "<div style=\"padding: 15px; background-color: {$backgroundColor}; border: 2px solid {$borderColor}; text-align: center; font-size: 20px; font-weight: bold;\">" .
                    $this->code .
                    "</div>"
            ))
            ->line('Please use this code to complete your login process.')  // Instruction line
            ->line(new \Illuminate\Support\HtmlString('<strong>If you didn\'t request this, please contact support immediately.</strong>'))  // Bold security warning
            ->salutation('Thank you for using our application!');  // Closing line
    }

    /**
     * Get the array representation of the notification (for database storage).
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'code' => $this->code,  // Store the 2FA code in the database
            'message' => 'A new 2FA code was generated for ' . $this->name,
        ];
    }
}
