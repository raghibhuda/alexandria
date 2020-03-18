<?php

namespace App\Http\Controllers;

use App\Services\Admin\BookService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            $name = $request->name;
            $categoryId = $request->categoryId;
            $authorId = $request->authorId;
            $publicationId = $request->publicationId;
            $price = $request->price;
            $quantity = $request->quantity;
            $inStock = $request->inStock;
            $language = $request->language;
            $publishedOn = $request->publishedOn;
            $totalPages = $request->totalPages;
            $isbnNumber = $request->isbnNumber;
            $characters = $request->characters;
            $seriesName = $request->seriesName;
            $description = $request->description;

            $rules = [
                'name' => 'required|max:255',
                'categoryId' => 'required|integer|min:1|max:18446744073709551615',
                'authorId' => 'required|integer|min:1|max:18446744073709551615',
                'publicationId' => 'required|integer|min:1|max:18446744073709551615',
                'price' => 'required|float|min:0.00|max:2147483647.00',
                'quantity' => 'required|integer|min:1|max:2147483647',
                'inStock' => 'integer|min:0|max:1',
                'language' => 'required|max:255',
                'publishedOn' => 'required|date_format:Y-m-d',
                'totalPages' => 'required|integer|min:3|max:2147483647',
                'isbnNumber' => 'required|unique|max:255',
                'characters' => 'required|max:255',
                'seriesName' => 'required|max:255',
                'description' => 'required|min:255',
            ];
            $validator = Validator::make([
                $name,
                $categoryId,
                $authorId,
                $publicationId,
                $price,
                $quantity,
                $inStock,
                $language,
                $publishedOn,
                $totalPages,
                $isbnNumber,
                $characters,
                $seriesName,
                $description
            ], $rules);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
            }
            $data = [
                'price' => $price,
                'quantity' => $quantity,
                'in_stock' => $inStock,
                'language' => $language,
                'published_on' => $publishedOn,
                'total_pages' => $totalPages,
                'isbn_number' => $isbnNumber,
                'characters' => $characters,
                'series_name' => $seriesName,
                'description' => $description
            ];
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

            $bookId = $request->bookId;
            $name = $request->name;
            $categoryId = $request->categoryId;
            $authorId = $request->authorId;
            $publicationId = $request->publicationId;
            $price = $request->price;
            $quantity = $request->quantity;
            $inStock = $request->inStock;
            $language = $request->language;
            $publishedOn = $request->publishedOn;
            $totalPages = $request->totalPages;
            $isbnNumber = $request->isbnNumber;
            $characters = $request->characters;
            $seriesName = $request->seriesName;
            $description = $request->description;

            $rules = [
                'bookId' => 'required|integer|min:1|max:18446744073709551615',
                'name' => 'required|max:255',
                'categoryId' => 'required|integer|min:1|max:18446744073709551615',
                'authorId' => 'required|integer|min:1|max:18446744073709551615',
                'publicationId' => 'required|integer|min:1|max:18446744073709551615',
                'price' => 'required|float|min:0.00|max:2147483647.00',
                'quantity' => 'required|integer|min:1|max:2147483647',
                'inStock' => 'integer|min:0|max:1',
                'language' => 'required|max:255',
                'publishedOn' => 'required|date_format:Y-m-d',
                'totalPages' => 'required|integer|min:3|max:2147483647',
                'isbnNumber' => 'required|unique|max:255',
                'characters' => 'required|max:255',
                'seriesName' => 'required|max:255',
                'description' => 'required|min:255',
            ];
            $validator = Validator::make([
                $bookId,
                $name,
                $categoryId,
                $authorId,
                $publicationId,
                $price,
                $quantity,
                $inStock,
                $language,
                $publishedOn,
                $totalPages,
                $isbnNumber,
                $characters,
                $seriesName,
                $description
            ], $rules);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
            }
            $data = [
                'price' => $price,
                'quantity' => $quantity,
                'in_stock' => $inStock,
                'language' => $language,
                'published_on' => $publishedOn,
                'total_pages' => $totalPages,
                'isbn_number' => $isbnNumber,
                'characters' => $characters,
                'series_name' => $seriesName,
                'description' => $description
            ];
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
