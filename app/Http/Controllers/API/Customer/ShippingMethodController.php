<?php

namespace App\Http\Controllers;

use App\Services\Admin\ShippingMethodService;
use Illuminate\Http\JsonResponse;


class ShippingMethodController extends Controller
{
    protected $shippingMethodService;

    /**
     * ShippingMethodController constructor.
     */
    public function __construct() {
        $this->shippingMethodService = new ShippingMethodService();
    }

    /**
     * @return JsonResponse
     */
    public function findAll() {
        $response = $this->shippingMethodService->findAll();
        return response()->json([
            'success' => $response['success'],
            'message' => $response['message'],
            'shippingMethods' => $response['shippingMethods']
        ]);
    }
}
