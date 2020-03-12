<?php


namespace App\Services;


use App\WishList;
use Exception;

class WishListService
{

    /**
     * @param int $userId
     * @return array
     */
    public function findByUser(int $userId): array {
        $wishList = WishList::where('user_id', $userId)->get();
        if (!$wishList) {
            return ['success' => false, 'message' => __('Wish List is empty')];
        }
        return ['success' => true, 'wishList' => $wishList, 'message' => __('Books have been fetched')];
    }

    /**
     * @param int $userId
     * @param $bookId
     * @return array
     */
    public function add(int $userId, $bookId): array {
        try {
            $wishList = WishList::where(['user_id' => $userId, 'book_id' => $bookId])->first();
            if ($wishList) {
                return ['success' => false, 'message' => __('Already in wish list!')];
            }
            WishList::create([
                'user_id' => $userId,
                'book_id' => $bookId,
            ]);
            return ['success' => true, 'message' => __('Wish list has been updated')];
        } catch (Exception $e) {
            return ['success' => true, 'message' => __('Something went wrong')];
        }
    }

    /**
     * @param int $bookId
     * @return array
     */
    public function remove(int $bookId): array {
        try {
            $wishList = WishList::find($bookId)->delete();
            if (!$wishList) {
                return ['success' => false, 'message' => __('Book not found')];
            }
            return ['success' => true, 'message' => __('Book removed from wish list')];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Failed to remove book from wish list')];
        }
    }


}
