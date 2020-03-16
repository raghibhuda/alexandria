<?php

namespace App\Http\Controllers;

use App\Services\WishListService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    protected $wishListService;

    /**
     * WishListController constructor.
     */
    public function __construct(WishListService $wishListService) {
        $this->wishListService = $wishListService;
    }

    /**
     * @return JsonResponse
     */
    public function findByUser() {
        $user     = auth()->user();
        $response = $this->wishListService->findByUser($user->id);
        return response()->json([
            'success'  => $response['success'],
            'message'  => $response['message'],
            'wishList' => $response['wishList']
        ]);
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
            $response = $this->wishListService->add($user->id, $bookId);
            return response()->json(['success' => $response['success'], 'message' => $response['message']]);

        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function remove(Request $request) {
        try {
            //TODO Need to validate
            $bookId   = $request->id;
            $response = $this->wishListService->remove($bookId);
            return response()->json(['success' => $response['success'], 'message' => $response['message']]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }


}
