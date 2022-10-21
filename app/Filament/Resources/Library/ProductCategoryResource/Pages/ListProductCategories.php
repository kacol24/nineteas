<?php

namespace App\Filament\Resources\Library\ProductCategoryResource\Pages;

use App\Filament\Resources\Library\ProductCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductCategories extends ListRecords
{
    protected static string $resource = ProductCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }

    protected function getTableReorderColumn(): ?string
    {
        return 'order_column';
    }
}
