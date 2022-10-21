<?php

namespace App\Filament\Resources\Inventory;

use App\Filament\Resources\Inventory;
use App\Filament\Resources\RecipeCategoryResource\Pages;
use App\Filament\Resources\RecipeCategoryResource\RelationManagers;
use App\Models\RecipeCategory;
use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Facades\Route;

class RecipeCategoryResource extends Resource
{
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $model = RecipeCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $slug = 'recipes/categories';

    public static function getRouteBaseName(): string
    {
        return 'filament.resources.recipes.categories';
    }

    public static function getRoutes(): Closure
    {
        return function () {
            $slug = static::getSlug();

            Route::name("recipes.categories.")
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
            'index' => Inventory\RecipeCategoryResource\Pages\ManageRecipeCategories::route('/'),
        ];
    }
}
