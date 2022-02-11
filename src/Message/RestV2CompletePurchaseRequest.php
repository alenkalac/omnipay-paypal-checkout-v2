<?php

namespace Omnipay\PayPalCV2\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\PayPal\Message\RestCompletePurchaseRequest;

class RestV2CompletePurchaseRequest extends RestCompletePurchaseRequest {
    const API_VERSION = 'v2';

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return array
     * @throws InvalidRequestException
     */
    public function getData() {
        $this->validate('transactionReference', 'payerId');
        return ['payer_id' => $this->getPayerId()];
    }

    public function getPayerId() {
        return $this->getParameter('payerId');
    }

    public function getEndpoint(): string {
        $base = $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
        $base .= '/' . self::API_VERSION;
        return $base . '/checkout/orders/' . $this->getTransactionReference() . '/capture';
    }
}