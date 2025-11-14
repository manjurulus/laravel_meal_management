<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationships
    public function meals()
    {
        return $this->hasMany(Meal::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function bills()
    {
        return $this->belongsToMany(Bill::class, 'user_bills')
                    ->withPivot('paid_amount', 'payment_date')
                    ->withTimestamps();
    }
    public function userBills()
    {
        return $this->hasMany(UserBill::class);
    }
}
