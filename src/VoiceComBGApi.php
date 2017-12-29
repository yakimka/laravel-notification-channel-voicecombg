<?php

namespace NotificationChannels\VoiceComBG;

use DomainException;
use NotificationChannels\VoiceComBG\Exceptions\CouldNotSendNotification;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

class VoiceComBGApi
{

    protected $client;

    /** @var string */
    protected $sid;

    public function __construct($sid, $url)
    {
        $this->sid = $sid;
        $this->client = new Client(['base_uri' => $url]);
    }

    /**
     * @param  array $params
     *
     * @return array
     *
     * @throws CouldNotSendNotification
     */
    public function send($params)
    {
        try {
            $defaultParams = [
              'encoding' => 'utf-8',
              'sid' => $this->sid
            ];

            $query_string = http_build_query($params + $defaultParams);
            $result = $this->client->request('GET', "?{$query_string}");
            $result_string = (string) $result->getBody();

            if (strpos($result_string, 'SEND_OK') === false) {
                throw new DomainException($result_string);
            }
            Log::info("Message with id {$params['id']} was successfully send. Sid {$this->sid}. Result: {$result_string}");

            return $result;
        } catch (DomainException $exception) {
            throw CouldNotSendNotification::voicecombgRespondedWithAnError($exception);
        } catch (\Exception $exception) {
            throw CouldNotSendNotification::couldNotCommunicateWithVoiceComBG($exception);
        }
    }
}
