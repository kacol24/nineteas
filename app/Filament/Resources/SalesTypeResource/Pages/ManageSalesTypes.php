<?php

namespace App\Filament\Resources\SalesTypeResource\Pages;

use App\Filament\Resources\SalesTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSalesTypes extends ManageRecords
{
    protected static string $resource = SalesTypeResource::class;

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

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}
