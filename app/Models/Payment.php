<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    //
    protected $fillable = ['user_id','payment_method_id','amount','status'];

    /**
     * @return BelongsTo
     */
    public function user () {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function order () {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return HasOne
     */
    public function paymentMethod () {
        return $this->hasOne(PaymentMethod::class);
    }
}
