<?php

namespace Omnipay\PayPalCV2\Message;

use Omnipay\Common\Exception\InvalidCreditCardException;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Item;
use Omnipay\PayPal\Message\RestAuthorizeRequest;

class RestAuthorizeV2Request extends RestAuthorizeRequest {
    const API_VERSION = 'v2';

    public function getEndpoint(): string {
        $base = $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
        $base .= '/' . self::API_VERSION;
        return $base . '/checkout/orders';
    }

    /**
     * @throws InvalidRequestException
     */
    public function getData(): array {
        $body = [];
        $body['intent'] = "CAPTURE";
        $body['application_context'] = [
            "return_url" => $this->getReturnUrl(),
            "cancel_url" => $this->getCancelUrl(),
            "shipping_preference" => "NO_SHIPPING",
        ];
        $body['purchase_units'] = [];
        $body['purchase_units'][] = [
            "amount" => [
                "currency_code" => $this->getCurrency(),
                "value" => $this->getAmount(),
            ]
        ];
        if(!empty($this->getItems())) {
            $body['purchase_units'][0]["amount"]["breakdown"] = [
                "item_total" => [
                    "value" => $this->getAmount(),
                    "currency_code" => $this->getCurrency()
                ]
            ];

            $body['purchase_units'][0]['items'] = [];

            /** @var Item $item */
            foreach ($this->getItems() as $item) {
                $body['purchase_units'][0]['items'][] = [
                    "name" => $item->getName(),
                    "description" => $item->getDescription(),
                    "quantity" => $item->getQuantity(),
                    "unit_amount" => [
                        "value" => $item->getPrice(),
                        "currency_code" => $this->getCurrency()
                    ]
                ];
            }
        }
        return $body;
    }

    protected function createResponse($data, $statusCode): RestV2AuthoriseResponse {
        return $this->response = new RestV2AuthoriseResponse($this, $data, $statusCode);
    }
}