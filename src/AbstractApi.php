<?php

namespace Nahid\SslWSms;

use Nahid\SslWSms\HttpManager\RequestHandler;
use Nahid\SslWSms\HttpManager\Response;

abstract class AbstractApi
{
    protected $client;
    protected $parameters = [];
    protected $config;
    //protected $personalToken;
    private $requestMethods = [
        'GET',
        'POST',
        'PUT',
        'DELETE',
        'HEAD',
        'OPTIONS',
        'PATCH',
    ];

    public function __construct($config = [])
    {
        $this->client = new RequestHandler(isset($config['url']) ? $config['url'] : null);
    }

    public function __call($func, $params)
    {
        $method = strtoupper($func);

        if (in_array($method, $this->requestMethods)) {
            $parameters[] = $method;
            $parameters[] = $params[0];

            return call_user_func_array([$this, 'makeMethodRequest'], $parameters);
        }
    }

    public function formParams($params = array())
    {
        if (is_array($params)) {
            $this->parameters['form_params'] = $params;

            return $this;
        }

        return false;
    }

    public function headers($params = array())
    {
        if (is_array($params)) {
            $this->parameters['headers'] = $params;

            return $this;
        }

        return false;
    }

    public function query($params = array())
    {
        if (is_array($params)) {
            $this->parameters['query'] = $params;

            return $this;
        }

        return false;
    }

    public function makeMethodRequest($method, $uri)
    {
        $this->parameters['timeout'] = 60;

        return new Response($this->client->http->request($method, $uri, $this->parameters));
    }
}
