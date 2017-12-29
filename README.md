# Turbo SMS notifications channel for Laravel 5.3+
Based on [github.com/laravel-notification-channels/smsc-ru](https://github.com/laravel-notification-channels/smsc-ru)

This package made for send notifications using [voicecombg.bg](https://voicecombg.bg/) with Laravel 5.3+.

## Contents

- [Installation](#installation)
    - [Setting up the VoiceComBG service](#setting-up-the-VoiceComBG-service)
- [Usage](#usage)
    - [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


## Installation

You can install the package via composer:
```composer require yakimka/laravel-notification-channel-voicecombg```

For Laravel < 5.5 you must install the service provider:
```php
// config/app.php
'providers' => [
    ...
    NotificationChannels\VoiceComBG\VoiceComBGServiceProvider::class,
],
```

### Setting up the VoiceComBG service

Add your VoiceComBG login, secret key (hashed password) and default sender name (or phone number) to your `config/services.php`:

```php
// config/services.php
...
'voicecombg' => [
    'login' => env('VOICECOMBG_LOGIN'),
    'secret' => env('VOICECOMBG_SECRET'),
    'sender' => 'John Doe',
    'url' => 'http://voicecombg.in.ua/api/wsdl.html',
],
...
```

## Usage

You can use the channel in your `via()` method inside the notification:

```php
use Illuminate\Notifications\Notification;
use NotificationChannels\VoiceComBG\VoiceComBGMessage;
use NotificationChannels\VoiceComBG\VoiceComBGChannel;

class AccountApproved extends Notification
{
    public function via($notifiable)
    {
        return [VoiceComBGChannel::class];
    }

    public function toVoiceComBG($notifiable)
    {
        return VoiceComBGMessage::create("Task #{$notifiable->id} is complete!");
    }
}
```

In your notifiable model, make sure to include a routeNotificationForVoiceComBG() method, which return the phone number.

```php
public function routeNotificationForVoiceComBG()
{
    return $this->phone;
}
```

### Available methods

`from()`: Sets the sender's name or phone number.

`content()`: Sets a content of the notification message.

## Security

If you discover any security related issues, please email ss.yakim@gmail.com instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [yakimka](https://github.com/yakimka)
- [JhaoDa](https://github.com/jhaoda)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
