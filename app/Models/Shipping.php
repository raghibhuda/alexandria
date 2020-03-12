<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shipping extends Model
{
    protected $fillable = ['user_id','status','address','shipped_on','shipping_method_id'];

    /**
     * @return BelongsTo
     */
    public function order () {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return BelongsTo
     */
    public function user () {
        return $this->belongsTo(User::class);
    }

    public function shippingMethod () {
        return $this->hasOne(ShippingMethod::class);
    }

}
