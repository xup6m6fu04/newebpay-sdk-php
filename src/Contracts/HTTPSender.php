<?php

namespace Xup6m6fu04\NewebPay\Contracts;

interface HTTPSender
{
    /**
     * Send the data to API.
     *
     * @param  array   $request
     * @param  string  $url
     *
     * @return mixed
     */
    public function send(array $request, string $url);
}
