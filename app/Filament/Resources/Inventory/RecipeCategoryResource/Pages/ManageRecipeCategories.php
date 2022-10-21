<?php

namespace App\Filament\Resources\Inventory\RecipeCategoryResource\Pages;

use App\Filament\Resources\Inventory\RecipeCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageRecipeCategories extends ManageRecords
{
    protected static string $resource = RecipeCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
