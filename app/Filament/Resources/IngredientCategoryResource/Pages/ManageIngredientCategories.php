<?php

namespace App\Filament\Resources\IngredientCategoryResource\Pages;

use App\Filament\Resources\IngredientCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageIngredientCategories extends ManageRecords
{
    protected static string $resource = IngredientCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
