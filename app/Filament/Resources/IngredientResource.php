<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IngredientResource\Pages;
use App\Filament\Resources\IngredientResource\RelationManagers;
use App\Models\Ingredient;
use App\Models\Unit;
use Doctrine\Inflector\Rules\Portuguese\Rules;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IngredientResource extends Resource
{
    protected static ?string $navigationGroup = 'Master Product';

    protected static ?int $navigationSort = 10;

    protected static ?string $model = Ingredient::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                         ->required(),
                Forms\Components\RichEditor::make('notes')
                                           ->columnSpan(3),
                Fieldset::make('Cost')
                        ->schema([
                            TextInput::make('price_per_pack')
                                     ->reactive()
                                     ->prefix('Rp')
                                     ->numeric()
                                     ->required()
                                     ->mask(function (
                                         Forms\Components\TextInput\Mask $mask
                                     ) {
                                         return $mask->numeric()
                                                     ->decimalPlaces(0)
                                                     ->decimalSeparator(',')
                                                     ->thousandsSeparator('.');
                                     })
                                     ->afterStateUpdated(function (
                                         $state,
                                         callable $set,
                                         callable $get
                                     ) {
                                         if ($get('unit_per_pack') == 0) {
                                             return $set('price_per_unit', 0);
                                         }
                                         $pricePerUnit = $state / $get('unit_per_pack');
                                         $set('price_per_unit', ceil($pricePerUnit));
                                     }),
                            TextInput::make('unit_per_pack')
                                     ->reactive()
                                     ->afterStateUpdated(function (
                                         $state,
                                         callable $set,
                                         callable $get
                                     ) {
                                         if ($state == 0) {
                                             return $set('price_per_unit', 0);
                                         }
                                         $pricePerUnit = $get('price_per_pack') / $state;
                                         $set('price_per_unit', ceil($pricePerUnit));
                                     })
                                     ->numeric()
                                     ->required(),
                            Forms\Components\Select::make('unit_id')
                                                   ->options(Unit::query()->pluck('name', 'id'))
                                                   ->searchable()
                                                   ->required(),
                            TextInput::make('price_per_unit')
                                     ->disabled(),
                        ])->columns(3),
                Fieldset::make('Inventory')
                        ->disabled(function ($state) {
                            return is_null($state['price_per_pack']) || is_null($state['unit_per_pack']);
                        })
                        ->schema([
                            TextInput::make('stock_packs')
                                     ->numeric()
                                     ->reactive()
                                     ->default(0)
                                     ->afterStateUpdated(function (
                                         $state,
                                         callable $get,
                                         callable $set
                                     ) {
                                         $stockPacks = $state ?? 0;
                                         $totalUnits = ($stockPacks * $get('unit_per_pack')) + ($get('stock_units') ?? 0);
                                         $set('total_units', $totalUnits);
                                         $valuation = number_format($totalUnits * $get('price_per_unit'), 0, ',', '.');
                                         $set('valuation', $valuation);
                                     }),
                            TextInput::make('stock_units')
                                     ->default(0)
                                     ->numeric()
                                     ->reactive()
                                     ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                         $stockPacks = $get('stock_packs') ?? 0;
                                         $totalUnits = ($stockPacks * $get('unit_per_pack')) + ($state ?? 0);
                                         $set('total_units', $totalUnits);
                                         $valuation = number_format($totalUnits * $get('price_per_unit'), 0, ',', '.');
                                         $set('valuation', $valuation);
                                     }),
                            TextInput::make('total_units')
                                     ->numeric()
                                     ->disabled(),
                            TextInput::make('valuation')
                                     ->numeric()
                                     ->disabled()
                                     ->prefix('Rp')
                                     ->mask(function (
                                         Forms\Components\TextInput\Mask $mask
                                     ) {
                                         return $mask->numeric()
                                                     ->decimalPlaces(0)
                                                     ->decimalSeparator(',')
                                                     ->thousandsSeparator('.');
                                     }),
                        ])->columns(2),
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
                Tables\Columns\TextColumn::make('stock_packs'),
                Tables\Columns\TextColumn::make('stock_units_with_unit'),
                Tables\Columns\TextColumn::make('total_units_with_unit'),
                Tables\Columns\TextColumn::make('formatted_valuation')
                                         ->sortable()
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
