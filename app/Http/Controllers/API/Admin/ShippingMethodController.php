<?php

namespace App\Http\Controllers;

use App\Services\Admin\ShippingMethodService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;

class ShippingMethodController extends Controller
{
    protected $shippingMethodService;

    /**
     * ShippingMethodController constructor.
     */
    public function __construct (ShippingMethodService $shippingMethodService) {
        $this->shippingMethodService = $shippingMethodService;
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function findOne ($id) {
        $response = $this->shippingMethodService->findOne($id);
        return response()->json([
            'success'           => $response['success'],
            'message'           => $response['message'],
            'shippingMethod'    => $response['shippingMethod']
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function findAll () {
        $response = $this->shippingMethodService->findAll();
        return response()->json([
            'success'           => $response['success'],
            'message'           => $response['message'],
            'shippingMethods'   => $response['shippingMethods']
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create (Request $request) {
        try {
            // TODO: Validation required
            $name       = $request->name;
            $response   = $this->shippingMethodService->create($name);
            return response()->json(['success' => $response['success'], 'message' => $response['message']]);
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
            // TODO: Validation required
            $shippingMethodId   = $request->shippingMethodId;
            $name               = $request->name;
            $response           = $this->shippingMethodService->update($shippingMethodId,$name);
            return response()->json(['success' => $response['success'], 'message' => $response['message']]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }



    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete ($id) {
        try {
            $response = $this->shippingMethodService->delete($id);
            return response()->json(['success' => $response['success'], 'message' => $response['message']]);
        } catch (Exception $e) {
            return response()->json(['success' => true, 'message' => $e->getMessage()]);
        }
    }
}
