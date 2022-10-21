<?php

namespace App\Filament\Resources\Inventory\IngredientResource\Pages;

use App\Filament\Resources\Inventory\IngredientResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIngredients extends ListRecords
{
    protected static string $resource = IngredientResource::class;

    protected function getActions(): array
    {
        return [
            Actions\Action::make('manage_categories')
                          ->label('Manage Categories')
                          ->color('secondary')
                          ->url(route('filament.resources.ingredients.categories.index')),
            Actions\CreateAction::make(),
        ];
    }
}
