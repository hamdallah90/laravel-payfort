<?php


namespace MoeenBasra\Payfort\MerchantPage;

use MoeenBasra\Payfort\ValidationRules as BaseRules;

class ValidationRules extends BaseRules
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public static function tokenization()
    {
        return [
            'service_command' => 'required|in:' . implode(',', self::$service_commands),
            'access_code' => 'required|alpha_num|max:20',
            'merchant_identifier' => 'required|alpha_num|max:20',
            'merchant_reference' => 'required|string|max:40',
            'currency' => 'required|alpha|max:3',
            'language' => 'required|alpha|max:2',
            'signature' => 'required|max:200',
            'expiry_date' => 'digits:4',
            'card_number' => 'digits_between:16,19',
            'card_security_code' => 'digits_between:3,4',
            'card_holder_name' => 'string|max:50',
            'token_name' => 'max:100',
            'new_token_name' => 'max:100',
            'token_status' => 'in:ACTIVE,INACTIVE|max:8',
            'remember_me' => 'in:YES,NO|max:3',
            'return_url' => 'max:400',
        ];
    }

    public static function authorization()
    {
        return [
            'command' => 'required|in:' . implode(',', self::$commands),
            'access_code' => 'required|alpha_num|max:20',
            'merchant_identifier' => 'required|alpha_num|max:20',
            'merchant_reference' => 'required|string|max:40',
            'amount' => 'required|numeric',
            'currency' => 'required|alpha|max:3',
            'language' => 'required|alpha|max:2',
            'customer_email' => 'required|email',
            'customer_ip' => 'required|ip',
            'token_name' => 'required|max:100',
            'signature' => 'required|max:200',
            'payment_option' => 'in:' . implode(',', self::$payment_options),
            'eci' => 'in:' . implode(',', self::$avaiable_eci),
            'order_description' => 'max:150',
            'card_security_code' => 'digits_between:3,4',
            'customer_name' => 'string|max:40',
            'merchant_extra' => 'string|max:999',
            'merchant_extra1' => 'string|max:250',
            'merchant_extra2' => 'string|max:250',
            'merchant_extra3' => 'string|max:250',
            'merchant_extra4' => 'string|max:250',
            'merchant_extra5' => 'string|max:250',
            'recurring_mode' => 'in:' . implode(',', self::$recurring_mode),
            'recurring_transactions_count' => 'string|alpha_num|required_if:recurring_mode,VARIABLE,FIXED',
            'agreement_id' => 'string|alpha_num|max:100',
            'remember_me' => 'in:YES,NO|max:3',
            'phone_number' => 'max:19',
            'settlement_reference' => 'string|max:34',
            'return_url' => 'max:400',
        ];
    }

    public static function applePayPurchase()
    {
        return [
            'command' => 'required|in:purchase',
            'access_code' => 'required|alpha_num|max:20',
            'merchant_identifier' => 'required|alpha_num|max:20',
            'merchant_reference' => 'required|string|max:40',
            'amount' => 'required|numeric',
            'currency' => 'required|alpha|max:3',
            'language' => 'required|alpha|max:2',
            'customer_email' => 'required|email',
            'customer_ip' => 'required|ip',
            'signature' => 'required|max:200',
            'apple_data' => 'required|max:500',
            'apple_signature' => 'required|max:3000',
            'apple_header' => 'required|array',
            'apple_header.apple_transactionId' => 'required|max:100',
            'apple_header.apple_ephemeralPublicKey' => 'required|max:200',
            'apple_header.apple_publicKeyHash' => 'required|max:100',
            'apple_paymentMethod' => 'required|array',
            'apple_paymentMethod.apple_displayName' => 'required|max:50',
            'apple_paymentMethod.apple_network' => 'required|max:50',
            'apple_paymentMethod.apple_type' => 'required|max:20',
            'order_description' => 'max:150',
            'card_security_code' => 'digits_between:3,4',
            'customer_name' => 'string|max:40',
            'merchant_extra' => 'string|max:999',
            'merchant_extra1' => 'string|max:250',
            'merchant_extra2' => 'string|max:250',
            'merchant_extra3' => 'string|max:250',
            'merchant_extra4' => 'string|max:250',
            'merchant_extra5' => 'string|max:250',
            'phone_number' => 'max:19'
        ];
    }

    public static function checkStatus()
    {
        return [
            'query_command' => 'required|in:' . implode(',', self::$query_commands),
            'access_code' => 'required|alpha_num|max:20',
            'merchant_identifier' => 'required|alpha_num|max:20',
            'merchant_reference' => 'required|string|max:40',
            'language' => 'required|alpha|max:2',
            'signature' => 'required|max:200',
            'fort_id' => 'digits_between:10,20',
            'return_third_party_response_codes' => 'in:YES,NO',
        ];
    }
}
