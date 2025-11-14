<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Meal extends Model
{
    protected $fillable = [
        'user_id',
        'date',
        'quantity',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
