<?php

namespace App\Http\Controllers;

use App\Services\Admin\CategoryService;
use App\Services\Admin\ShippingMethodService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShippingMethodController extends Controller
{
    protected $shippingMethodService;

    /**
     * PaymentMethodController constructor.
     */
    public function __construct() {
        $this->shippingMethodService = new ShippingMethodService();
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function findOne($id) {
        $response = $this->shippingMethodService->findOne($id);
        return response()->json([
            'success' => $response['success'],
            'message' => $response['message'],
            'shippingMethod' => $response['shippingMethod']
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function findAll() {
        $response = $this->shippingMethodService->findAll();
        return response()->json([
            'success' => $response['success'],
            'message' => $response['message'],
            'shippingMethods' => $response['shippingMethods']
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
            $response = $this->shippingMethodService->create($name);
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
            $shippingMethodId = $request->shippingMethodId;
            $rules = [
                'shippingMethodId' => 'required|integer|min:1|max:18446744073709551615',
                'name' => 'required|max:255',
            ];
            $validator = Validator::make([$shippingMethodId, $name], $rules);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
            }
            $response = $this->shippingMethodService->update($shippingMethodId, $name);
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
            $response = $this->shippingMethodService->delete($id);
            return response()->json(['success' => $response['success'], 'message' => $response['message']]);
        } catch (Exception $e) {
            return response()->json(['success' => true, 'message' => $e->getMessage()]);
        }
    }
}
