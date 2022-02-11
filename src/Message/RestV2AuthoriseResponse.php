<?php

namespace Omnipay\PayPalCV2\Message;

use Omnipay\PayPal\Message\RestAuthorizeResponse;

class RestV2AuthoriseResponse extends RestAuthorizeResponse {

    public function isSuccessful() {
        return $this->getCode() == 201;
    }

    public function getTransactionReference() {
        return $this->data['id'];
    }

    public function getRedirectUrl() {
        if (isset($this->data['links']) && is_array($this->data['links'])) {
            foreach ($this->data['links'] as $key => $value) {
                if ($value['rel'] == 'self') {
                    return $value['href'];
                }
            }
        }

        return null;
    }
}