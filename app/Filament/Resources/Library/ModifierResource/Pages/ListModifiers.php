<?php

namespace App\Filament\Resources\Library\ModifierResource\Pages;

use App\Filament\Resources\Library\ModifierResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListModifiers extends ListRecords
{
    protected static string $resource = ModifierResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableReorderColumn(): ?string
    {
        return 'order_column';
    }
}
