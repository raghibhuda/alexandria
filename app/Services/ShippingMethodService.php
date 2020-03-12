<?php


namespace App\Services\Admin;


use App\ShippingMethod;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class ShippingMethodService
{


    /**
     * @param $id
     * @return mixed
     */
    public function findOne(int $id) {
        $shippingMethod = ShippingMethod::find($id);
        if (!$shippingMethod) {
            return ['success' => false, 'message' => 'Shipping Method not found'];
        }

        return [
            'success' => true,
            'message' => 'Shipping Method has been fetched',
            'shippingMethod' => $shippingMethod
        ];
    }

    /**
     * @return ShippingMethod[]|Collection
     */
    public function findAll():array {
        $shippingMethods = ShippingMethod::all();
        return [
            'success' => true,
            'message' => 'Shipping Method has been fetched',
            'shippingMethods' => $shippingMethods
        ];

    }


    /**
     * @param string $name
     * @return array
     */
    public function create(string $name): array {
        try {
            ShippingMethod::create([
                'name' => $name,
            ]);
            return ['success' => true, 'message' => __('Shipping Method has been created')];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Failed to create Shipping Method')];
        }
    }


    /**
     * @param int $shipping_method_id
     * @param string $name
     * @return array
     */
    public function update(int $shipping_method_id, string $name): array {
        try {
            $shippingMethod = ShippingMethod::where('id', $shipping_method_id)->update([
                'name' => $name,
            ]);
            if (!$shippingMethod) {
                return ['success' => false, 'message' => __('Shipping Method not found')];
            }

            return ['success' => true, 'message' => __('Shipping Method has been updated')];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Something went wrong')];
        }
    }

    /**
     * @param int $shipping_method_id
     * @return array
     */
    public function delete(int $shipping_method_id): array {
        try {
            $shippingMethod = ShippingMethod::where('id', $shipping_method_id)->delete();
            if (!$shippingMethod) {
                return ['success' => false, 'message' => __('Shipping Method not found')];
            }

            return ['success' => true, 'message' => __('Shipping Method has been deleted')];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Something went wrong')];
        }
    }
}
