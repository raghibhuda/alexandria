<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Book extends Model
{
    protected $fillable = ['name','author_id','publication_id','category_id',];

    /**
     * @return BelongsToMany
     */
    public function authors () {
        return $this->belongsToMany(Author::class,'author_book');
    }

    /**
     * @return BelongsTo
     */
    public function category () {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return HasOne
     */
    public function bookInfo () {
        return $this->hasOne(BookInfo::class);
    }

    /**
     * @return BelongsTo
     */
    public function publication () {
        return $this->belongsTo(Publication::class);
    }

    /**
     * @return BelongsTo
     */
    public function order () {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return BelongsTo
     */
    public function cart () {
        return $this->belongsTo(Cart::class);
    }

    /**
     * @return BelongsTo
     */
    public function wishList () {
        return $this->belongsTo(WishList::class);
    }
}
