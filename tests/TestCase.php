<?php

namespace Xup6m6fu04\NewebPay\Tests;

use Carbon\Carbon;
use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected $config = [];

    public function setTestNow()
    {
        Carbon::setTestNow(Carbon::create(2020, 1, 1));
    }

    /**
     * @return array
     */
    public function createMockConfig(): array
    {
        $this->mockConfigValues();

        return $this->config;
    }

    /**
     * @param $key
     * @param $returnValue
     *
     */
    public function mockSetConfig($key, $returnValue)
    {
        $this->config[$key] = $returnValue;
    }

    public function mockConfigValues()
    {
        $this->mockSetConfig('Debug', true);
        $this->mockSetConfig('MerchantID', 'TestMerchantID1234');
        $this->mockSetConfig('HashKey', 'TestHashKey123456789');
        $this->mockSetConfig('HashIV', '17ef14e533ed1c18'); // Generate with `bin2hex(openssl_random_pseudo_bytes(8));`
        $this->mockSetConfig('Version', '1.5');
        $this->mockSetConfig('RespondType', 'JSON');
        $this->mockSetConfig('LangType', 'zh-tw');
        $this->mockSetConfig('TradeLimit', 0);
        $this->mockSetConfig('ExpireDate', 7);
        $this->mockSetConfig('ReturnURL', null);
        $this->mockSetConfig('NotifyURL', null);
        $this->mockSetConfig('CustomerURL', null);
        $this->mockSetConfig('ClientBackURL', null);
        $this->mockSetConfig('EmailModify', false);
        $this->mockSetConfig('LoginType', false);
        $this->mockSetConfig('OrderComment', null);
        $this->mockSetConfig('PaymentMethod', [
            'CREDIT' => [
                'Enable' => true,
                'CreditRed' => false,
                'InstFlag' => 0,
            ],
            'ANDROIDPAY' => false,
            'SAMSUNGPAY' => false,
            'LINEPAY' => false,
            'UNIONPAY' => false,
            'WEBATM' => false,
            'VACC' => false,
            'CVS' => false,
            'BARCODE' => false,
            'ESUNWALLET' => false,
            'TAIWANPAY' => false,
            'EZPAY' => false,
            'EZPWECHAT' => false,
            'EZPALIPAY' => false,
        ]);
        $this->mockSetConfig('CVSCOM', null);
        $this->mockSetConfig('LgsType', null);
    }
}
