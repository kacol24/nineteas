<?php

namespace App\Filament\Resources\Library\SalesTypeResource\Pages;

use App\Filament\Resources\Library\SalesTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSalesTypes extends ListRecords
{
    protected static string $resource = SalesTypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
