<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrderHistoryPage extends Component
{
    public function render()
    {
        return view('livewire.order-history-page', [
            'orders' => Order::where('user_id', auth()->user()->id)->with('orderItems')->get()
        ]);
    }
}
