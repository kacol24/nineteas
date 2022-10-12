<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredient extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'unit_id',
        'name',
        'notes',
        'price_per_pack',
        'unit_per_pack',
    ];

    protected $appends = [
        'price_per_unit',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function getPricePerUnitAttribute()
    {
        return $this->price_per_pack / $this->unit_per_pack;
    }

    public function getFormattedPricePerUnitAttribute()
    {
        return $this->price_per_unit.' / '.$this->unit->name;
    }

    public function getFormattedUnitPerPackAttribute()
    {
        return $this->unit_per_pack.' '.$this->unit->name;
    }
}
