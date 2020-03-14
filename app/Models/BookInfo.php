<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookInfo extends Model
{
    protected $fillable = [
        'book_id',
        'price',
        'quantity',
        'in_stock',
        'language',
        'published_on',
        'total_pages',
        'isbn_number',
        'characters',
        'series_name',
        'description'
    ];

    public function book () {
        return $this->belongsTo(Book::class);
    }
}
