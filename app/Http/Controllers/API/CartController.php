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
    public function __construct () {
        $this->cartService = new CartService();
    }

    /**
     * @return JsonResponse
     */
    public function viewCart () {
        $user = Auth::user();
        $viewCartResponse = $this->cartService->viewCart($user->id);
        return response()->json([
            'success' => false,
            'message' => $viewCartResponse['message'],
            'response' => $viewCartResponse
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function removeFromCart (Request $request) {
        try {
            //TODO Need to validate
            $bookId = $request->id;
            $removeFromCartResponse  =  $this->cartService->removeFromCart($bookId);
            return response()->json([
                'success' => true,
                'message' => $removeFromCartResponse['message']
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function addToCart (Request $request) {
        try {
            //TODO Need to validate
             $bookId = $request->id;
             $user = Auth::user();
             $addToCartResponse = $this->cartService->addToCart($user->id,$bookId);
             return response()->json([
                'success' => true,
                'message' => $addToCartResponse['message']
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
