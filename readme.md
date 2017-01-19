# PHP SSL-Wirless SMS client

php-sslwireless-sms is a PHP client for SSL Wirless SMS API. Its just a magic to sending SMS trough this client. This package is also support Laravel.

## Installation

Goto terminal and run this command

```shell
composer require nahid/php-sslwireless-sms
```

Wait for few minutes. Composer will automatically install this package for your project.

### For Laravel

Open `config/app` and add this line in `providers` section

```php
Nahid\SslWSms\SslWSmsServiceProvider::class,
```

For Facade support you have add this line in `aliases` section.

```php
'Sms'   =>  Nahid\SslWSms\Facades\Sms::class,
```

Then run this command

```shell
php artisan vendor:publish --provider="Nahid\SslWSms\SslWSmsServiceProvider"
```


## Configuration

This package is required three configurations.

1. sid = Which is given by SSL-Wirless.
2. user = your user id which is given by SSL-Wirless
3. password = your account password

php-sslwireless-sms is take an array as config file. Lets services

```php
use Nahid\SslWSms\Sms;

$config = [
    'sid' => '',
    'user' => '',
    'password'=> ''
];

$sms = new Sms($config);
```
### For Laravel

This package is also support Laravel. For laravel you have to configure it as laravel style.

Goto `app\sslwsms.php` and configure it with your credentials.

```php
return [
    'sid' => '',
    'user' => '',
    'password'=> ''
];
```

## Usages

Its very easy to use. This packages has a lot of functionalities and features.


### Send SMS to a single user

```php
$sms = new Sms($config);
$msg = $sms->message('0170420420', 'Hello Dear')->send();

if ($msg->parameter == 'ok' and $msg->login == 'success') {
    echo 'Messages Sent';
}
```

#### Laravel

```php
use Nahid\SslWSms\Facades\Sms;

$msg = Sms::message('0170420420', 'Hello Dear')->send();

if ($msg->parameter == 'ok' and $msg->login == 'success') {
    echo 'Messages Sent';
}
```
