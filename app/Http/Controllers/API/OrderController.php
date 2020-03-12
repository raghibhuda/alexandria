<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $orderService;

    /**
     * OrderController constructor
     */
    public function __construct() {
        $this->orderService = new OrderService();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function placeOrder (Request $request) {
        try {
            $user = Auth::user();
            $shippingData = $request->shippingData;
            $orderData = $request->orderData;
            $placeOrderResponse = $this->orderService->place($user->id,$shippingData,$orderData);
            return response()->json(['success' => true, 'message' => $placeOrderResponse['message']]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * @return JsonResponse
     */
    public function getUserOrders () {
        $user = Auth::user();
        $userOrders = $this->orderService->get($user->id);
        return response()->json([
            'success' => true,
            'message' => $userOrders['message'],
            'orders' => $userOrders['orders']
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function orders () {
        $allOrders  = $this->orderService->orders();
        return response()->json([
            'success' => true,
            'message' => $allOrders['message'],
            'orders' => $allOrders['orders']
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show (int $id) {
        $order = $this->orderService->find($id);
        return response()->json([
            'success' => true,
            'message' => $order['message'],
            'order' => $order['order']
        ]);
    }

}
