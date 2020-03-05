<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    protected $fillable = ['user_id','book_id','payment_id','shipping_id','total_amount','vat','tax','quantity'];

    /**
     * @return BelongsTo
     */
    public function user () {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasOne
     */
    public function shipping () {
        return $this->hasOne(Shipping::class);
    }

    /**
     * @return HasOne
     */
    public function payment () {
        return $this->hasOne(Payment::class);
    }

    /**
     * @return HasMany
     */
    public function books () {
        return $this->hasMany(Book::class);
    }

}
