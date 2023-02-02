<?php

namespace Xup6m6fu04\NewebPay\Contracts;

use GuzzleHttp\Client;

interface HTTPClient
{
    /**
     * Set mock http client instance.
     *
     * @param  Client  $client
     * @return mixed
     */
    public function setHttp(Client $client);
}
