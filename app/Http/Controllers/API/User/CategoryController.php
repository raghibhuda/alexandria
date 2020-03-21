<?php

namespace App\Http\Controllers;

use App\Services\Admin\CategoryService;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    protected $categoryService;

    /**
     * PaymentMethodController constructor.
     */
    public function __construct() {
        $this->categoryService = new CategoryService();
    }

    /**
     * @return JsonResponse
     */
    public function findAll() {
        $response = $this->categoryService->findAll();
        return response()->json([
            'success' => $response['success'],
            'message' => $response['message'],
            'categories' => $response['categories']
        ]);
    }
}
