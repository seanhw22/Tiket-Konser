<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'checked',
        'pinned',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    protected $table = 'suggestion';
}
