<?php

namespace NotificationChannels\VoiceComBG\Test;

use NotificationChannels\VoiceComBG\VoiceComBGMessage;

class VoiceComBGMessageTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_can_accept_a_content_when_constructing_a_message()
    {
        $message = new VoiceComBGMessage('hello');
        $this->assertEquals('hello', $message->content);
    }

    /** @test */
    public function it_can_accept_a_content_when_creating_a_message()
    {
        $message = VoiceComBGMessage::create('hello');
        $this->assertEquals('hello', $message->content);
    }

    /** @test */
    public function it_can_set_the_content()
    {
        $message = (new VoiceComBGMessage())->content('hello');
        $this->assertEquals('hello', $message->content);
    }

    /** @test */
    public function it_can_set_the_from()
    {
        $message = (new VoiceComBGMessage())->from('John_Doe');
        $this->assertEquals('John_Doe', $message->from);
    }
}
