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
            return [
                'success' => true,
                'message' => 'Category has been created'
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to create Category'
            ];
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
     * @param int $category_id
     * @param string $name
     * @return array
     */
    public function update (int $category_id, string $name) :array {
        try {
            $category = Category::where('id',$category_id)->update([
               'name' => $name
            ]);
            if (!$category) {
                return ['success' => false, 'message' => 'Category no found'];
            }
            return [
                'success' => true,
                'message' => 'Category has been updated'
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Something went wrong'
            ];
        }

    }

    /**
     * @param int $category_id
     * @return array
     */
    public function delete (int $category_id) :array {
        try {
            $category = Category::where('id',$category_id)->delete();
            if (!$category) {
                return ['success' => false, 'message' => 'Category no found'];
            }
            return [
                'success' => true,
                'message' => 'Category has been updated'
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Something went wrong'
            ];
        }
    }
}
