<?php

namespace Xup6m6fu04\NewebPay\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use Xup6m6fu04\NewebPay\Contracts\HTTPClient;
use Xup6m6fu04\NewebPay\Contracts\HTTPSender;
use Xup6m6fu04\NewebPay\Sender\Async;
use Xup6m6fu04\NewebPay\Sender\Sync;

trait HasSender
{
    /**
     * The sender instance.
     *
     * @var HTTPSender
     */
    protected $sender;

    /**
     * Set the sender instance.
     *
     * @param  HTTPSender  $sender
     *
     * @return $this
     */
    public function setSender(HTTPSender $sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get the sender instance.
     *
     * @return HTTPSender
     */
    public function getSender(): HTTPSender
    {
        return $this->sender;
    }

    /**
     * Set sync sender.
     *
     * @return $this
     */
    public function setSyncSender()
    {
        $this->setSender(new Sync());

        return $this;
    }

    /**
     * Set async sender.
     *
     * @return $this
     */
    public function setAsyncSender()
    {
        $this->setSender(new Async($this->createHttp()));

        return $this;
    }

    /**
     * Set mock http instance.
     *
     * @param $mockResponse
     *
     * @return $this
     */
    public function setMockHttp($mockResponse)
    {
        if ($this->sender instanceof HTTPClient) {
            if (! $mockResponse instanceof MockHandler) {
                $mockHandler = new MockHandler($mockResponse);
            }

            $this->sender->setHttp($this->createHttp($mockHandler));
        }

        return $this;
    }

    /**
     * Create http instance.
     *
     * @param  MockHandler|null  $mockHttpHandler
     *
     * @return Client
     */
    protected function createHttp(MockHandler $mockHttpHandler = null): Client
    {
        $attributes = [
            'handler' => $mockHttpHandler ? HandlerStack::create($mockHttpHandler) : null,
        ];

        $attributes = array_filter($attributes, function ($value) {
            return $value !== null;
        });

        return new Client($attributes);
    }
}
