<?php

namespace App\Filament\Resources\Library\ModifierResource\Pages;

use App\Filament\Resources\Library\ModifierResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditModifier extends EditRecord
{
    protected static string $resource = ModifierResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
