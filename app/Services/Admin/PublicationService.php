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
            return [
                'success' => true,
                'message' => 'Publication has been created'
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to create Publication'
            ];
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
     * @param int $publication_id
     * @param string $name
     * @return array
     */
    public function update (int $publication_id, string $name) :array {
        try {
            $publication = Publication::where('id',$publication_id)->update([
                'name' => $name
            ]);
            if (!$publication) {
                return ['success' => false, 'message' => 'Publication not found'];
            }
            return [
                'success' => true,
                'message' => 'Publication has been updated'
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Something went wrong'
            ];
        }

    }

    /**
     * @param int $publication_id
     * @return array
     */
    public function delete (int $publication_id) :array {
        try {
            $publication = Publication::where('id',$publication_id)->delete();
            if (!$publication) {
                return ['success' => false, 'message' => 'Publication not found'];
            }
            return [
                'success' => true,
                'message' => 'Publication has been deleted'
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Something went wrong'
            ];
        }
    }
}
