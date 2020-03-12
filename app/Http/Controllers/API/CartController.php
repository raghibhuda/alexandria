<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    protected $cartService;

    /**
     * CartController constructor.
     */
    public function __construct() {
        $this->cartService = new CartService();
    }

    /**
     * @return JsonResponse
     */
    public function view() {
        $user = Auth::user();
        $response = $this->cartService->findByUser($user->id);
        return response()->json([
            'success' => $response['success'],
            'message' => $response['message'],
            'cart' => $response['cart']
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function remove(Request $request) {
        try {
            //TODO Need to validate
            $bookId = $request->id;
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
            $bookId = $request->id;
            $user = Auth::user();
            $response = $this->cartService->add($user->id, $bookId);
            return response()->json(['success' => $response['success'], 'message' => $response['message']]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
