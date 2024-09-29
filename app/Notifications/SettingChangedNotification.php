<?php

namespace App\Notifications;

use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;

class SettingChangedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Setting $setting)
    {
        //
        $this->onQueue('management');
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

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Website Settings Updated')
            ->greeting('Hello Manager,')
            ->line('The website settings have been updated. Here are the new settings:')
            ->line(new HtmlString($this->buildSettingsTable()))  // Use HtmlString to handle HTML content
            ->action('View All Settings', url('/dashboard/settings'))
            ->line('Thank you for your attention!');
    }

    /**
     * Build the settings table as an HTML string with an image.
     */
    protected function buildSettingsTable(): string
    {
        $logoUrl = Storage::url($this->setting->logo); // Get the public URL for the logo

        return '<table style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px;">Website Logo</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Login</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Sign Up</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;">
                    <img src="' . url($logoUrl) . '" alt="Logo" style="width: 100px; height: auto;">
                </td>
                <td style="border: 1px solid #ddd; padding: 8px;' . ($this->setting->sign_in ? 'color: green;' : 'color: red;') . '">' . ($this->setting->sign_in ? 'Active' : 'Inactive') . '</td>
                <td style="border: 1px solid #ddd; padding: 8px;' . ($this->setting->sign_up ? 'color: green;' : 'color: red;') . '">' . ($this->setting->sign_up ? 'Active' : 'Inactive') . '</td>
            </tr>
        </tbody>
    </table>';
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
