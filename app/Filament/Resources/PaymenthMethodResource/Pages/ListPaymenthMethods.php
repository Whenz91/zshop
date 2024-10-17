<?php

namespace App\Filament\Resources\PaymenthMethodResource\Pages;

use App\Filament\Resources\PaymenthMethodResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPaymenthMethods extends ListRecords
{
    protected static string $resource = PaymenthMethodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
