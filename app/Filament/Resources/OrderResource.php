<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\PaymenthMethod;
use App\Models\ShippingMethod;
use Illuminate\Support\Number;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Placeholder;
use App\Filament\Resources\OrderResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\OrderResource\RelationManagers;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('customer_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('customer_email')
                    ->required()
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('customer_phone')
                    ->required()
                    ->numeric()
                    ->maxLength(255),
                Forms\Components\Fieldset::make('Billing Address Information')
                    ->schema([
                        Forms\Components\TextInput::make('billing_country')
                            ->required()
                            ->maxLength(255)
                            ->default('Magyarország'),
                        Forms\Components\Select::make('billing_county')
                            ->required()
                            ->options([
                                'bacs' => 'Bács-Kiskun',
                                'baranya' => 'Baranya',
                                'bekes' => 'Békés',
                                'borsod' => 'Borsod-Abaúj-Zemplén',
                                'csongrad' => 'Csongrád-Csanád',
                                'fejer' => 'Fejér',
                                'gyor' => 'Győr-Moson-Sopron',
                                'hajdu' => 'Hajdú-Bihar',
                                'heves' => 'Heves',
                                'jasz' => 'Jász-Nagykun-Szolnok',
                                'komarom' => 'Komárom-Esztergom',
                                'nograd' => 'Nógrád',
                                'pest' => 'Pest',
                                'somogy' => 'Somogy',
                                'szabolcs' => 'Szabolcs-Szatmár-Bereg',
                                'tolna' => 'Tolna',
                                'vas' => 'Vas',
                                'veszprem' => 'Veszprém',
                                'zala' => 'Zala'
                            ]),
                        Forms\Components\TextInput::make('billing_zipcode')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('billing_city')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('billing_street')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2),
                    ]),
                Forms\Components\Fieldset::make('Shipping Address Information')
                    ->schema([
                        Forms\Components\TextInput::make('shipping_country')
                            ->maxLength(255)
                            ->default('Magyarország'),
                        Forms\Components\Select::make('shipping_county')
                            ->options([
                                'bacs' => 'Bács-Kiskun',
                                'baranya' => 'Baranya',
                                'bekes' => 'Békés',
                                'borsod' => 'Borsod-Abaúj-Zemplén',
                                'csongrad' => 'Csongrád-Csanád',
                                'fejer' => 'Fejér',
                                'gyor' => 'Győr-Moson-Sopron',
                                'hajdu' => 'Hajdú-Bihar',
                                'heves' => 'Heves',
                                'jasz' => 'Jász-Nagykun-Szolnok',
                                'komarom' => 'Komárom-Esztergom',
                                'nograd' => 'Nógrád',
                                'pest' => 'Pest',
                                'somogy' => 'Somogy',
                                'szabolcs' => 'Szabolcs-Szatmár-Bereg',
                                'tolna' => 'Tolna',
                                'vas' => 'Vas',
                                'veszprem' => 'Veszprém',
                                'zala' => 'Zala'
                            ]),
                        Forms\Components\TextInput::make('shipping_zipcode')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('shipping_city')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('shipping_street')
                            ->maxLength(255)
                            ->columnSpan(2),
                    ]),
                    Forms\Components\Select::make('payment_method')
                        ->options(PaymenthMethod::all()->pluck('payment_type', 'id')),
                    Forms\Components\Select::make('shipping_method')
                        ->options(ShippingMethod::all()->pluck('shipping_type', 'id')),
                    Forms\Components\Section::make('Cart')
                        ->schema([
                            Forms\Components\Repeater::make('orderItems')
                                ->relationship()
                                ->schema([
                                    Forms\Components\Select::make('product_id')
                                        ->relationship('product', 'name')
                                        ->searchable()
                                        ->preload()
                                        ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                        ->distinct()
                                        ->required()
                                        ->columnSpan(4)
                                        ->reactive()
                                        ->afterStateUpdated(fn($state, Set $set) => $set('unit_amount', Product::find($state)?->price ?? 0))
                                        ->afterStateUpdated(fn($state, Set $set) => $set('total_amount', Product::find($state)?->price ?? 0)),
                                    Forms\Components\TextInput::make('quantity')
                                        ->required()
                                        ->numeric()
                                        ->default(1)
                                        ->minValue(1)
                                        ->columnSpan(2)
                                        ->reactive()
                                        ->afterStateUpdated(fn($state, Set $set, Get $get) => $set('total_amount', $state * $get('unit_amount'))),
                                    Forms\Components\TextInput::make('unit_amount')
                                        ->required()
                                        ->numeric()
                                        ->disabled()
                                        ->dehydrated()
                                        ->columnSpan(2),
                                    Forms\Components\TextInput::make('total_amount')
                                        ->required()
                                        ->numeric()
                                        ->disabled()
                                        ->dehydrated()
                                        ->columnSpan(2)
                                ])->columns(12),
                                Forms\Components\Placeholder::make('grand_total_placeholder')
                                    ->label('Grand Total')
                                    ->content(function(Get $get, Set $set) {
                                        $total = 0;
                                        if(!$repeaters = $get('orderItems')) {
                                            return Number::currency($total, 'HUF');
                                        }

                                        foreach($repeaters as $key => $repeater) {
                                            $total += $get("orderItems.{$key}.total_amount");
                                        }

                                        $set('grand_total', $total);
                                        return Number::currency($total, 'HUF');
                                    }),
                                Forms\Components\Hidden::make('grand_total')
                                    ->default(0)
                            ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
