<?php

use App\Models\Blog;
use Illuminate\Notifications\Notification;
use NotificationChannels\Discord\DiscordChannel;
use NotificationChannels\Discord\DiscordMessage;

class DiscordNotification extends Notification {

    public $blog;

    public function __construct(Blog $blog) {
        $this->blog = $blog;
    }

    public function via($notifiable) {
        return [DiscordChannel::class];
    }

    public function toDiscord($notifiable) {
        return DiscordMessage::create("Your blog *{$this->blog->title}* will be available within the next hour!");
    }
}
