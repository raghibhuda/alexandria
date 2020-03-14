<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentMethod extends Model
{
    protected $fillable = ['name'];

    /**
     * @return BelongsTo
     */
    public function payment () {
        return $this->belongsTo(Payment::class);
    }
}
