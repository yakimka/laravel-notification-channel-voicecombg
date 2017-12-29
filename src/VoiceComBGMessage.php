<?php

namespace NotificationChannels\VoiceComBG;

class VoiceComBGMessage
{

    /**
     * The phone number the message should be sent from.
     *
     * @var string
     */
    public $from = '';

    /**
     * The message content.
     *
     * @var string
     */
    public $content = '';

    /**
     * The sms id.
     *
     * @var string
     */
    public $id = '';

    /**
     * Create a new message instance.
     *
     * @param  string $content
     *
     * @return static
     */
    public static function create($content = '', $id)
    {
        return new static($content, $id);
    }

    /**
     * @param  string $content
     */
    public function __construct($content = '', $id)
    {
        $this->content = $content;
        $this->id = $id;
    }

    /**
     * Set the message content.
     *
     * @param  string $content
     *
     * @return $this
     */
    public function content($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Set the phone number or sender name the message should be sent from.
     *
     * @param  string $from
     *
     * @return $this
     */
    public function from($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Set the message id.
     *
     * @param  string $from
     *
     * @return $this
     */
    public function id($id)
    {
        $this->id = $id;

        return $this;
    }
}
