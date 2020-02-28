<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['name','author_id','publication_id','category_id',];

    public function authors () {
        return $this->belongsToMany(Author::class,'author_book');
    }

    public function category () {
        return $this->belongsTo(Category::class);
    }

    public function bookInfo () {
        return $this->hasOne(BookInfo::class);
    }

    public function publication () {
        return $this->belongsTo(Publication::class);
    }

}
