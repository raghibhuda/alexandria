<?php


namespace App\Services\Admin;


use App\Author;
use Illuminate\Database\Eloquent\Collection;

class AuthorService
{
    /**
     * @param $request
     */
    public function createAuthor ($request) {
        Author::create([
            'name' => $request->name,
            'bio' => $request->bio,
        ]);
    }

    /**
     * @return Author[]|Collection
     */
    public function allAuthors () {
        return Author::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findAuthor ($id) {
        return Author::find($id);
    }

    /**
     * @param $author
     * @param $request
     */
    public function updateAuthor ($author,$request) {
        $author->update([
            'name' => $request->name,
            'bio' => $request->bio,
        ]);
    }

    public function deleteAuthor ($author) {
       $author->delete();
    }

}
