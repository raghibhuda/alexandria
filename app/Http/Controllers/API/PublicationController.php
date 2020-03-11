<?php

namespace App\Http\Controllers;

use App\Services\Admin\PublicationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;

class PublicationController extends Controller
{
    protected $publicationService;

    /**
     * PublicationController constructor.
     */
    public function __construct () {
        $this->publicationService = new PublicationService();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create (Request $request) {
        try {
            //Validation required
            $name = $request->name;
            $createPublicationResponse = $this->publicationService->create($name);
            return response()->json(['success' => true, 'message' => $createPublicationResponse['message']]);
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
            $publicationId = $request->publicationId;
            $name = $request->name;
            $updatePublicationResponse = $this->publicationService->update($publicationId,$name);
            return response()->json(['success' => true, 'message' => $updatePublicationResponse['message']]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function find ($id) {
        $publication = $this->publicationService->find($id);
        return response()->json(['success' => false, 'book' => $publication]);
    }

    /**
     * @return JsonResponse
     */
    public function publications () {
        $publications = $this->publicationService->publications();
        return response()->json(['success' => false, 'book' => $publications]);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete ($id) {
        try {
            $deletePublicationResponse = $this->publicationService->delete($id);
            return response()->json(['success' => true, 'message' => $deletePublicationResponse['message']]);
        } catch (Exception $e) {
            return response()->json(['success' => true, 'message' => $e->getMessage()]);
        }
    }
}
