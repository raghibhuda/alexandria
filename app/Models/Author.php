<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{
    protected $fillable = ['name','bio'];

    /**
     * @return BelongsToMany
     */
    public function books () {
        return $this->belongsToMany(Book::class,'author_book');
    }

}
