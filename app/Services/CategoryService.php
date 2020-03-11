<?php


namespace App\Services\Admin;


use App\Category;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    /**
     * @param string $name
     * @return array
     */
    public function create (string $name) :array {
        try {
            Category::create([
                'name' => $name,
            ]);
            return ['success' => true, 'message' => 'Category has been created'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Failed to create Category'];
        }

    }

    /**
     * @return Category[]|Collection
     */
    public function categories () {
        return Category::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find (int $id) {
        return Category::find($id);
    }

    /**
     * @param int $categoryId
     * @param string $name
     * @return array
     */
    public function update (int $categoryId, string $name) :array {
        try {
            $category = Category::where('id',$categoryId)->update([
               'name' => $name
            ]);
            if (!$category) {
                return ['success' => false, 'message' => 'Category no found'];
            }
            return ['success' => true, 'message' => 'Category has been updated'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Something went wrong')];
        }

    }

    /**
     * @param int $categoryId
     * @return array
     */
    public function delete (int $categoryId) :array {
        try {
            $category = Category::where('id',$categoryId)->delete();
            if (!$category) {
                return ['success' => false, 'message' => 'Category no found'];
            }
            return ['success' => true, 'message' => 'Category has been updated'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Something went wrong')];
        }
    }
}
