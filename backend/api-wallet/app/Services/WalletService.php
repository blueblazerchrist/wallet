<?php

namespace app\Services;

use App\Soap\Client;

class WalletService
{
    protected $client;

    public function __construct()
    {
        $wsdl = config('soap.wsdl');
        $options = [
            'soap_version' => SOAP_1_2,
        ];
        $this->client = new Client($wsdl, $options);
    }

    /**
     * @param $document
     * @param $name
     * @param $email
     * @param $phone
     * @return mixed|string
     */
    public function registerClient($document, $name, $email, $phone)
    {
        $this->client->registerClient($document,$name,$email,$phone);
        return $this->client->getLastResponse();
    }

    /**
     * @param $document
     * @param $phone
     * @param $amount
     * @return mixed|string
     */
    public function rechargeWallet($document, $phone, $amount)
    {
        $this->client->rechargeWallet($document, $phone, $amount);
        return $this->client->getLastResponse();
    }

    /**
     * @param $document
     * @param $phone
     * @param $amount
     * @return mixed|string
     */
    public function pay($document, $phone, $amount)
    {
        $this->client->pay($document, $phone, $amount);
        return $this->client->getLastResponse();
    }

    /**
     * @param $sessionId
     * @param $token
     * @return mixed|string
     */
    public function confirmPayment($sessionId, $token)
    {
        $this->client->confirmPayment($sessionId, $token);
        return $this->client->getLastResponse();
    }

    /**
     * @param $document
     * @param $phone
     * @return mixed|string
     */
    public function checkBalance($document, $phone)
    {
        $this->client->checkBalance($document, $phone);
        return $this->client->getLastResponse();
    }
}
