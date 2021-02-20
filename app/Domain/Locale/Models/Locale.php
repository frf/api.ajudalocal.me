<?php

namespace Domain\Locale\Models;

use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
    protected $fillable = [
        'name',
        'instructions',
        'status',
    ];
}
