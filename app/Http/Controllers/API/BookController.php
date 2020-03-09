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
    public function __construct () {
        $this->bookService = new BookService();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create (Request $request) {
        try {
            //Validation required
            $name = $request->name;
            $category_id = $request->category_id;
            $author_id = $request->author_id;
            $publication_id = $request->publication_id;
            $data = $request->data;
            $createBookResponse = $this->bookService->create($name,$category_id,$author_id,$publication_id,$data);
            return response()->json([
                'success' => true,
                'message' => $createBookResponse['message']
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update (Request $request) {
        try {
            //Validation required
            $book_id = $request->book_id;
            $name = $request->name;
            $category_id = $request->category_id;
            $author_id = $request->author_id;
            $publication_id = $request->publication_id;
            $data = $request->data;

            $updateBookResponse = $this->bookService->update($book_id,$name,$category_id,$author_id,$publication_id,$data);
            return response()->json([
                'success' => true,
                'message' => $updateBookResponse['message']
            ]);
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
        $book = $this->bookService->find($id);
        return response()->json([
           'success' => false,
           'book' => $book,
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function books () {
        $books = $this->bookService->books();
        return response()->json([
            'success' => false,
            'book' => $books,
        ]);
    }
    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete ($id) {
        try {
            $deleteBookResponse = $this->bookService->delete($id);
            return response()->json([
                'success' => true,
                'message' => $deleteBookResponse['message']
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

}
