<?php

namespace App\Http\Controllers;

use App\Services\Admin\CategoryService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
     * @param $id
     * @return JsonResponse
     */
    public function findOne($id) {
        $response = $this->categoryService->findOne($id);
        return response()->json([
            'success' => $response['success'],
            'message' => $response['message'],
            'category' => $response['category']
        ]);
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

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request) {
        try {
            $name = $request->name;
            $rules = [
                'name' => 'required|max:255',
            ];
            $validator = Validator::make([$name], $rules);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
            }
            $response = $this->categoryService->create($name);
            return response()->json(['success' => $response['success'], 'message' => $response['message']]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request) {
        try {
            $name = $request->name;
            $categoryId = $request->categoryId;
            $rules = [
                'categoryId' => 'required|integer|min:1|max:18446744073709551615',
                'name' => 'required|max:255',
            ];
            $validator = Validator::make([$categoryId, $name], $rules);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
            }
            $response = $this->categoryService->update($categoryId, $name);
            return response()->json(['success' => $response['success'], 'message' => $response['message']]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }


    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete($id) {
        try {
            $response = $this->categoryService->delete($id);
            return response()->json(['success' => $response['success'], 'message' => $response['message']]);
        } catch (Exception $e) {
            return response()->json(['success' => true, 'message' => $e->getMessage()]);
        }
    }
}
