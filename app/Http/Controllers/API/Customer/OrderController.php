<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    protected $orderService;

    /**
     * OrderController constructor
     */
    public function __construct() {
        $this->orderService = new OrderService();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function place(Request $request) {
        try {
            $user = Auth::user();
            $shippingMethodId = $request->shippingMethodId;
            $address = $request->address;
            $contact = $request->contact;
            $bookId = $request->bookId;
            $totalAmount = $request->totalAmount;
            $quantity = $request->quantity;
            $paymentMethodId = $request->paymentMethodId;
            $vat = $request->vat;
            $tax = $request->tax;
            $rules = [
                'shippingMethodId' => 'required|integer|min:1|max:18446744073709551615',
                'address' => 'required|min:255',
                'contact' => 'required|max:255',
                'bookId' => 'required|integer|min:1|max:18446744073709551615',
                'totalAmount' => 'required|float|min:0.00|max:2147483647.00',
                'quantity' => 'required|integer|min:1|max:2147483647',
                'paymentMethodId' => 'required|integer|min:1|max:18446744073709551615',
                'vat' => 'required|float|min:0.00|max:2147483647.00',
                'tax' => 'required|float|min:0.00|max:2147483647.00',
            ];
            $validator = Validator::make([
                $shippingMethodId,
                $address,
                $contact,
                $bookId,
                $totalAmount,
                $quantity,
                $paymentMethodId,
                $vat,
                $tax
            ], $rules);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
            }
            $shippingData = [
                'user_id' => $user->id,
                'shipping_method_id' => $shippingMethodId,
                'address' => $address,
                'contact' => $contact,
            ];
            $orderData = [
                'user_id' => $user->id,
                'book_id' => $bookId,
                'total_amount' => $totalAmount,
                'quantity' => $quantity,
                'payment_method_id' => $paymentMethodId,
                'vat' => $vat,
                'tax' => $tax,
            ];
            $response = $this->orderService->place($user->id, $shippingData, $orderData);
            return response()->json(['success' => $response['success'], 'message' => $response['message']]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * @return JsonResponse
     */
    public function view() {
        $user = Auth::user();
        $response = $this->orderService->findByUser($user->id);
        return response()->json([
            'success' => $response['success'],
            'message' => $response['message'],
            'orders' => $response['orders']
        ]);
    }

}
