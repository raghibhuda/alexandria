<?php


namespace App\Services\Admin;


use App\Publication;
use Illuminate\Database\Eloquent\Collection;

class PublicationService
{
    /**
     * @param $request
     */
    public function createPublication ($request) {
        Publication::create([
            'name' => $request->name,
        ]);
    }

    /**
     * @return Publication[]|Collection
     */
    public function allPublications () {
        return Publication::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findPublications ($id) {
        return Publication::find($id);
    }

    /**
     * @param $category
     * @param $request
     */
    public function updatePublication ($category,$request) {
        $category->update([
            'name' => $request->name,
        ]);
    }

    public function deletePublication ($publication) {
        $publication->delete();
    }
}
