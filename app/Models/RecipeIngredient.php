<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeIngredient extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'recipe_id',
        'ingredient_id',
        'unit_per_recipe',
    ];

    protected $appends = [
        'price_per_unit',
        'cogs',
        'formatted_cogs',
    ];

    public function getPricePerUnitAttribute()
    {
        return $this->ingredient->price_per_unit;
    }

    public function getCogsAttribute()
    {
        return $this->price_per_unit * $this->unit_per_recipe;
    }

    public function getFormattedCogsAttribute()
    {
        return number_format($this->cogs, 0, ',', '.');
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}
