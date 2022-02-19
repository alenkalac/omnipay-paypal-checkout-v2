<?php

namespace Omnipay\PayPalCV2\Message;

use Omnipay\Common\Message\RequestInterface;
use Omnipay\PayPal\Message\RestResponse;

class PayPalV2RestResponse extends RestResponse {

    public function __construct(RequestInterface $request, $data, $statusCode = 200) {
        parent::__construct($request, $data, $statusCode);
    }

    public function getTransactionReference() {
        // This is usually correct for payments, authorizations, etc
        if (!empty($this->data['purchase_units']) && !empty($this->data['purchase_units'][0]['payments'])) {
            foreach (array('sale', 'authorization', 'captures') as $type) {
                if (!empty($this->data['purchase_units'][0]['payments'][$type][0])) {
                    return $this->data['purchase_units'][0]['payments'][$type][0]['id'];
                }
            }
        }

        // This is a fallback, but is correct for fetch transaction and possibly others
        if (!empty($this->data['id'])) {
            return $this->data['id'];
        }

        return null;
    }

}