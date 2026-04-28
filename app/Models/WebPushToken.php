<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebPushToken extends Model
{
    use HasFactory;
    protected $fillable = [
        'nis',
        'endpoint',
        'p256dh',
        'auth'
    ];
}
