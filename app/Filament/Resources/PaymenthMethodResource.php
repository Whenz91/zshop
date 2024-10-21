<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymenthMethodResource\Pages;
use App\Filament\Resources\PaymenthMethodResource\RelationManagers;
use App\Models\PaymenthMethod;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymenthMethodResource extends Resource
{
    protected static ?string $model = PaymenthMethod::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('payment_type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('cost')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->prefix('Ft'),
                Forms\Components\TextInput::make('provider')
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_active')
                    ->default(true)
                    ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('payment_type'),
                Tables\Columns\TextColumn::make('cost')
                    ->money('HUF', locale: 'hu'),
                Tables\Columns\TextColumn::make('provider'),
                Tables\Columns\IconColumn::make('is_active')
                    ->icon(fn (string $state): string => match ($state) {
                        '1' => 'heroicon-o-check-circle',
                        '0' => 'heroicon-o-x-circle'
                    })
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListPaymenthMethods::route('/'),
            'create' => Pages\CreatePaymenthMethod::route('/create'),
            'edit' => Pages\EditPaymenthMethod::route('/{record}/edit'),
        ];
    }
}
