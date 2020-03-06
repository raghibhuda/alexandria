<?php


namespace App\Services;


use App\Order;
use App\Payment;
use App\Shipping;
use Exception;
use Illuminate\Support\Facades\DB;

class OrderService
{
    /**
     * @param int $user_id
     * @param array $shippingData
     * @param array $orderData
     * @param array $paymentData
     * @return array
     */
    public function placeOrder (int $user_id,array $shippingData , array $orderData ,array $paymentData) :array {
        try {
            DB::beginTransaction();
            $shipping  = $this->createShipping($user_id,$shippingData);
            if (!$shipping['success']) {
                DB::rollBack();
                return [
                    'success' => false,
                    'message' => __('Something went wrong')
                ];
            }

            $payment = $this->createPayment($user_id,$paymentData);
            if (!$payment['success']) {
                DB::rollBack();
                return [
                    'success' => false,
                    'message' => __('Something went wrong')
                ];
            }

            $order = $this->createOrder($shipping['shipping_id'],$payment['payment_id'],$user_id,$orderData);
            if (!$order['success']) {
                DB::rollBack();
                return [
                    'success' => false,
                    'message' => __('Something went wrong')
                ];
            }

            DB::commit();
            return [
                'success' => true,
                'message' => __('Order has been placed')
            ];

        } catch (Exception $e) {
            return [
                'success' => true,
                'message' => __('Failed to place order')
            ];
        }
    }

    public function createOrder (int $user_id,int $shipping_id,int $payment_id, array $orderData) {
        try {
            Order::create ([
                'user_id' => $user_id,
                'shipping_id' => $shipping_id,
                'payment_id' => $payment_id,
                'book_id' => $orderData['book_id'],
                'total_amount' => $orderData['total_amount'],
                'quantity' => $orderData['quantity'],
                'vat' => $orderData['vat'],
                'tax' => $orderData['tax'],
            ]);
            return [
                'success' => true,
                'message' => __('Order has been created')
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => __('Failed to create order')
            ];
        }
    }

    /**
     * @param int $user_id
     * @param array $shippingData
     * @return array
     */
    public function createShipping (int $user_id,array $shippingData) :array {
        try {
            $shipping  =Shipping::create ([
                'user_id' =>$user_id,
                'shipping_method_id' => $shippingData['shipping_method_id'],
                'status' => $shippingData['status'],
                'address' => $shippingData['address'],
                'shipped_on' => $shippingData['shipped_on'],

            ]);
            return [
                'success' => true,
                'shipping_id' => $shipping->id,
                'message' => __('Sipping has been created')
            ];
        } catch (Exception $e) {
            return [
                'success' => true,
                'message' => __('Failed to create shipping')
            ];
        }
    }

    /**
     * @param int $user_id
     * @param array $paymentData
     * @return array
     */
    public function createPayment (int $user_id,array $paymentData) :array {
        try {
            $payment  = Payment::create ([
                'user_id' => $user_id,
                'payment_method_id' => $paymentData['payment_method_id'],
                'amount' => $paymentData['amount'],
                'status' => $paymentData['status'],
            ]);
            return [
                'success' => true,
                'payment_id' => $payment->id,
                'message' => __('Payment has been created')
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => __('Failed to create payment')
            ];
        }
    }

}
