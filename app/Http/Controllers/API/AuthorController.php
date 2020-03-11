<?php

namespace App\Http\Controllers;

use App\Services\Admin\AuthorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;

class AuthorController extends Controller
{
    protected $authorService;

    /**
     * AuthorController constructor.
     */
    public function __construct () {
        $this->authorService = new AuthorService();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create (Request $request) {
        try {
            //Validation required
            $name = $request->name;
            $bio = $request->bio;
            $createAuthorResponse = $this->authorService->create($name,$bio);
            return response()->json(['success' => true, 'message' => $createAuthorResponse['message']]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function update (Request $request) {
        try {
            //Validation required
            $authorId = $request->authorId;
            $name = $request->name;
            $bio = $request->bio;
            $updateAuthorResponse = $this->authorService->update($authorId,$name,$bio);
            return response()->json(['success' => true, 'message' => $updateAuthorResponse['message']]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function find ($id) {
        $author = $this->authorService->find($id);
        return response()->json(['success' => false, 'book' => $author]);
    }

    /**
     * @return JsonResponse
     */
    public function authors () {
        $authors = $this->authorService->authors();
        return response()->json(['success' => false, 'book' => $authors]);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete ($id) {
        try {
            $deleteAuthorResponse = $this->authorService->delete($id);
            return response()->json(['success' => true, 'message' => $deleteAuthorResponse['message']]);
        } catch (Exception $e) {
            return response()->json(['success' => true, 'message' => $e->getMessage()]);
        }
    }
}
