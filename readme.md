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

if ($msg->parameter == 'ok' and $msg->login == 'successfull') {
    echo 'Messages Sent';
}
```

#### Laravel

```php
use Nahid\SslWSms\Facades\Sms;

$msg = Sms::message('0170420420', 'Hello Dear')->send();

if ($msg->parameter == 'ok' and $msg->login == 'successfull') {
    echo 'Messages Sent';
}
```

### Send SMS to more user

```php
$msg = $sms->message('0170420420', 'Hello Dear')
        ->message('0160420420', 'Hello Dear Uncle')
        ->message('0150420420', 'Hello Dear Trump')
        ->send();

if ($msg->parameter == 'ok' and $msg->login == 'successfull') {
    echo 'Messages Sent';
}
```
### Send SMS to users from Collections

```php
$users = [
    ['01670420420', 'Hello Trump'],
    ['01970420420', 'Hello Bush'],
    ['01770420420', 'Hello Hilari'],
    ['01570420420', 'Hello Obama'],
    ['01870420420', 'Hello Hero Alom']
]

$msg = $sms->message($users)->send();

if ($msg->parameter == 'ok' and $msg->login == 'successfull') {
    echo 'Messages Sent';
}
```

### Send same message to all users

```php
$users = [
    ['01670420420'],
    ['01970420420'],
    ['01770420420'],
    ['01570420420'],
    ['01870420420']
]

$msg = $sms->message($users, 'Hello Everyone')->send();

if ($msg->parameter == 'ok' and $msg->login == 'successfull') {
    echo 'Messages Sent';
}
```


### Send SMS with SMS template

Suppose you have to send SMS to multiple users but you want to mentions their name dynamically with message. So what can you do? Ha ha this package already handle this situations. Lets see

```php
$users = [
    ['01670420420', ['Nahid', '1234']],
    ['01970420420', ['Obi', '3213']],
    ['01770420420', ['Shipu', '5000']],
    ['01570420420', ['Kaiser', '3214']],
    ['01870420420', ['Eather', '7642']]
]

$msg = $sms->message($users, "Hello %s , Your promo code is: %s")->send();

if ($msg->parameter == 'ok' and $msg->login == 'successfull') {
    echo 'Messages Sent';
}
```

Here this messege will sent as every users with his name and promo code like:

- `01670420420`  -    Hello Nahid , Your promo code is: 1234
- `01970420420`  -    Hello Obi , Your promo code is: 3213
- `01770420420`  -    Hello Shipu , Your promo code is: 5000
- `01570420420`  -    Hello Kaiser , Your promo code is: 1234
- `01870420420`  -    Hello Eather , Your promo code is: 7642

Thats it.

Thank you :)
