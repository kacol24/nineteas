<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipe extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];

    protected $appends = [
        'cogs',
        'formatted_cogs',
    ];

    public function ingredients()
    {
        return $this->hasMany(RecipeIngredient::class);
    }

    public function getCogsAttribute()
    {
        $cogs = 0;
        foreach ($this->ingredients as $ingredient) {
            $cogs += $ingredient->unit_per_recipe * $ingredient->ingredient->price_per_unit;
        }

        return $cogs;
    }

    public function getFormattedCogsAttribute()
    {
        return number_format($this->cogs, 0, ',', '.');
    }
}
