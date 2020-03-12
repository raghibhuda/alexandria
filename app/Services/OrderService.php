<?php


namespace App\Services;


use App\Order;
use App\Shipping;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class OrderService
{

    /**
     * @param int $id
     * @return array
     */
    public function findOne(int $id): array {
        $order = Order::find($id);
        if (!$order) {
            return ['success' => false, 'message' => 'Order not found'];
        }
        return [
            'success' => true,
            'message' => __('Order has been found'),
            'order' => $order,
        ];
    }

    /**
     * @return Order[]|Collection
     */
    public function findAll(): array {
        $orders = Order::all();
        return [
            'success' => true,
            'message' => __('Order has been found'),
            'orders' => $orders,
        ];

    }

    /**
     * @param int $userId
     * @return array
     */
    public function findByUser(int $userId) {
        $orders = Order::where('user_id', $userId);
        if (!$orders) {
            return ['success' => false, 'message' => __('User not found')];
        }
        return [
            'success' => true,
            'message' => __('Orders have been fetched'),
            'orders' => $orders,
        ];
    }

    /**
     * @param int $userId
     * @param array $shippingData
     * @param array $orderData
     * @return array
     */
    public function place(int $userId, array $shippingData, array $orderData): array {
        try {
            DB::beginTransaction();
            $shipping = $this->createShipping($userId, $shippingData);
            if (!$shipping['success']) {
                DB::rollBack();
                return ['success' => false, 'message' => __('Something went wrong')];
            }

            $order = $this->createOrder($shipping['shippingId'], $userId, $orderData);
            if (!$order['success']) {
                DB::rollBack();
                return ['success' => false, 'message' => __('Something went wrong')];
            }

            $cart = new CartService();
            $carResponse = $cart->remove($order['bookId']);
            if (!$carResponse['success']) {
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
     * @param array $shippingData
     * @return array
     */
    public function createShipping(int $userId, array $shippingData): array {
        try {
            $shipping = Shipping::create([
                'user_id' => $userId,
                'shipping_method_id' => $shippingData['shippingMethodId'],
                'address' => $shippingData['address'],
                'shipped_on' => $shippingData['shippedOn'],
                'contact' => $shippingData['address'],
            ]);
            return ['success' => true, 'shippingId' => $shipping->id, 'message' => __('Sipping has been created')];
        } catch (Exception $e) {
            return ['success' => true, 'message' => __('Failed to create shipping')];
        }
    }

    /**
     * @param int $userId
     * @param int $shippingId
     * @param array $orderData
     * @return array
     */
    public function createOrder(int $userId, int $shippingId, array $orderData) {
        try {
            $order = Order::create([
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
            return [
                'success' => true,
                'bookId' => $order->book_id,
                'message' => __('Order has been created')];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Failed to create order')];
        }
    }

}
