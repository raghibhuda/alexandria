<?php

namespace App\Http\Controllers;

use App\Services\Admin\PaymentMethodService;
use Illuminate\Http\JsonResponse;


class PaymentMethodController extends Controller
{
    protected $paymentMethodService;

    /**
     * PaymentMethodController constructor.
     */
    public function __construct() {
        $this->paymentMethodService = new PaymentMethodService();
    }


    /**
     * @return JsonResponse
     */
    public function findAll() {
        $response = $this->paymentMethodService->findAll();
        return response()->json([
            'success' => $response['success'],
            'message' => $response['message'],
            'paymentMethods' => $response['paymentMethods']
        ]);
    }
}
