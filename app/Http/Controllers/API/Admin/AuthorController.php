<?php

namespace App\Http\Controllers;

use App\Services\Admin\AuthorService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
     * @param $id
     * @return JsonResponse
     */
    public function findOne($id) {
        $response = $this->authorService->findOne($id);
        return response()->json([
            'success' => $response['success'],
            'message' => $response['message'],
            'author' => $response['author'],
        ]);
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

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request) {
        try {
            // TODO: Validation required
            $name = $request->name;
            $bio = $request->bio;
            $response = $this->authorService->create($name, $bio);
            return response()->json(['success' => $response['success'], 'message' => $response['message']]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function update(Request $request) {
        try {
            // TODO: Validation required
            $authorId = $request->authorId;
            $name = $request->name;
            $bio = $request->bio;
            $response = $this->authorService->update($authorId, $name, $bio);
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
            $response = $this->authorService->delete($id);
            return response()->json(['success' => $response['message'], 'message' => $response['message']]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
