<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookInfo extends Model
{
    protected $fillable = [
        'book_id',
        'price',
        'language',
        'published_on',
        'total_pages',
        'isbn_number',
        'price',
        'characters',
        'series_name',
        'description'
    ];

}
