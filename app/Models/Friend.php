<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;

    // protected $gaurded = [];
    protected $fillable = [
        'user_id',
        'friend_id',
        'accepted',
        'created_at',
        'updated_at'
    ];

    
}
