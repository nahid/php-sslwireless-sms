<?php

namespace Nahid\SslWSms\HttpManager;

use GuzzleHttp\Client;

class RequestHandler
{
    const BASE_URL = 'http://sms.sslwireless.com';

    public $http;

    public function __construct()
    {
        $this->http = new Client(['base_uri' => self::BASE_URL, 'timeout' => 2.0]);
    }
}
