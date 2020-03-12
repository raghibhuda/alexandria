<?php


namespace App\Services\Admin;


use App\PaymentMethod;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class PaymentMethodService
{

    /**
     * @param int $id
     * @return mixed
     */
    public function findOne(int $id): array {
        $paymentMethod = PaymentMethod::find($id);
        if (!$paymentMethod) {
            return ['success' => false, 'message' => 'Payment Method not found'];
        }
        return [
            'success' => true,
            'message' => 'Payment Method has been fetched',
            'paymentMethod' => $paymentMethod,
        ];
    }

    /**
     * @return PaymentMethod[]|Collection
     */
    public function findAll(): array {
        $paymentMethods = PaymentMethod::all();
        return [
            'success' => true,
            'message' => 'Payment Method has been fetched',
            'paymentMethods' => $paymentMethods,
        ];
    }

    /**
     * @param string $name
     * @return array
     */
    public function create(string $name): array {
        try {
            PaymentMethod::create([
                'name' => $name
            ]);
            return ['success' => true, 'message' => 'Payment Method has been saved'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Failed to create Payment Method'];
        }
    }

    /**
     * @param int $paymentMethodId
     * @param string $name
     * @return array
     */
    public function update(int $paymentMethodId, string $name): array {
        try {
            $paymentMethod = PaymentMethod::where('id', $paymentMethodId)->update([
                'name' => $name
            ]);
            if (!$paymentMethod) {
                return ['success' => false, 'message' => 'Payment Method not found'];
            }
            return ['success' => false, 'message' => 'Payment Method has been updated'];
        } catch (Exception $e) {
            return ['success' => true, 'message' => __('Something went wrong')];
        }
    }

    /**
     * @param int $paymentMethodId
     * @return array
     */
    public function delete(int $paymentMethodId): array {
        try {
            $paymentMethod = PaymentMethod::where('id', $paymentMethodId)->delete();
            if (!$paymentMethod) {
                return ['success' => false, 'message' => 'Payment Method not found'];
            }
            return ['success' => false, 'message' => 'Payment Method has been deleted'];
        } catch (Exception $e) {
            return ['success' => true, 'message' => __('Something went wrong')];
        }
    }

}
