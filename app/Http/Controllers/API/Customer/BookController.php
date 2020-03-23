<?php

namespace App\Http\Controllers;

use App\Services\Admin\BookService;
use Illuminate\Http\JsonResponse;


class BookController extends Controller
{
    private $bookService;

    /**
     * BookController constructor.
     */
    public function __construct() {
        $this->bookService = new BookService();
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function findOne($id) {
        $response = $this->bookService->findOne($id);
        return response()->json([
            'success' => $response['success'],
            'message' => $response['message'],
            'book' => $response['book']
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function findAll() {
        $response = $this->bookService->findAll();
        return response()->json([
            'success' => $response['success'],
            'message' => $response['message'],
            'books' => $response['books'],
        ]);
    }

}
