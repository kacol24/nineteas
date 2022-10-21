<?php

namespace App\Filament\Resources\Inventory\IngredientCategoryResource\Pages;

use App\Filament\Resources\Inventory\IngredientCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIngredientCategory extends EditRecord
{
    protected static string $resource = IngredientCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
