<?php

namespace Nahid\SslWSms\HttpManager;

class Response
{
    protected $response;
    public $data = [];

    public function __construct($response)
    {
        $this->response = $response;
        $this->data = $this->getData();
    }

    public function __call($method, $args)
    {
        if (method_exists($this->response, $method)) {
            return call_user_func_array([$this->response, $method], $args);
        }

        return false;
    }

    protected function getData()
    {
        $header = explode(';', $this->response->getHeader('Content-Type')[0]);
        $contentType = $header[0];

        if ($contentType == 'text/html') {
            $contents = $this->response->getBody()->getContents();
            $xmlData = simplexml_load_string(strtolower($contents));

            if ($xmlData == false) {
                return $contents;
            }

            return $xmlData;
        }

        return false;
    }
}
