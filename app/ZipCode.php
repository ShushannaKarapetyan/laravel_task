<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZipCode extends Model
{
    protected $fillable = [
        'zip',
        'town',
        'category',
        'district',
        'country',
        'court_name',
        'court_address',
        'court_zip',
        'court_town',
    ];
}
