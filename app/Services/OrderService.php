<?php


namespace App\Services;


use App\Order;
use mysql_xdevapi\Exception;

class OrderService
{
    public function create (array $data) {
        try {
            Order::create ([
                'user_id' => $data['user_id'],
                'shipping_id' => $data['shipping_id'],
                'payment_id' => $data['payment_id'],
                'book_id' => $data['book_id'],
                'total_amount' => $data['total_amount'],
                'quantity' => $data['quantity'],
                'vat' => $data['vat'],
                'tax' => $data['tax'],
            ]);
        } catch (\Exception $e) {

        }
    }

    public function createShipping (array $shippingData) {
        try {

        } catch (\Exception $e) {

        }
    }

}
