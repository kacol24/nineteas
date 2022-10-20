<?php

namespace App\Filament\Resources\RecipeResource\Pages;

use App\Filament\Resources\RecipeResource;
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
                          ->url(route('filament.resources.recipe-categories.index')),
            Actions\CreateAction::make(),
        ];
    }
}
