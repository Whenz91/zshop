<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['billing_address'] = json_encode([
            'billing_country' => $data['billing_country'],
            'billing_county' => $data['billing_county'],
            'billing_zipcode' => $data['billing_zipcode'],
            'billing_city' => $data['billing_city'],
            'billing_street' => $data['billing_street'],
        ]);
    
        return $data;
    }

    protected function handleRecordCreation(array $data): Order
    {
        return Order::create($data);
    }
}
