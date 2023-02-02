<?php

namespace Xup6m6fu04\NewebPay\Sender;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Xup6m6fu04\NewebPay\Contracts\HTTPClient;
use Xup6m6fu04\NewebPay\Contracts\HTTPSender;

class Async implements HTTPSender, HTTPClient
{
    /**
     * Guzzle http client instance.
     *
     * @var Client
     */
    protected $http;

    /**
     * Create a new async instance.
     *
     * @param  Client  $client
     *
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->http = $client;
    }

    /**
     * Send the data to API.
     *
     * @param  array   $request
     * @param  string  $url
     *
     * @return mixed
     * @throws GuzzleException
     */
    public function send(array $request, string $url)
    {
        $parameter = [
            'form_params' => $request,
            'verify' => false,
        ];

        return json_decode($this->http->post($url, $parameter)->getBody(), true);
    }

    /**
     * Set mock http client instance.
     *
     * @param  Client  $client
     *
     * @return $this
     */
    public function setHttp(Client $client): Async
    {
        $this->http = $client;

        return $this;
    }
}
