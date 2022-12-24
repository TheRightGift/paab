<?php

namespace App\Notifications\Tenants;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;

class LoginNotifier extends Notification
{
    use Queueable;
    /**
     * The order instance.
     *
     * @var \App\Models\Tenants\TenantUser
     */
    public $locator, $hostname;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($locator, $hostname)
    {
        $this->locator = $locator;
        $this->hostname = $hostname;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Hi you just logged in to '.$this->hostname.', at '.Carbon::now() )
            ->line('From '.$this->locator->countryName.', '.$this->locator->regionName)
            ->line('If this was not you please send us a message or login to your main dashboard to change password')
            // ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
