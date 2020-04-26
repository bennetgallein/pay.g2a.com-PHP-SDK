<h1 align="center">Welcome to G2A Payment Gateway SDK for PHP 👋</h1>
<p>
  <a href="#" target="_blank">
    <img alt="License: MIT" src="https://img.shields.io/badge/License-MIT-yellow.svg" />
  </a>
  <a href="https://twitter.com/bennetgallein" target="_blank">
    <img alt="Twitter: bennetgallein" src="https://img.shields.io/twitter/follow/bennetgallein.svg?style=social" />
  </a>
</p>

> This is a SDK to simplify working with the G2A payment gateway

### 🏠 [Homepage](https://bennetgallein.de)

## Install

```sh
composer require bennetgallein/pay.g2a.com-php-sdk
```

## Usage

This will give a quick example how to use this SDK to generate a payment and redirect the user.

```php
use G2APay\G2APay;
use G2APay\Types\Enums\Environment;
use G2APay\Types\Item;
use Tracy\Debugger;

$g2a = new G2APay(
    "test@example.com", // your merchants email address
    '12345678-1234-12345-12345-123456789012', // your API hash
    'GDG#*)G*Wd#80Ggd*)G#80db380bnf3ijf3iW()#hb[pwai4u3f4b4UU3#$(%ubUb#', // your API secret
    Environment::SANBDOX // which env to use. Can be Environment::SANDBOX or Environment::PRODUCTION. Default is production
);

$payment = $g2a->createPayment() // initiates a new payment class
    ->addItem((new Item()) // add an item to it
        ->setSku("sku") // set the sku for the item
        ->setName("Test Product") // set the name for the item
        ->setAmount(20.00) // the the total price (quantity * price)
        ->setQuantity(2) // quantity of the item
        ->setId(1) // item id, this is internal to your system
        ->setPrice(10.00) // price per one item
        ->setUrl('https://test.com/product') // url to the product
    )
    ->setOrderId(1) // order id, this is internal to you system
    ->setAmount(20.00) // total amount of the transaction
    ->setCurrency('EUR') // ISO 4217 conform currency code
    ->setEmail('me@bennetgallein.de') // customers email
    ->setFailureUrl('https://test.com/failed') // callback url on failed payment (user abort for example)
    ->setOkUrl('https://test.com/success') // return url if the user approves. get-Parameter "transactionId" contains the transactionId
    ->setCustomerIPAddress('123.123.123.123') // customers ipv4 address
    ->create(); // create the payment

$checkoutUrl = $g2a->getCheckoutUrl($payment->token); // get the checkout url from token
header("Location: ${checkoutUrl}"); // redirect the user
```

get information about a transaction
```php
$payment = $g2a->createPayment()->getPayment("paymentId");
```

## Author

👤 **Bennet Gallein**

* Website: http://bennetgallein.de
* Twitter: [@bennetgallein](https://twitter.com/bennetgallein)
* Github: [@bennetgallein](https://github.com/bennetgallein)

## Show your support

Give a ⭐️ if this project helped you!

***
_This README was generated with ❤️ by [readme-md-generator](https://github.com/kefranabg/readme-md-generator)_