<?php

namespace App\Filament\Resources\Inventory\RecipeResource\Pages;

use App\Filament\Resources\Inventory\RecipeResource;
use Filament\Resources\Pages\CreateRecord;

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
