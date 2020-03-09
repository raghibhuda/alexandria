<?php


namespace App\Services;


use App\WishList;
use Exception;

class WishListService
{
    /**
     * @param int $user_id
     * @param $book_id
     * @return array
     */
    public function addToWishList(int $user_id, $book_id): array
    {
        try {
            $wishList = WishList::where(['user_id' => $user_id, 'book_id' => $book_id])->first();
            if ($wishList) {
                return [
                    'success' => false,
                    'message' => __('Already in wish list!')
                ];
            }
            WishList::create([
                'user_id' => $user_id,
                'book_id' => $book_id,
            ]);
            return [
                'success' => true,
                'message' => __('Wish list has been updated')
            ];
        } catch (Exception $e) {
            return [
                'success' => true,
                'message' => __('Something went wrong')
            ];
        }
    }

    /**
     * @param int $book_id
     * @return array
     */
    public function removeFromWishList(int $book_id): array
    {
        try {
            $wishList = WishList::find($book_id)->delete();
            if (!$wishList) {
                return [
                    'success' => false,
                    'message' => __('Book not found')
                ];
            }
            return [
                'success' => true,
                'message' => __('Book removed from wish list')
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => __('Failed to remove book from wish list')
            ];
        }
    }
}
