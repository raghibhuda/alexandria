<?php

namespace App\Http\Controllers;

use App\Services\Admin\PublicationService;
use Illuminate\Http\JsonResponse;


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
}
