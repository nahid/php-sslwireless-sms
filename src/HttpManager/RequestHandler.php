<?php

namespace Nahid\SslWSms\HttpManager;

use GuzzleHttp\Client;

class RequestHandler
{
    const BASE_URL = 'http://sms.sslwireless.com';

    public $http;

    public function __construct($baseUrl = null)
    {
        $baseUrl = $baseUrl ? $baseUrl : self::BASE_URL;
        $this->http = new Client(['base_uri' => $baseUrl, 'timeout' => 2.0]);
    }
}
