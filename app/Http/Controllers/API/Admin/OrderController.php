<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\JsonResponse;

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
     * @return JsonResponse
     */
    public function findAll() {
        $response = $this->orderService->findAll();
        return response()->json([
            'success' => $response['success'],
            'message' => $response['message'],
            'orders'  => $response['orders']
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function findOne(int $id) {
        $response = $this->orderService->findOne($id);
        return response()->json([
            'success' => $response['success'],
            'message' => $response['message'],
            'order'   => $response['order']
        ]);
    }

}
