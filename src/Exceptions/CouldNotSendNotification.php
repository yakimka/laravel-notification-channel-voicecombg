<?php

namespace NotificationChannels\VoiceComBG\Exceptions;

use DomainException;
use Exception;

class CouldNotSendNotification extends Exception
{

    /**
     * Thrown when recipient's phone number is missing.
     *
     * @return static
     */
    public static function missingRecipient()
    {
        return new static('Notification was not sent. Phone number is missing.');
    }

    /**
     * Thrown when content length is greater than 800 characters.
     *
     * @return static
     */
    public static function contentLengthLimitExceeded()
    {
        return new static(
          'Notification was not sent. Content length may not be greater than 800 characters.'
        );
    }

    /**
     * Thrown when we're unable to communicate with VoiceComBG.
     *
     * @param  DomainException $exception
     *
     * @return static
     */
    public static function voicecombgRespondedWithAnError(
      DomainException $exception
    ) {
        return new static(
          "VoiceComBG responded with an error '{$exception}'"
        );
    }

    /**
     * Thrown when we're unable to communicate with VoiceComBG.
     *
     * @param  Exception $exception
     *
     * @return static
     */
    public static function couldNotCommunicateWithVoiceComBG(Exception $exception)
    {
        return new static("The communication with VoiceComBG failed. Reason: {$exception->getMessage()}");
    }

    /**
     * Thrown when balance less than 1 credit.
     *
     * @return static
     */
    public static function lowBalanceVoiceComBG()
    {
        return new static(
          'Notification was not sent. Low balance.'
        );
    }

    /**
     * @param $request
     *
     * @return mixed
     */
    public function render($request)
    {
        if ($request->ajax()) {
            return response()->json($this->getMessage(), 500,
              ['Content-type' => 'application/json; charset=utf-8'],
              JSON_UNESCAPED_UNICODE);
        }
    }
}
