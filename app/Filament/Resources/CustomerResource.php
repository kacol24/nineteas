<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                                     ->schema([
                                         Forms\Components\Toggle::make('is_active')
                                                                ->label('Active')
                                                                ->disabled()
                                                                ->inline(false)
                                                                ->default(true),
                                         TextInput::make('member_id')
                                                  ->label('Member ID')
                                                  ->disabled()
                                                  ->mask(function (Mask $mask) {
                                                      return $mask->pattern('0000-0000-0000-0000');
                                                  })
                                                  ->hiddenOn('create'),
                                     ]),
                TextInput::make('name')
                         ->required(),
                TextInput::make('email')
                         ->required()
                         ->email(),
                TextInput::make('password')
                         ->required()
                         ->password()
                         ->confirmed(),
                TextInput::make('password_confirmation')
                         ->required()
                         ->password(),
                TextInput::make('phone')
                         ->tel(),
                Forms\Components\DatePicker::make('date_of_birth')
                                           ->displayFormat('d/m/Y'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('is_active')
                                         ->label('Active')
                                         ->boolean(),
                Tables\Columns\TextColumn::make('member_id')
                                         ->label('Member ID')
                                         ->formatStateUsing(function ($state) {
                                             return implode('-', str_split($state, 4));
                                         })
                                         ->sortable()
                                         ->searchable(),
                Tables\Columns\TextColumn::make('name')
                                         ->sortable()
                                         ->searchable(),
                Tables\Columns\TextColumn::make('email')
                                         ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                                         ->searchable(),
                Tables\Columns\TextColumn::make('date_of_birth')
                                         ->sortable()
                                         ->toggleable()
                                         ->date('d/m/Y'),
                Tables\Columns\TextColumn::make('balance')
                                         ->label('Tea Leaves')
                                         ->formatStateUsing(function ($state) {
                                             return number_format($state, 0, ',', '.');
                                         })
                                         ->toggleable(),
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
            'index'  => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit'   => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
