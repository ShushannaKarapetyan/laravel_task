<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'cover_image',
        'release_date',
        'release_date_country',
        'rating',
        'category',
    ];
}
