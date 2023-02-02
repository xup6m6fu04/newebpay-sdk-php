<?php

namespace Xup6m6fu04\NewebPay\Tests;

use GuzzleHttp\Psr7\Response;
use Xup6m6fu04\NewebPay\NewebPay;

class NewebPayTest extends TestCase
{
    public function testNewebPayPayment()
    {
        $this->setTestNow();

        $newebPay = new NewebPay($this->createMockConfig());
        $result = $newebPay
            ->payment('TestNo123456', 100, '測試商品', 'test@email.com')
            ->submit();

        $this->assertEquals('<form id="order-form" method="post" action=https://ccore.newebpay.com/MPG/mpg_gateway ><input type="hidden" name="MerchantID" value="TestMerchantID1234"><input type="hidden" name="TradeInfo" value="e88e33cc07d106bcba1c1bd02d5d421fa9f86ef5a1469c0e801b3813b360f8333fd9fef8bf7312a3e5e66e1f6b5601b633b2b337c5dc2f6001d3f14dcb80df6cfc4ffe7a624838789bc47fcdd438db49a5f3e2b48d1740160d307a1bf6f27190b8825723f59d0cdf4071229db0a7bb6b2ef12ce7be24b0467db60a4185908770e1b5238444fb00fa24bb7693f9fb8d8c38577702e5ef0cab44b8d25e86f43e4599ca40b486efe32aae055626ca86d322055b161886fd13884252afbf7604ba739af778f00bdff9166f51143e5c5bd7326129fa1289fac0d1d66d0d41b9937058a69f5bb0f312ad4f1045aa8b74f354f5f8b260fed32f386bcec3e973f9c631fee1a8c0479fc45054c91e7eeaecbc692ae67561e71f31bb61964a5d51a7b6cb987d5bff4e838b2dfe02d1c2d83c2c0c34027ade4dc4dbbfe1644dcfc79d99944c5cff4e0cd95992114542a59c3240f4b4df9bc90ba2d4fc1c9a42f9f9e1093e8ef0ead9b02d89679d35e0609a8fc1745e0094cbc6fe07664d5393205e98b537b6b262e1409173740f132d1c1be5f57e404679c38768417b6db2b5df985d7c8629034f9dce7b01b70d0e90f0b7c4a6b24c744118db37e4fd5a8970125e6d2088a437446fa655246220266e1b73a27bcd7a18547d459460277f66accb18caf10302"><input type="hidden" name="TradeSha" value="F2C84870AE3964EE6E7110020307B27FD3B713A32F87C31E01A7E28441BEBED3"><input type="hidden" name="Version" value="1.5"></form><script type="text/javascript">document.getElementById(\'order-form\').submit();</script>', $result);
    }

    public function testNewebPayCreditCardCancelAuthorization()
    {
        $this->setTestNow();

        $newebpay = new NewebPay($this->createMockConfig());

        $result = $newebpay
            ->creditCardCancelAuthorization('TestNo123456', 100, 'order')
            ->setMockHttp([
                new Response(200, [], '{"Status":"Code001","Message":"Test message.","Result":[]}'),
            ])
            ->submit();

        $this->assertEquals([
            'Status'  => 'Code001',
            'Message' => 'Test message.',
            'Result'  => [],
        ], $result);
    }

    public function testNewebPayCreditCardChargeback()
    {
        $this->setTestNow();

        $newebpay = new NewebPay($this->createMockConfig());

        $result = $newebpay
            ->creditCardChargeback('TestNo123456', 100, 'order')
            ->setMockHttp([
                new Response(200, [], '{"Status":"Code001","Message":"Test message.","Result":[]}'),
            ])
            ->submit();

        $this->assertEquals([
            'Status'  => 'Code001',
            'Message' => 'Test message.',
            'Result'  => [],
        ], $result);
    }

    public function testNewebPayCancelCreditCardChargeback()
    {
        $this->setTestNow();

        $newebpay = new NewebPay($this->createMockConfig());

        $result = $newebpay
            ->cancelCreditCardChargeback('TestNo123456', 100, 'order')
            ->setMockHttp([
                new Response(200, [], '{"Status":"Code001","Message":"Test message.","Result":[]}'),
            ])
            ->submit();

        $this->assertEquals([
            'Status'  => 'Code001',
            'Message' => 'Test message.',
            'Result'  => [],
        ], $result);
    }

    public function testNewebPayCreditCardRefund()
    {
        $this->setTestNow();

        $newebpay = new NewebPay($this->createMockConfig());

        $result = $newebpay
            ->creditCardRefund('TestNo123456', 100, 'order')
            ->setMockHttp([
                new Response(200, [], '{"Status":"Code001","Message":"Test message.","Result":[]}'),
            ])
            ->submit();

        $this->assertEquals([
            'Status'  => 'Code001',
            'Message' => 'Test message.',
            'Result'  => [],
        ], $result);
    }

    public function testNewebPayCancelCreditCardRefund()
    {
        $this->setTestNow();

        $newebpay = new NewebPay($this->createMockConfig());

        $result = $newebpay
            ->cancelCreditCardRefund('TestNo123456', 100, 'order')
            ->setMockHttp([
                new Response(200, [], '{"Status":"Code001","Message":"Test message.","Result":[]}'),
            ])
            ->submit();

        $this->assertEquals([
            'Status'  => 'Code001',
            'Message' => 'Test message.',
            'Result'  => [],
        ], $result);
    }
}
