<?php

namespace App\Filament\Resources\Library;

use App\Filament\Resources\Library;
use App\Filament\Resources\SalesTypeResource\Pages;
use App\Filament\Resources\SalesTypeResource\RelationManagers;
use App\Models\SalesType;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class SalesTypeResource extends Resource
{
    protected static ?string $navigationGroup = 'Library';

    protected static ?string $model = SalesType::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                                          ->required()
                                          ->unique(ignoreRecord: true),
                Forms\Components\Toggle::make('is_active')
                                       ->label('Active')
                                       ->inline(false)
                                       ->hiddenOn('create'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                                         ->searchable(),
                Tables\Columns\ToggleColumn::make('is_active')
                                           ->label('Active'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([

            ])
            ->defaultSort('order_column');
    }

    public static function getPages(): array
    {
        return [
            'index' => Library\SalesTypeResource\Pages\ManageSalesTypes::route('/'),
        ];
    }
}
