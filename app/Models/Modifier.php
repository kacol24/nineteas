<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modifier extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'order_column',
        'options',
    ];

    protected $casts = [
        'options' => 'array',
    ];

    public function getOptionsCountAttribute()
    {
        return count($this->options);
    }

    public function getOptionsToStringAttribute()
    {
        return implode(', ', $this->options);
    }
}
