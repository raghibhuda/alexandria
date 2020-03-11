<?php


namespace App\Services\Admin;


use App\Publication;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class PublicationService
{
    /**
     * @param string $name
     * @return array
     */
    public function create (string $name) :array {
        try {
            Publication::create([
                'name' => $name,
            ]);
            return ['success' => true, 'message' => 'Publication has been created'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Failed to create Publication'];
        }

    }

    /**
     * @return Publication[]|Collection
     */
    public function publications () {
        return Publication::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find (int $id) {
        return Publication::find($id);
    }

    /**
     * @param int $publicationId
     * @param string $name
     * @return array
     */
    public function update (int $publicationId, string $name) :array {
        try {
            $publication = Publication::where('id',$publicationId)->update([
                'name' => $name
            ]);
            if (!$publication) {
                return ['success' => false, 'message' => 'Publication not found'];
            }
            return ['success' => true, 'message' => 'Publication has been updated'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Something went wrong')];
        }

    }

    /**
     * @param int $publicationId
     * @return array
     */
    public function delete (int $publicationId) :array {
        try {
            $publication = Publication::where('id',$publicationId)->delete();
            if (!$publication) {
                return ['success' => false, 'message' => 'Publication not found'];
            }
            return ['success' => true, 'message' => 'Publication has been deleted'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Something went wrong')];
        }
    }
}
