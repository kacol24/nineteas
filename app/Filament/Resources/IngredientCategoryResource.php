<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IngredientCategoryResource\Pages;
use App\Filament\Resources\IngredientCategoryResource\RelationManagers;
use App\Models\IngredientCategory;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IngredientCategoryResource extends Resource
{
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $model = IngredientCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                                          ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                                         ->sortable()
                                         ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageIngredientCategories::route('/'),
        ];
    }
}
