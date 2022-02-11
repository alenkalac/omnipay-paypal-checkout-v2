<?php

namespace Omnipay\PayPalCV2;

use Omnipay\Common\AbstractGateway;
use Omnipay\PayPal\Message\AbstractRestRequest;
use Omnipay\PayPal\RestGateway;
use Omnipay\PayPalCV2\Message\RestAuthorizeV2Request;

class RestV2Gateway extends RestGateway {

    public function getName(): string {
        return "PayPal Checkouts V2";
    }

    /**
     * @param array $parameters
     * @return AbstractRestRequest
     */
    public function purchase(array $parameters = array()): AbstractRestRequest {
        return $this->createRequest('\Omnipay\PayPalCV2\Message\RestAuthorizeV2Request', $parameters);
    }

    public function completePurchase(array $parameters = array()): AbstractRestRequest {
        return $this->createRequest('\Omnipay\PayPalCV2\Message\RestV2CompletePurchaseRequest', $parameters);
    }

}