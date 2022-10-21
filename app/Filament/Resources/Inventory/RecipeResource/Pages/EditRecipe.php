<?php

namespace App\Filament\Resources\Inventory\RecipeResource\Pages;

use App\Filament\Resources\Inventory\RecipeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRecipe extends EditRecord
{
    protected static string $resource = RecipeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
