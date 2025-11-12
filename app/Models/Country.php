<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name',
        'continent_name',
        'date_and_time_foundation',
        'status'
    ];
}
