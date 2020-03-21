<?php

namespace App\Http\Controllers;

use App\Services\Admin\PublicationService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PublicationController extends Controller
{
    protected $publicationService;

    /**
     * PublicationController constructor.
     */
    public function __construct() {
        $this->publicationService = new PublicationService();
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function findOne($id) {
        $response = $this->publicationService->findOne($id);
        return response()->json([
            'success' => $response['success'],
            'message' => $response['message'],
            'publication' => $response['publication'],
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function findAll() {
        $response = $this->publicationService->findAll();
        return response()->json([
            'success' => $response['success'],
            'message' => $response['message'],
            'publication' => $response['publication'],
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
            $response = $this->publicationService->create($name);
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
            $publicationId = $request->publicationId;
            $name = $request->name;
            $rules = [
                'publicationId' => 'required|integer|min:1|max:18446744073709551615',
                'name' => 'required|max:255',
            ];
            $validator = Validator::make([$publicationId, $name], $rules);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
            }
            $response = $this->publicationService->update($publicationId, $name);
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
            $response = $this->publicationService->delete($id);
            return response()->json(['success' => $response['success'], 'message' => $response['message']]);
        } catch (Exception $e) {
            return response()->json(['success' => true, 'message' => $e->getMessage()]);
        }
    }
}
