<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'amount',
    ];

    protected $attributes = [
        'id'          => 123,
        'customer_id' => 1,
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
