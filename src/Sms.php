<?php

namespace Nahid\SslWSms;

class Sms extends AbstractApi
{
    protected $config;
    protected $request;
    protected $sms = [];

    public function __construct($config)
    {
        $this->config = $config;
        parent::__construct($config);
    }

    public function message($to, $message = null)
    {
        if (is_array($to) && is_null($message)) {
            $this->sms = $this->makeSerializeSmsFormat($to);
        } elseif (is_array($to) && is_string($message)) {
            $this->sms = $this->makeSmsMultiUser($to, $message);
        } else {
            $this->sms[] = [$to, $message, uniqid()];
        }

        return $this;
    }

    public function send()
    {
        $params = [
            'sid' => $this->config['sid'],
            'user' => $this->config['user'],
            'pass' => $this->config['password'],
            'sms' => $this->sms,
        ];

        return $this->formParams($params)
                ->headers(['Accept' => 'text/html'])
                ->post('pushapi/dynamic/server.php');
    }

    protected function makeSerializeSmsFormat($messages)
    {
        $sms = [];
        foreach ($messages as $message) {
            $sms[] = [$message[0], $message[1], uniqid()];
        }

        return $sms;
    }

    protected function makeSmsMultiUser($to, $message)
    {
        $sms = [];
        foreach ($to as $user) {
            $template = isset($user[1]) && is_array($user[1]) ? $user[1] : [];
            $sms[] = [$user[0], vsprintf($message, $template), uniqid()];
        }

        return $sms;
    }
}
