<?php

namespace Xup6m6fu04\NewebPay\Sender;

use Xup6m6fu04\NewebPay\Contracts\HTTPSender;

class Sync implements HTTPSender
{
    /**
     * Send the data to API.
     *
     * @param  array   $request
     * @param  string  $url
     *
     * @return string
     */
    public function send(array $request, string $url): string
    {
        $result = '<form id="order-form" method="post" action='.$url.' >';

        foreach ($request as $key => $value) {
            $result .= '<input type="hidden" name="'.$key.'" value="'.$value.'">';
        }

        $result .= '</form><script type="text/javascript">document.getElementById(\'order-form\').submit();</script>';

        return $result;
    }
}
