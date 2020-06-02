<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramFile;
use NotificationChannels\Telegram\TelegramChannel;

class LaravelTelegramNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    /**
     * @param $notifiable
     * @return mixed
     */
    public function toTelegram($notifiable)
    {
        return TelegramFile::create()
            ->to($notifiable->telegram_user_id)
            ->content("I'm pdf file")
            ->document('message.pdf', 'message.pdf');
    }
}
