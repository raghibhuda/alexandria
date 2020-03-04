<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $fillable = ['name'];

    public function books () {
        return $this->hasMany(Book::class);
    }
}
