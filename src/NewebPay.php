<?php

namespace Xup6m6fu04\NewebPay;

use Exception;

class NewebPay extends BaseNewebPay
{
    /**
     * 付款.
     *
     * @param string $no    訂單編號
     * @param int    $amt   訂單金額
     * @param string $desc  商品描述
     * @param string $email 連絡信箱
     *
     * @return NewebPayMPG
     */
    public function payment(string $no, int $amt, string $desc, string $email): NewebPayMPG
    {
        $newebPay = new NewebPayMPG($this->configs);
        $newebPay->setOrder($no, $amt, $desc, $email);

        return $newebPay;
    }

    /**
     * 取消授權.
     *
     * @param string $no   訂單編號
     * @param int    $amt  訂單金額
     * @param string $type 編號類型
     *                     'order' => 使用商店訂單編號追蹤
     *                     'trade' => 使用藍新金流交易序號追蹤
     *
     * @return NewebPayCancel
     */
    public function creditCardCancelAuthorization(
        string $no,
        int $amt,
        string $type = 'order'
    ): NewebPayCancel {
        $newebPay = new NewebPayCancel($this->configs);
        $newebPay->setCancelOrder($no, $amt, $type);

        return $newebPay;
    }

    /**
     * 信用卡請款.
     *
     * @param string $no   訂單編號
     * @param int    $amt  訂單金額
     * @param string $type 編號類型
     *                     'order' => 使用商店訂單編號追蹤
     *                     'trade' => 使用藍新金流交易序號追蹤
     *
     * @return NewebPayClose
     */
    public function creditCardChargeback(
        string $no,
        int $amt,
        string $type = 'order'
    ): NewebPayClose {
        $newebPay = new NewebPayClose($this->configs);
        $newebPay->setCloseOrder($no, $amt, $type);
        $newebPay->setCloseType('pay');

        return $newebPay;
    }

    /**
     * 信用卡取消請款.
     *
     * @param string $no   訂單編號
     * @param int    $amt  訂單金額
     * @param string $type 編號類型
     *                     'order' => 使用商店訂單編號追蹤
     *                     'trade' => 使用藍新金流交易序號追蹤
     *
     * @return NewebPayClose
     */
    public function cancelCreditCardChargeback(
        string $no,
        int $amt,
        string $type = 'order'
    ): NewebPayClose {
        $newebPay = new NewebPayClose($this->configs);
        $newebPay->setCloseOrder($no, $amt, $type);
        $newebPay->setCloseType('pay');
        $newebPay->setCancel(true);

        return $newebPay;
    }

    /**
     * 信用卡退款.
     *
     * @param string $no   訂單編號
     * @param int    $amt  訂單金額
     * @param string $type 編號類型
     *                     'order' => 使用商店訂單編號追蹤
     *                     'trade' => 使用藍新金流交易序號追蹤
     *
     * @return NewebPayClose
     */
    public function creditCardRefund(
        string $no,
        int $amt,
        string $type = 'order'
    ): NewebPayClose {
        $newebPay = new NewebPayClose($this->configs);
        $newebPay->setCloseOrder($no, $amt, $type);
        $newebPay->setCloseType('refund');

        return $newebPay;
    }

    /**
     * 信用卡取消退款.
     *
     * @param string $no   訂單編號
     * @param int    $amt  訂單金額
     * @param string $type 編號類型
     *                     'order' => 使用商店訂單編號追蹤
     *                     'trade' => 使用藍新金流交易序號追蹤
     *
     * @return NewebPayClose
     */
    public function cancelCreditCardRefund(
        string $no,
        int $amt,
        string $type = 'order'
    ): NewebPayClose {
        $newebPay = new NewebPayClose($this->configs);
        $newebPay->setCloseOrder($no, $amt, $type);
        $newebPay->setCloseType('refund');
        $newebPay->setCancel(true);

        return $newebPay;
    }

    /**
     * 查詢.
     *
     * @param string $no  訂單編號
     * @param int    $amt 訂單金額
     *
     * @return NewebPayQuery
     */
    public function query(
        string $no,
        int $amt
    ): NewebPayQuery {
        $newebPay = new NewebPayQuery($this->configs);
        $newebPay->setQuery($no, $amt);

        return $newebPay;
    }

    /**
     * 解碼加密字串.
     *
     * @param string $encryptString
     *
     * @throws Exception
     *
     * @return mixed
     */
    public function decode(string $encryptString)
    {
        try {
            $decryptString = $this->decryptDataByAES(
                $encryptString,
                $this->HashKey,
                $this->HashIV
            );

            return json_decode($decryptString, true);
        } catch (Exception $e) {
            throw new Exception($e, $encryptString);
        }
    }

    /**
     * 驗證來源
     *
     * @param  string  $trade
     * @param          $sha
     *
     * @return bool
     */
    public function verify(string $trade, $sha): bool
    {
        return $sha === $this->encryptDataBySHA($trade, $this->HashKey, $this->HashIV);
    }

    /**
     * 從 request 取得解碼加密字串.
     *
     * @throws Exception
     *
     * @return mixed
     */
    public function decodeFromRequest($post)
    {
        if ($this->verify($post['TradeInfo'], $post['TradeSha'])) {
            throw new Exception('TradeSha is not match');
        }

        $tradeInfo = $this->decode($post['TradeInfo']);
        $post['TradeInfo'] = $tradeInfo;

        return $post;
    }
}
