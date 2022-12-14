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
        'stock_packs',
        'stock_units',
        'ingredient_category_id',
    ];

    protected $appends = [
        'price_per_unit',
        'total_units',
        'valuation',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class);
    }

    public function category()
    {
        return $this->belongsTo(IngredientCategory::class, 'ingredient_category_id');
    }

    public function getPricePerUnitAttribute()
    {
        return ceil($this->price_per_pack / $this->unit_per_pack);
    }

    public function getFormattedPricePerUnitAttribute()
    {
        return $this->price_per_unit.' / '.$this->unit->name;
    }

    public function getFormattedUnitPerPackAttribute()
    {
        return $this->unit_per_pack.' '.$this->unit->name;
    }

    public function getTotalUnitsAttribute()
    {
        return ($this->stock_packs * $this->unit_per_pack) + $this->stock_units;
    }

    public function getValuationAttribute()
    {
        return $this->total_units * $this->price_per_unit;
    }

    public function getFormattedValuationAttribute()
    {
        return number_format($this->valuation, 0, ',', '.');
    }

    public function getStockUnitsWithUnitAttribute()
    {
        return $this->stock_units.' '.$this->unit->name;
    }

    public function getTotalUnitsWithUnitAttribute()
    {
        return $this->total_units.' '.$this->unit->name;
    }

    public function getFormattedPricePerPackAttribute()
    {
        return number_format($this->price_per_pack, 0, ',', '.');
    }
}
