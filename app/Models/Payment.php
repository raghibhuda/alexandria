<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
