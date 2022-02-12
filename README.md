Omnipay is a framework agnostic, multi-gateway payment processing library for PHP. This package implements PayPal support for Omnipay.

Installation
Omnipay is installed via Composer. To install, simply require league/omnipay and omnipay/paypal with Composer:

composer require league/omnipay alenkalac/omnipay-paypal-checkout-v2
Basic Usage
The following gateways are provided by this package:

Loading in the Gateway
```php
Omnipay::create("\Omnipay\PayPalCV2\RestV2Gateway");
```

In addition to the above - you also get the [**omnipay/paypal** Gateways](https://github.com/thephpleague/omnipay-paypal)

* PayPal_Express (PayPal Express Checkout)
* PayPal_ExpressInContext (PayPal Express In-Context Checkout)
* PayPal_Pro (PayPal Website Payments Pro)
* PayPal_Rest (Paypal Rest API)

For general usage instructions, please see the main Omnipay repository.