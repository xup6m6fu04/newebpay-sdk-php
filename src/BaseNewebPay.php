<?php

namespace Xup6m6fu04\NewebPay;

use Carbon\Carbon;

abstract class BaseNewebPay
{
    use Traits\Encryption,
        Traits\HasSender,
        Traits\Trade;

    /**
     * The neweb-pay Config.
     *
     * @var string
     */
    protected $configs;

    /**
     * The neweb-pay MerchantID.
     *
     * @var string
     */
    protected $MerchantID;

    /**
     * The neweb-pay HashKey.
     *
     * @var string
     */
    protected $HashKey;

    /**
     * The neweb-pay HashIV.
     *
     * @var string
     */
    protected $HashIV;

    /**
     * The neweb-pay URL.
     *
     * @var string
     */
    protected $url;

    /**
     * The neweb-pay production base URL.
     *
     * @var string
     */
    protected $productionUrl = 'https://core.newebpay.com/';

    /**
     * The neweb-pay test base URL.
     *
     * @var string
     */
    protected $testUrl = 'https://ccore.newebpay.com/';

    /**
     * Now timestamp.
     *
     * @var int
     */
    protected $timestamp;

    /**
     * Create a new base neweb-pay instance.
     *
     * @return void
     */
    public function __construct(array $configs)
    {
        $this->configs = $configs;
        $this->MerchantID = $configs['MerchantID'];
        $this->HashKey = $configs['HashKey'];
        $this->HashIV = $configs['HashIV'];

        $this->setTimestamp();
        $this->tradeDataBoot();
        $this->boot();
    }

    /**
     * The newebpay boot hook.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Generate the newebpay full URL.
     *
     * @param  string  $path
     *
     * @return string
     */
    public function generateUrl(string $path): string
    {
        return ($this->configs['Debug'] ? $this->testUrl : $this->productionUrl)
            .$path;
    }

    /**
     * Get the newebpay full URL.
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Set the newebpay API path.
     *
     * @param  string  $path
     *
     * @return $this
     */
    public function setApiPath(string $path): BaseNewebPay
    {
        $this->url = $this->generateUrl($path);

        return $this;
    }

    /**
     * Set now timestamp.
     *
     * @return $this
     */
    public function setTimestamp(): BaseNewebPay
    {
        $this->timestamp = Carbon::now()->timestamp;

        return $this;
    }

    /**
     * Get request data.
     *
     * @return array
     */
    public function getRequestData(): array
    {
        return [];
    }

    /**
     * Submit data to newebpay API.
     *
     * @return mixed
     */
    public function submit()
    {
        return $this->sender->send($this->getRequestData(), $this->url);
    }
}
