<?php

namespace App\Filament\Resources\Library;

use App\Filament\Resources\Library\ProductCategoryResource\Pages;
use App\Filament\Resources\Library\ProductCategoryResource\RelationManagers;
use App\Models\ProductCategory;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ProductCategoryResource extends Resource
{
    protected static ?string $navigationGroup = 'Library';

    protected static ?string $modelLabel = 'Category';

    protected static ?string $pluralModelLabel = 'Categories';

    protected static ?string $model = ProductCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                         ->required()
                         ->unique(ignoreRecord: true),
                Toggle::make('is_shown')
                      ->label('Shown')
                      ->hiddenOn('create')
                      ->inline(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                                         ->searchable(),
                Tables\Columns\ToggleColumn::make('is_shown')
                                           ->label('Shown'),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index'  => Pages\ListProductCategories::route('/'),
            'create' => Pages\CreateProductCategory::route('/create'),
            'edit'   => Pages\EditProductCategory::route('/{record}/edit'),
        ];
    }
}
