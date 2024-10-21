<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Illuminate\Support\Number;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('New Orders', Order::query()->where('status', '=', 'new')->count()),
            Stat::make('Orders processing', Order::query()->where('status', '=', 'processing')->count()),
            Stat::make('Orders canceled', Order::query()->where('status', '=', 'canceled')->count()),
            Stat::make('Total Order Value', Number::currency(Order::query()->sum('grand_total'), 'HUF', 'HUN')),
        ];
    }
}
