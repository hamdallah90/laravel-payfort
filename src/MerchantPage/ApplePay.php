<?php

namespace MoeenBasra\Payfort\MerchantPage;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use MoeenBasra\Payfort\Exceptions\IncompletePayment;

class ApplePay extends MerchantPage
{
    public function __construct(array $config)
    {
        $this->configure($config);
    }

    /**
     * authorize the tokenized transaction
     *
     * @param array $params
     *
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     * @throws \MoeenBasra\Payfort\Exceptions\IncompletePayment
     */
    public function authorization(array $params): array
    {
        $params = array_merge([
            'command' => 'AUTHORIZATION',
            'digital_wallet' => 'APPLE_PAY',
            'access_code' => $this->access_code,
            'merchant_identifier' => $this->merchant_identifier,
            'language' => $this->language,
            'currency' => $this->currency,
        ], $params);

        // if signature is not already set
        if (!$signature = Arr::get($params, 'signature')) {
            // create signature
            $signature = $this->createSignature($params);

            // add signature in params
            $params['signature'] = $signature;
        }

        // get the validated data for authorization
        $validator = Validator::make($params, ValidationRules::applePayPurchase());

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->client->authorizeTransaction($validator->validated());
    }

    /**
     * get the data for the merchant page
     *
     * @param array $params
     *
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function prepareTokenizationData(array $params): array
    {
        return [];
    }
}
