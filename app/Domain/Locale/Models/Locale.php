<?php

namespace Domain\Locale\Models;

use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
    protected $fillable = [
        'name',
        'about',
        'type',
        'instructions',
        'status',
        'longitude',
        'latitude',
    ];
}
