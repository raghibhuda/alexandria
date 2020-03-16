<?php

namespace App\Http\Controllers;

use App\Services\Admin\PaymentMethodService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    protected $paymentMethodService;

    /**
     * PaymentMethodController constructor.
     */
    public function __construct() {
        $this->paymentMethodService = new PaymentMethodService();
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function findOne($id) {
        $response = $this->paymentMethodService->findOne($id);
        return response()->json([
            'success' => $response['success'],
            'message' => $response['message'],
            'paymentMethod' => $response['paymentMethod']
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function findAll() {
        $response = $this->paymentMethodService->findAll();
        return response()->json([
            'success' => $response['success'],
            'message' => $response['message'],
            'paymentMethods' => $response['paymentMethods']
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request) {
        try {
            //Validation required
            $name = $request->name;
            $response = $this->paymentMethodService->create($name);
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
            //Validation required
            $paymentMethodId = $request->paymentMethodId;
            $name = $request->name;
            $response = $this->paymentMethodService->update($paymentMethodId, $name);
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
            $response = $this->paymentMethodService->delete($id);
            return response()->json(['success' => $response['success'], 'message' => $response['message']]);
        } catch (Exception $e) {
            return response()->json(['success' => true, 'message' => $e->getMessage()]);
        }
    }
}
