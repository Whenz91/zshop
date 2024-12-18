<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ProductResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProductResource\RelationManagers;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Shop';
    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'categories.title'];
    }

    /*
    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Category' => $record->category->title,
        ];
    }
    */

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->label('SEO URL')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('Ft'),
                Forms\Components\TextInput::make('tax')
                    ->required()
                    ->default(0.27),
                Forms\Components\TextInput::make('quantity')
                    ->numeric()
                    ->default(1),
                Forms\Components\FileUpload::make('images')
                    ->directory('products')
                    ->multiple()
                    ->reorderable()
                    ->columnSpan(2),
                Forms\Components\RichEditor::make('description')
                    ->columnSpan(2),
                Forms\Components\Select::make('category_id')
                    ->relationship('categories', 'title')
                    ->multiple()
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                            ->label('SEO URL')
                            ->required()
                            ->maxLength(255)
                    ])
                    ->required(),
                Forms\Components\Select::make('filter_option_id')
                    ->relationship('filters', 'name')
                    ->multiple()
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Toggle::make('is_active')
                    ->default(true)
                    ->columnSpan(2),
                Forms\Components\Toggle::make('is_featured')
                    ->columnSpan(2),
                Forms\Components\Toggle::make('is_new')
                    ->columnSpan(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->sortable()
                    ->money('HUF', locale: 'hu'),
                Tables\Columns\TextColumn::make('quantity')
                    ->sortable(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
