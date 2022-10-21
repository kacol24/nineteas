<?php

namespace App\Filament\Resources\Inventory\UnitResource\Pages;

use App\Filament\Resources\Inventory\UnitResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUnit extends EditRecord
{
    protected static string $resource = UnitResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
