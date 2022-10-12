<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IngredientResource\Pages;
use App\Filament\Resources\IngredientResource\RelationManagers;
use App\Models\Ingredient;
use Doctrine\Inflector\Rules\Portuguese\Rules;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IngredientResource extends Resource
{
    protected static ?string $navigationGroup = 'Master Product';

    protected static ?string $model = Ingredient::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                                          ->required(),
                Forms\Components\RichEditor::make('notes')
                                           ->columnSpan(3),
                Forms\Components\TextInput::make('price_per_pack')
                                          ->prefix('Rp')
                                          ->numeric()
                                          ->required()
                                          ->mask(function (Forms\Components\TextInput\Mask $mask) {
                                              return $mask->numeric()
                                                          ->decimalPlaces(0)
                                                          ->decimalSeparator(',')
                                                          ->thousandsSeparator('.');
                                          }),
                Forms\Components\TextInput::make('unit_per_pack')
                                          ->numeric()
                                          ->required(),
                Forms\Components\Select::make('unit_id')
                                       ->relationship('unit', 'name')
                                       ->searchable()
                                       ->required(),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                                         ->searchable()
                                         ->sortable(),
                Tables\Columns\TextColumn::make('price_per_pack')
                                         ->prefix('Rp')
                                         ->formatStateUsing(function (string $state) {
                                             return number_format($state, 0, ',', '.');
                                         })
                                         ->sortable(),
                Tables\Columns\TextColumn::make('formatted_unit_per_pack')
                                         ->label('Nett Per Pack'),
                Tables\Columns\TextColumn::make('formatted_price_per_unit')
                                         ->label('Price Per Unit')
                                         ->prefix('Rp'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
            'index'  => Pages\ListIngredients::route('/'),
            'create' => Pages\CreateIngredient::route('/create'),
            'edit'   => Pages\EditIngredient::route('/{record}/edit'),
        ];
    }
}
