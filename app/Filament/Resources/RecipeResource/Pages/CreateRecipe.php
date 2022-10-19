<?php

namespace App\Filament\Resources\RecipeResource\Pages;

use App\Filament\Resources\RecipeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class CreateRecipe extends CreateRecord
{
    protected static string $resource = RecipeResource::class;

    //protected function handleRecordCreation(array $data): Model
    //{
    //    \DB::beginTransaction();
    //    $recipe = parent::handleRecordCreation($data);
    //
    //    $sync = [];
    //    foreach($data['ingredients'] as $ingredient) {
    //        $sync[$ingredient['ingredient_id']] = [
    //            'unit_per_recipe' => $ingredient['unit_per_recipe'],
    //        ];
    //    }
    //    $recipe->ingredients()->sync($sync);
    //    \DB::commit();
    //
    //    return $recipe;
    //}
}
