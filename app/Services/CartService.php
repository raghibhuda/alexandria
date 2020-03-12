<?php


namespace App\Services;


use App\Cart;
use Exception;

class CartService
{
    /**
     * @param int $userId
     * @return array
     */
    public function findByUser(int $userId): array {
        //Cart of the user
        $cart = Cart::where('user_id', $userId)->get();
        if (!$cart) {
            return ['success' => false, 'message' => __('Cart is empty')];
        }
        return ['success' => false, 'cart' => $cart, 'message' => __('Books has been fetched')];

    }

    /**
     * @param int $userId
     * @param int $bookId
     * @return array
     */
    public function add(int $userId, int $bookId): array {
        try {
            $cart = Cart::where(['user_id' => $userId, 'book_id' => $bookId]);
            if ($cart) {
                return ['success' => false, 'message' => __('Book already exits in cart')];
            }
            Cart::create([
                'user_id' => $userId,
                'book_id' => $bookId
            ]);
            return ['success' => true, 'message' => __('Book has been added to cart')];
        } catch (Exception $e) {
            return ['success' => true, 'message' => __('Failed to add book to cart')];
        }
    }

    /**
     * @param int $bookId
     * @return array
     */
    public function remove(int $bookId): array {
        try {
            $book = Cart::where('book_id', $bookId)->delete();
            if (!$book) {
                return ['success' => false, 'message' => __('Book not found in cart')];
            }
            return ['success' => true, 'message' => __('Book has been remove from cart')];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Failed to remove book from cart')];
        }
    }


}
