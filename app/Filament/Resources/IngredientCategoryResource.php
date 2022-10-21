<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IngredientCategoryResource\Pages;
use App\Filament\Resources\IngredientCategoryResource\RelationManagers;
use App\Models\IngredientCategory;
use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Route;

class IngredientCategoryResource extends Resource
{
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $model = IngredientCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $slug = 'ingredients/categories';

    public static function getRouteBaseName(): string
    {
        return 'filament.resources.ingredients.categories';
    }

    public static function getRoutes(): Closure
    {
        return function () {
            $slug = static::getSlug();

            Route::name("ingredients.categories.")
                 ->prefix($slug)
                 ->middleware(static::getMiddlewares())
                 ->group(function () {
                     foreach (static::getPages() as $name => $page) {
                         Route::get($page['route'], $page['class'])->name($name);
                     }
                 });
        };
    }

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
