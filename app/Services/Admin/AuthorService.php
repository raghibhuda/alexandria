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
            return [
                'success' => true,
                'message' => __('Author has been created')
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => __('Failed to create Author')
            ];
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
     * @param int $author_id
     * @param string $name
     * @param string $bio
     * @return array
     */
    public function update (int $author_id, string $name, string $bio) :array {
        try {
            $author = Author::where('id', $author_id)->update([
                'name' => $name,
                'bio' => $bio,
            ]);
            if (!$author) {
                return ['success' => false, 'message' => __('Author not found')];
            }

            return [
                'success' => true,
                'message' => __('Author has been updated')
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => __('Something went wrong')
            ];
        }
    }

    /**
     * @param int $author_id
     * @return array
     */
    public function delete (int $author_id) :array {
        try {
            $author = Author::where('id', $author_id)->delete();
            if (!$author) {
                return ['success' => false, 'message' => __('Author not found')];
            }

            return ['success' => true, 'message' => __('Author has been deleted')];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Something went wrong')];
        }
    }

}
