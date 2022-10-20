<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecipeResource\Pages;
use App\Filament\Resources\RecipeResource\RelationManagers;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\RecipeCategory;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Stack;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RecipeResource extends Resource
{
    protected static ?string $navigationGroup = 'Master Product';

    protected static ?int $navigationSort = 5;

    protected static ?string $model = Recipe::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                                          ->required(),
                Select::make('recipe_category_id')
                      ->label('Category')
                      ->options(RecipeCategory::query()->pluck('name', 'id'))
                      ->searchable(),
                Forms\Components\TextInput::make('formatted_cogs')
                                          ->label('Total COGS')
                                          ->prefix('Rp')
                                          ->disabled(),
                Repeater::make('ingredients')
                        ->relationship()
                        ->disableItemMovement()
                        ->columns(4)
                        ->columnSpan('full')
                        ->defaultItems(1)
                        ->collapsible()
                        ->itemLabel(function ($state) {
                            $ingredient = Ingredient::find($state['ingredient_id']);

                            $ingredientName = $ingredient->name ?? null;
                            $unit = optional(optional($ingredient)->unit)->name;
                            $unitPerRecipe = $state['unit_per_recipe'];
                            $formattedCogs = $state['formatted_cogs'];

                            if ($formattedCogs) {
                                $titleTemplate = '{ingredient_name} ({unit_per_recipe} {unit}): Rp{formatted_cogs}';

                                return str_replace(
                                    [
                                        '{ingredient_name}',
                                        '{unit_per_recipe}',
                                        '{unit}',
                                        '{formatted_cogs}',
                                    ],
                                    [
                                        $ingredientName,
                                        $unitPerRecipe,
                                        $unit,
                                        $formattedCogs,
                                    ],
                                    $titleTemplate
                                );
                            }

                            return $ingredient->name ?? null;
                        })
                        ->schema([
                            Select::make('ingredient_id')
                                  ->label('Ingredient')
                                  ->options(Ingredient::query()->pluck('name', 'id'))
                                  ->required()
                                  ->reactive()
                                  ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                      $ingredient = Ingredient::find($state);

                                      if ($ingredient) {
                                          $pricePerUnit = $ingredient->price_per_unit;
                                          $unitPerRecipe = $get('unit_per_recipe');

                                          $cogs = $pricePerUnit * $unitPerRecipe;

                                          $set('price_per_unit', $pricePerUnit);
                                          $set('formatted_cogs', number_format($cogs, 0, ',', '.'));
                                      }
                                  })
                                  ->searchable(),
                            Forms\Components\TextInput::make('unit_per_recipe')
                                                      ->default(1)
                                                      ->required()
                                                      ->suffix(function (callable $get) {
                                                          $ingredientId = $get('ingredient_id');
                                                          $ingredient = Ingredient::find($ingredientId);

                                                          if ($ingredient) {
                                                              return $ingredient->unit->name;
                                                          }

                                                          return '';
                                                      })
                                                      ->afterStateUpdated(function (
                                                          $state,
                                                          callable $set,
                                                          callable $get
                                                      ) {
                                                          $pricePerUnit = $get('price_per_unit');
                                                          $unitPerRecipe = $state;

                                                          $cogs = $pricePerUnit * $unitPerRecipe;

                                                          $set('price_per_unit', $pricePerUnit);
                                                          $set('formatted_cogs', number_format($cogs, 0, ',', '.'));
                                                      })
                                                      ->reactive()
                                                      ->numeric(),
                            Forms\Components\TextInput::make('price_per_unit')
                                                      ->disabled(),
                            Forms\Components\TextInput::make('formatted_cogs')
                                                      ->label('COGS')
                                                      ->prefix('Rp')
                                                      ->reactive()
                                                      ->disabled(),
                        ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Split::make([
                    Tables\Columns\TextColumn::make('name')
                                             ->sortable()
                                             ->searchable(),
                    Tables\Columns\TextColumn::make('ingredients_count')
                                             ->counts('ingredients')
                                             ->suffix(' ingredients'),
                    Tables\Columns\TextColumn::make('cogs')
                                             ->label('COGS')
                                             ->formatStateUsing(function ($state) {
                                                 return number_format($state, 0, ',', '.');
                                             })
                                             ->prefix('Rp'),
                ]),
                Tables\Columns\Layout\View::make('recipes.table.collapsible-row-content')
                                          ->collapsible(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([

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
            'index'  => Pages\ListRecipes::route('/'),
            'create' => Pages\CreateRecipe::route('/create'),
            'edit'   => Pages\EditRecipe::route('/{record}/edit'),
        ];
    }
}
