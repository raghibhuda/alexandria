<?php


namespace App\Services\Admin;


use App\PaymentMethod;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class PaymentMethodService
{
    /**
     * @param string $name
     * @return array
     */
    public function create (string $name) :array {
        try {
            PaymentMethod::create([
                'name' => $name
            ]);
            return [
                'success' => true,
                'message' => 'Payment Method has been saved'
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to create Payment Method'
            ];
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find (int $id) {
        return PaymentMethod::find($id);
    }

    /**
     * @return PaymentMethod[]|Collection
     */
    public function paymentMethods () {
        return PaymentMethod::all();
    }

    /**
     * @param int $payment_method_id
     * @param string $name
     * @return array
     */
    public function update (int $payment_method_id , string $name) :array {
        try {
            $paymentMethod  =  PaymentMethod::where('id',$payment_method_id)->update([
                'name' => $name
            ]);
            if (!$paymentMethod) {
                return ['success' => false, 'message' => 'Payment Method not found'];
            }
            return [
                'success' => false,
                'message' => 'Payment Method has been updated'
            ];
        } catch (Exception $e) {
            return [
                'success' => true,
                'message' => 'Something went wrong'
            ];
        }
    }

    /**
     * @param int $payment_method_id
     * @return array
     */
    public function delete (int $payment_method_id) :array {
        try {
            $paymentMethod  =  PaymentMethod::where('id',$payment_method_id)->delete();
            if (!$paymentMethod) {
                return ['success' => false, 'message' => 'Payment Method not found'];
            }
            return [
                'success' => false,
                'message' => 'Payment Method has been deleted'
            ];
        } catch (Exception $e) {
            return [
                'success' => true,
                'message' => 'Something went wrong'
            ];
        }
    }

}
