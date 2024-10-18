<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['billing_country'] = $data['billing_address']['billing_country'];
        $data['billing_county'] = $data['billing_address']['billing_county'];
        $data['billing_zipcode'] = $data['billing_address']['billing_zipcode'];
        $data['billing_city'] = $data['billing_address']['billing_city'];
        $data['billing_street'] = $data['billing_address']['billing_street'];
    
        return $data;
    }
}
