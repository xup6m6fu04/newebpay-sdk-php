# 藍星科技金流 API 專用 PHP SDK

> Fork from [ycs77/laravel-newebpay](https://github.com/ycs77/laravel-newebpay)

[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2Fxup6m6fu04%2Fnewebpay-sdk-php.svg?type=small)](https://app.fossa.com/projects/git%2Bgithub.com%2Fxup6m6fu04%2Fnewebpay-sdk-php?ref=badge_small)
[![StyleCI](https://github.styleci.io/repos/596413768/shield?branch=master)](https://github.styleci.io/repos/596413768?branch=master)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)


## 重要

### 此處為簡易文件說明，要閱讀完整的使用說明及範例詳細講解請參考<br>
https://github.com/xup6m6fu04/newebpay-example

## 說明

調整項目
- 不限制於 Laravel 中使用
- 更新支援至藍星金流最新版本
- 搭配猴子都能懂的完整詳細說明

藍星金流官方文件：https://www.newebpay.com/website/Page/content/download_api

目前支援藍星金流 API 程式碼版本號：2.0

文件版本號：NDNF-1.0.6

目前支援功能
- MPG 交易
- 信用卡請款
- 信用卡取消授權
- 信用卡退款
- 信用卡取消請款
- 信用卡取消退款

## 需求

至少需要 PHP 7.2.5 或以上版本，也支援 PHP 8 以上版本

## 安裝 ##

```sh
$ composer require xup6m6fu04/newebpay-sdk-php
```

## 簡易範例 ##

```php
<?php
use Xup6m6fu04\NewebPay\NewebPay;

/**
 * 送出交易範例
 */
 
// 載入設定檔陣列，內容說明請參考 https://github.com/xup6m6fu04/newebpay-example/blob/master/src/Config/Config.php
$config = [...];

$newebpay = new NewebPay($config);

// 設定訂單內容
$newebpay = $newebpay->payment(
    $_POST['MerchantOrderNo'], // 訂單編號
    $_POST['Amt'], // 訂單金額
    $_POST['ItemDesc'], // 商品名稱
    $_POST['Email'] // 付款人電子信箱
);

// 要更改設定用 ->set + 屬性名稱 (ex: setReturnURL)
$newebpay->setReturnURL(....); // 設定交易完成後的返回網址

// 送出表單
echo $newebpay->submit();
```

## Versioning
This project respects semantic versioning.

See http://semver.org/

## License

[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2Fxup6m6fu04%2Fnewebpay-sdk-php.svg?type=large)](https://app.fossa.com/projects/git%2Bgithub.com%2Fxup6m6fu04%2Fnewebpay-sdk-php?ref=badge_large)
