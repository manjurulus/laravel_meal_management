<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = [
        'title',
        'amount',
        'due_date'
    ];

    // app/Models/Bill.php

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_bills')
                    ->withPivot('paid_amount', 'payment_date')
                    ->withTimestamps();
    }

    public function userBills()
    {
        return $this->hasMany(UserBill::class);
    }
}
