<?php

namespace App\Http\Controllers;

use App\Services\WishListService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class WishListController extends Controller
{
    protected $wishListService;

    /**
     * WishListController constructor.
     */
    public function __construct () {
        $this->wishListService = new WishListService();
    }

    /**
     * @return JsonResponse
     */
    public function viewWishList () {
        $user = Auth::user();
        $viewWishListResponse = $this->wishListService->viewWishList($user->id);
        return response()->json([
            'success' => false,
            'message' => $viewWishListResponse['message'],
            'response' => $viewWishListResponse
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function addToWishList (Request $request) {
        try {
            //TODO Need to validate
            $book_id = $request->id;
            $user = Auth::user();
            $addToWishListResponse = $this->wishListService->addToWishList($user->id,$book_id);
            return response()->json([
                'success' => true,
                'message' => $addToWishListResponse['message']
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
    public function removeFromWishList (Request $request) {
        try {
            //TODO Need to validate
            $book_id = $request->id;
            $removeFromWishListResponse  =  $this->wishListService->removeFromWishList($book_id);
            return response()->json([
                'success' => true,
                'message' => $removeFromWishListResponse['message']
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }


}
