<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = [
        'name',
        'date_and_time_foundation',
        'country_id',
        'status'
    ];

    public function country () {
        return $this->belongsTo(Country::class);
    }
}
