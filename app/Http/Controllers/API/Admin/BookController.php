<?php

namespace App\Http\Controllers;

use App\Services\Admin\BookService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request) {
        try {
            //Validation required
            $name = $request->name;
            $categoryId = $request->categoryId;
            $authorId = $request->authorId;
            $publicationId = $request->publicationId;
            $data = $request->data;
            $response = $this->bookService->create($name, $categoryId, $authorId, $publicationId, $data);
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
            $bookId = $request->bookId;
            $name = $request->name;
            $categoryId = $request->categoryId;
            $authorId = $request->authorId;
            $publicationId = $request->publicationId;
            $data = $request->data;
            $response = $this->bookService->update($bookId, $name, $categoryId, $authorId, $publicationId, $data);
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
            $response = $this->bookService->delete($id);
            return response()->json(['success' => $response['success'], 'message' => $response['message']]);
        } catch (Exception $e) {
            return response()->json(['success' => true, 'message' => $e->getMessage()]);
        }
    }

}
