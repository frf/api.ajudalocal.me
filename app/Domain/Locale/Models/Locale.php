<?php

namespace Domain\Locale\Models;

use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REGISTRED = 'registred';
    public const STATUS_WAITING_APPROVED = 'waiting_approved';
    public const STATUS_DENIED = 'denied';
    public const STATUS_PUBLISHED = 'published';

    protected $fillable = [
        'name',
        'about',
        'type',
        'instructions',
        'status',
        'longitude',
        'latitude',
        'address',
        'name_user',
        'phone_user',
        'data',
    ];

    protected $casts = [
        'data' => 'array',
    ];
}
