<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    /**
     * OrderController constructor
     */
    public function __construct(OrderService $orderService) {
        $this->orderService = $orderService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function place(Request $request) {
        try {
            $user           = auth()->user();
            $shippingData   = $request->shippingData;
            $orderData      = $request->orderData;
            $response       = $this->orderService->place($user->id, $shippingData, $orderData);
            return response()->json(['success' => $response['success'], 'message' => $response['message']]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * @return JsonResponse
     */
    public function findByUser() {
        $user     = auth()->user();
        $response = $this->orderService->findByUser($user->id);
        return response()->json([
            'success' => $response['success'],
            'message' => $response['message'],
            'orders' => $response['orders']
        ]);
    }

}
