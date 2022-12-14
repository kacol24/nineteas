<?php

namespace App\Filament\Resources\Inventory\IngredientCategoryResource\Pages;

use App\Filament\Resources\Inventory\IngredientCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIngredientCategories extends ListRecords
{
    protected static string $resource = IngredientCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
