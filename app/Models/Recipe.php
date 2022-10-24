<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipe extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'recipe_category_id',
        'target_price',
    ];

    protected $appends = [
        'cogs',
        'formatted_cogs',
    ];

    public function category()
    {
        return $this->belongsTo(RecipeCategory::class, 'recipe_category_id');
    }

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

    public function getMarginAttribute()
    {
        return $this->target_price - $this->cogs;
    }

    public function getFormattedMarginAttribute()
    {
        return number_format($this->margin, 0, ',', '.');
    }

    public function getMarginPercentAttribute()
    {
        if (!$this->target_price) {
            return 0;
        }

        return $this->margin / $this->target_price * 100;
    }
}
