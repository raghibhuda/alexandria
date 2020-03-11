<?php


namespace App\Services;


use App\Order;
use App\Shipping;
use Exception;
use Illuminate\Support\Facades\DB;

class OrderService
{
    /**
     * @param int $userId
     * @param array $shippingData
     * @param array $orderData
     * @return array
     */
    public function place (int $userId,array $shippingData , array $orderData) :array {
        try {
            DB::beginTransaction();
            $shipping  = $this->createShipping($userId,$shippingData);
            if (!$shipping['success']) {
                DB::rollBack();
                return ['success' => false, 'message' => __('Something went wrong')];
            }

            $order = $this->createOrder($shipping['shipping_id'],$userId,$orderData);
            if (!$order['success']) {
                DB::rollBack();
                return ['success' => false, 'message' => __('Something went wrong')];
            }
            DB::commit();
            return ['success' => true, 'message' => __('Order has been placed')];

        } catch (Exception $e) {
            return ['success' => true, 'message' => __('Failed to place order')];
        }
    }

    /**
     * @param int $userId
     * @param int $shippingId
     * @param array $orderData
     * @return array
     */
    public function createOrder (int $userId,int $shippingId, array $orderData) {
        try {
            Order::create ([
                'user_id' => $userId,
                'shipping_id' => $shippingId,
                'book_id' => $orderData['bookId'],
                'total_amount' => $orderData['totalAmount'],
                'quantity' => $orderData['quantity'],
                'payment_method_id' => $orderData['paymentMethodId'],
                'vat' => $orderData['vat'],
                'tax' => $orderData['tax'],
                'status' => $orderData['status']
            ]);
            return ['success' => true, 'message' => __('Order has been created')];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Failed to create order')];
        }
    }

    /**
     * @param int $userId
     * @param array $shippingData
     * @return array
     */
    public function createShipping (int $userId,array $shippingData) :array {
        try {
            $shipping  =Shipping::create ([
                'user_id' =>$userId,
                'shipping_method_id' => $shippingData['shippingMethodId'],
                'address' => $shippingData['address'],
                'shipped_on' => $shippingData['shipped_on'],
                'contact' => $shippingData['address'],
            ]);
            return ['success' => true, 'shipping_id' => $shipping->id, 'message' => __('Sipping has been created')];
        } catch (Exception $e) {
            return ['success' => true, 'message' => __('Failed to create shipping')];
        }
    }

}
