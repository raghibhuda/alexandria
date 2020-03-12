<?php


namespace App\Services\Admin;


use App\Author;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class AuthorService
{
    /**
     * @param string $name
     * @param string $bio
     * @return array
     */
    public function create (string $name, string $bio) :array {
        try {
            Author::create([
                'name' => $name,
                'bio' => $bio,
            ]);
            return ['success' => true, 'message' => __('Author has been created')];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Failed to create Author')];
        }
    }

    /**
     * @return Author[]|Collection
     */
    public function authors () {
        return Author::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find (int $id) {
        return Author::find($id);
    }

    /**
     * @param int $authorId
     * @param string $name
     * @param string $bio
     * @return array
     */
    public function update (int $authorId, string $name, string $bio) :array {
        try {
            $author = Author::where('id', $authorId)->update([
                'name' => $name,
                'bio' => $bio,
            ]);
            if (!$author) {
                return ['success' => false, 'message' => __('Author not found')];
            }
            return ['success' => true, 'message' => __('Author has been updated')];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Something went wrong')];
        }
    }

    /**
     * @param int $authorId
     * @return array
     */
    public function delete (int $authorId) :array {
        try {
            $author = Author::where('id', $authorId)->delete();
            if (!$author) {
                return ['success' => false, 'message' => __('Author not found')];
            }
            return ['success' => true, 'message' => __('Author has been deleted')];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Something went wrong')];
        }
    }

}
