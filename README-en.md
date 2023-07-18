# NewebPay Payment API PHP SDK

> Forked from [ycs77/laravel-newebpay](https://github.com/ycs77/laravel-newebpay)

[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2Fxup6m6fu04%2Fnewebpay-sdk-php.svg?type=small)](https://app.fossa.com/projects/git%2Bgithub.com%2Fxup6m6fu04%2Fnewebpay-sdk-php?ref=badge_small)
[![StyleCI](https://github.styleci.io/repos/596413768/shield?branch=master)](https://github.styleci.io/repos/596413768?branch=master)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)


## Important

### This document provides a brief overview. For a complete usage guide and detailed examples, please refer to:<br>
https://github.com/xup6m6fu04/newebpay-example

## Description

Adjusted Items
- Not restricted for use within Laravel
- Updated to support the latest version of NewebPay
- Comes with a detailed explanation that's easy to understand

Official NewebPay Documentation: https://www.newebpay.com/website/Page/content/download_api

Currently supports NewebPay API version: 2.0

Document version: NDNF-1.0.6

Currently supported features
- MPG Transaction
- Credit Card Billing
- Credit Card Authorization Cancellation
- Credit Card Refund
- Credit Card Billing Cancellation
- Credit Card Refund Cancellation

## Requirements

Requires at least PHP 7.2.5 or above, also supports PHP 8 and above

## Installation

```sh
$ composer require xup6m6fu04/newebpay-sdk-php
```
## Simple Example

```php
<?php
use Xup6m6fu04\NewebPay\NewebPay;

/**
 * Transaction submission example
 */
 
// Load the configuration array. For more information, please refer to: https://github.com/xup6m6fu04/newebpay-example/blob/master/src/Config/Config.php
$config = [...];

$newebpay = new NewebPay($config);

// Set the order details
$newebpay = $newebpay->payment(
    $_POST['MerchantOrderNo'], // Order Number
    $_POST['Amt'], // Order Amount
    $_POST['ItemDesc'], // Product Name
    $_POST['Email'] // Payer's Email
);

// To change the settings, use ->set + property name (ex: setReturnURL)
$newebpay->setReturnURL(....); // Set the return URL after the transaction is completed

// Submit the form
echo $newebpay->submit();
```


## Versioning
This project respects semantic versioning.

See http://semver.org/

## License

[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2Fxup6m6fu04%2Fnewebpay-sdk-php.svg?type=large)](https://app.fossa.com/projects/git%2Bgithub.com%2Fxup6m6fu04%2Fnewebpay-sdk-php?ref=badge_large)
