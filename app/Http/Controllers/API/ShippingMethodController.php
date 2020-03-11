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
    public function __construct () {
        $this->shippingMethodService = new ShippingMethodService();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create (Request $request) {
        try {
            // TODO: Validation required
            $name = $request->name;
            $createShippingMethodResponse = $this->shippingMethodService->create($name);
            return response()->json(['success' => true, 'message' => $createShippingMethodResponse['message']]);
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
            $shippingMethodId = $request->shippingMethodId;
            $name = $request->name;
            $updateShippingMethodResponse = $this->shippingMethodService->update($shippingMethodId,$name);
            return response()->json(['success' => true, 'message' => $updateShippingMethodResponse['message']]);
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
    public function find ($id) {
        $shippingMethod = $this->shippingMethodService->find($id);
        return response()->json(['success' => false, 'book' => $shippingMethod]);
    }

    /**
     * @return JsonResponse
     */
    public function shippingMethods () {
        $shippingMethods = $this->shippingMethodService->shippingMethods();
        return response()->json(['success' => false, 'book' => $shippingMethods]);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete ($id) {
        try {
            $deleteShippingMethodResponse = $this->shippingMethodService->delete($id);
            return response()->json(['success' => true, 'message' => $deleteShippingMethodResponse['message']]);
        } catch (Exception $e) {
            return response()->json(['success' => true, 'message' => $e->getMessage()]);
        }
    }
}
