<?php

namespace App\Http\Controllers;

use App\Http\Requests\Wallet\CheckBalanceRequest;
use App\Http\Requests\Wallet\ConfirmPaymentRequest;
use App\Http\Requests\Wallet\PayRequest;
use App\Http\Requests\Wallet\RechargeWalletRequest;
use App\Http\Requests\Wallet\RegisterClientRequest;
use App\Http\Resources\Wallet\CheckBalanceResource;
use App\Http\Resources\Wallet\ConfirmPaymentResource;
use App\Http\Resources\Wallet\PayResource;
use App\Http\Resources\Wallet\RechargeWalletResource;
use App\Http\Resources\Wallet\RegisterClientResource;
use App\Services\WalletService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    protected $soapClient;

    public function __construct(WalletService $soapClient)
    {
        $this->soapClient = $soapClient;
    }

    /**
     * @param RegisterClientRequest $request
     * @return RegisterClientResource
     */
    public function registerClient(RegisterClientRequest $request): RegisterClientResource
    {
        $document = $request->get('document');
        $fullName = $request->get('full_name');
        $email = $request->get('email');
        $phone = $request->get('phone');

        $response = $this->soapClient->registerClient($document, $fullName, $email, $phone);
        return new RegisterClientResource($response);
    }

    /**
     * @param RechargeWalletRequest $request
     * @return RechargeWalletResource
     */
    public function rechargeWallet(RechargeWalletRequest $request): RechargeWalletResource
    {
        $document = $request->get('document');
        $phone = $request->get('phone');
        $amount = $request->get('amount');

        $response = $this->soapClient->rechargeWallet($document, $phone, $amount);
        return new RechargeWalletResource($response);
    }

    /**
     * @param PayRequest $request
     * @return PayResource
     */
    public function pay(PayRequest $request): PayResource
    {
        $document = $request->get('document');
        $phone = $request->get('phone');
        $amount = $request->get('amount');

        $response = $this->soapClient->pay($document, $phone, $amount);
        return new PayResource($response);
    }

    /**
     * @param ConfirmPaymentRequest $request
     * @return ConfirmPaymentResource
     */
    public function confirmPayment(ConfirmPaymentRequest $request): ConfirmPaymentResource
    {
        $sessionId = $request->get('sessionId');
        $token = $request->get('token');

        $response = $this->soapClient->confirmPayment($sessionId, $token);
        return new ConfirmPaymentResource($response);
    }

    /**
     * @param CheckBalanceRequest $request
     * @return CheckBalanceResource
     */
    public function checkBalance(CheckBalanceRequest $request): CheckBalanceResource
    {
        $document = $request->get('document');
        $phone = $request->get('phone');

        $response = $this->soapClient->checkBalance($document, $phone);
        return new CheckBalanceResource($response);
    }
}
