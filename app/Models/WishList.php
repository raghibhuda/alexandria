<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WishList extends Model
{
    protected $fillable = ['user_id','book_id'];

    /**
     * @return BelongsTo
     */
    public function user () {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function books () {
        return $this->hasMany(Book::class);
    }
}
