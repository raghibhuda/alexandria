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
    public function findAll(): array {
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
     * @param int $shippingMethodId
     * @param string $name
     * @return array
     */
    public function update(int $shippingMethodId, string $name): array {
        try {
            $shippingMethod = ShippingMethod::where('id', $shippingMethodId)->update([
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
     * @param int $shippingMethodId
     * @return array
     */
    public function delete(int $shippingMethodId): array {
        try {
            $shippingMethod = ShippingMethod::where('id', $shippingMethodId)->delete();
            if (!$shippingMethod) {
                return ['success' => false, 'message' => __('Shipping Method not found')];
            }

            return ['success' => true, 'message' => __('Shipping Method has been deleted')];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Failed to delete Shipping Method')];
        }
    }
}
