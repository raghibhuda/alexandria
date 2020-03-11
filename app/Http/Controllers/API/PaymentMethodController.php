<?php

namespace App\Http\Controllers;

use App\Services\Admin\PaymentMethodService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;

class PaymentMethodController extends Controller
{
    protected $paymentMethodService;

    /**
     * PaymentMethodController constructor.
     */
    public function __construct () {
        $this->paymentMethodService = new PaymentMethodService();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create (Request $request) {
        try {
            //Validation required
            $name = $request->name;
            $createPaymentMethodResponse = $this->paymentMethodService->create($name);
            return response()->json(['success' => true, 'message' => $createPaymentMethodResponse['message']]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update (Request $request) {
        try {
            //Validation required
            $paymentMethodId = $request->paymentMethodId;
            $name = $request->name;
            $updatePaymentMethodResponse = $this->paymentMethodService->update($paymentMethodId,$name);
            return response()->json(['success' => true, 'message' => $updatePaymentMethodResponse['message']]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function find ($id) {
        $paymentMethod = $this->paymentMethodService->find($id);
        return response()->json(['success' => false, 'book' => $paymentMethod]);
    }

    /**
     * @return JsonResponse
     */
    public function paymentMethods () {
        $paymentMethods = $this->paymentMethodService->paymentMethods();
        return response()->json(['success' => false, 'book' => $paymentMethods]);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete ($id) {
        try {
            $deletePaymentMethodResponse = $this->paymentMethodService->delete($id);
            return response()->json(['success' => true, 'message' => $deletePaymentMethodResponse['message']]);
        } catch (Exception $e) {
            return response()->json(['success' => true, 'message' => $e->getMessage()]);
        }
    }
}
