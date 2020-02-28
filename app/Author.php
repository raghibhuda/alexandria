<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['name','bio'];

    public function books () {
        return $this->belongsToMany(Book::class,'author_book');
    }
}
