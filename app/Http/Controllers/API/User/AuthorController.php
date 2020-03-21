<?php

namespace App\Http\Controllers;

use App\Services\Admin\AuthorService;
use Illuminate\Http\JsonResponse;

class AuthorController extends Controller
{
    protected $authorService;

    /**
     * AuthorController constructor.
     */
    public function __construct() {
        $this->authorService = new AuthorService();
    }

    /**
     * @return JsonResponse
     */
    public function findAll() {
        $response = $this->authorService->findAll();
        return response()->json([
            'success' => $response['success'],
            'message' => $response['message'],
            'authors' => $response['authors'],
        ]);
    }
}
