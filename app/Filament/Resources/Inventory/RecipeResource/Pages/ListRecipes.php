<?php

namespace App\Filament\Resources\Inventory\RecipeResource\Pages;

use App\Filament\Resources\Inventory\RecipeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRecipes extends ListRecords
{
    protected static string $resource = RecipeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\Action::make('manage_categories')
                          ->label('Manage Categories')
                          ->color('secondary')
                          ->url(route('filament.resources.recipes.categories.index')),
            Actions\CreateAction::make(),
        ];
    }
}
