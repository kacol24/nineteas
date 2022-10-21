<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesType extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'is_active',
        'order_column',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
