<?php


namespace App\Services\Admin;


use App\Author;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class AuthorService
{

    /**
     * @param $id
     * @return mixed
     */
    public function findOne(int $id): array {
        $author = Author::find($id);
        if (!$author) {
            return ['success' => false, 'message' => 'Author not found'];
        }
        return [
            'success' => true,
            'message' => 'Author has been fetched',
            'author' => $author,
        ];
    }

    /**
     * @return Author[]|Collection
     */
    public function findAll(): array {
        $authors = Author::all();
        return [
            'success' => true,
            'message' => 'Authors have been fetched',
            'authors' => $authors,
        ];

    }


    /**
     * @param string $name
     * @param string $bio
     * @return array
     */
    public function create(string $name, string $bio): array {
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
     * @param int $authorId
     * @param string $name
     * @param string $bio
     * @return array
     */
    public function update(int $authorId, string $name, string $bio): array {
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
    public function delete(int $authorId): array {
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
