<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    protected $fillable = ['name'];

    public function shipping () {
        return $this->belongsTo(Shipping::class);
    }
}
