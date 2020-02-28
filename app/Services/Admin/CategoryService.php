<?php


namespace App\Services\Admin;


use App\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    /**
     * @param $request
     */
    public function createCategory ($request) {
        Category::create([
            'name' => $request->name,
        ]);
    }

    /**
     * @return Category[]|Collection
     */
    public function allCategories () {
        return Category::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findCategory ($id) {
        return Category::find($id);
    }

    /**
     * @param $category
     * @param $request
     */
    public function updateCategory ($category,$request) {
        $category->update([
            'name' => $request->name,
        ]);
    }

    public function deleteCategory ($category) {
        $category->delete();
    }
}
