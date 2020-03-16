<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    /**
     * CartController constructor.
     */
    public function __construct(CartService $cartService) {
        $this->cartService = $cartService;
    }

    /**
     * @return JsonResponse
     */
    public function view() {
        $user     = auth()->user();
        $response = $this->cartService->findByUser($user->id);
        return response()->json([
            'success' => $response['success'],
            'message' => $response['message'],
            'cart'    => $response['cart']
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function remove(Request $request) {
        try {
            //TODO Need to validate
            $bookId   = $request->id;
            $response = $this->cartService->remove($bookId);
            return response()->json(['success' => $response['success'], 'message' => $response['message']]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function add(Request $request) {
        try {
            //TODO Need to validate
            $bookId   = $request->id;
            $user     = auth()->user();
            $response = $this->cartService->add($user->id, $bookId);
            return response()->json(['success' => $response['success'], 'message' => $response['message']]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
