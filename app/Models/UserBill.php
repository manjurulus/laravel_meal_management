<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Bill;

class UserBill extends Model
{
    protected $fillable = [
        'user_id',
        'bill_id',
        'paid_amount',
        'payment_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }
}
