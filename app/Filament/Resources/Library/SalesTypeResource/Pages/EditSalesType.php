<?php

namespace App\Filament\Resources\Library\SalesTypeResource\Pages;

use App\Filament\Resources\Library\SalesTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSalesType extends EditRecord
{
    protected static string $resource = SalesTypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
