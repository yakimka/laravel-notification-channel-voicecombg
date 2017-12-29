<?php

namespace NotificationChannels\VoiceComBG;

use Illuminate\Notifications\Notification;
use NotificationChannels\VoiceComBG\Exceptions\CouldNotSendNotification;

class VoiceComBGChannel
{

    /** @var \NotificationChannels\VoiceComBG\VoiceComBGApi */
    protected $voicecombg;

    public function __construct(VoiceComBGApi $voicecombg)
    {
        $this->voicecombg = $voicecombg;
    }

    /**
     * Send the given notification.
     *
     * @param mixed                                  $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @throws \NotificationChannels\VoiceComBG\Exceptions\CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        $to = $notifiable->routeNotificationFor('voicecombg');
        if (empty($to)) {
            throw CouldNotSendNotification::missingRecipient();
        }
        $message = $notification->toVoicecombg($notifiable);
        if (is_string($message)) {
            $message = new VoiceComBGMessage($message);
        }

        $this->sendMessage($to, $message);
    }

    protected function sendMessage($recipient, VoiceComBGMessage $message)
    {
        if (mb_strlen($message->content) > 800) {
            throw CouldNotSendNotification::contentLengthLimitExceeded();
        }
        $params = [
          'id' => $message->id,
          'msisdn' => $recipient,
          'text' => $message->content,
        ];
        $this->voicecombg->send($params);
    }
}
