<?php

namespace Xup6m6fu04\NewebPay;

class NewebPayQuery extends BaseNewebPay
{
    protected $CheckValues;

    /**
     * The newebpay boot hook.
     *
     * @return void
     */
    public function boot()
    {
        $this->setApiPath('API/QueryTradeInfo');
        $this->setAsyncSender();

        $this->CheckValues['MerchantID'] = $this->MerchantID;
    }

    public function setQuery($no, $amt): NewebPayQuery
    {
        $this->CheckValues['MerchantOrderNo'] = $no;
        $this->CheckValues['Amt'] = $amt;

        return $this;
    }

    /**
     * Get request data.
     *
     * @return array
     */
    public function getRequestData(): array
    {
        $CheckValue = $this->queryCheckValue($this->CheckValues, $this->HashKey, $this->HashIV);

        return [
            'MerchantID' => $this->MerchantID,
            'Version' => $this->configs['Version'],
            'RespondType' =>$this->configs['RespondType'],
            'CheckValue' => $CheckValue,
            'TimeStamp' => $this->timestamp,
            'MerchantOrderNo' => $this->CheckValues['MerchantOrderNo'],
            'Amt' => $this->CheckValues['Amt'],
        ];
    }
}
