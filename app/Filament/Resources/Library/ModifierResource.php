<?php

namespace App\Filament\Resources\Library;

use App\Filament\Resources\Library\ModifierResource\Pages;
use App\Filament\Resources\Library\ModifierResource\RelationManagers;
use App\Models\Modifier;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ModifierResource extends Resource
{
    protected static ?string $navigationGroup = 'Library';

    protected static ?string $model = Modifier::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                                          ->required(),
                Forms\Components\TagsInput::make('options')
                                          ->required()
                                          ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('options_to_string')
                                         ->label('Options'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([

            ])
            ->defaultSort('order_column');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListModifiers::route('/'),
            'create' => Pages\CreateModifier::route('/create'),
            'edit'   => Pages\EditModifier::route('/{record}/edit'),
        ];
    }
}
