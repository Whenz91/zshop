<div>
    <div class="hs-accordion-group">

        @foreach($orders as $order)
        <div class="hs-accordion" id="hs-basic-heading-two" wire:key="{{ $order->id }}">
            <button class="hs-accordion-toggle hs-accordion-active:text-blue-600 py-3 inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 hover:text-gray-500 focus:outline-none focus:text-gray-500 rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:text-neutral-400" aria-expanded="false" aria-controls="hs-basic-collapse-two">
                <svg class="hs-accordion-active:hidden block size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"></path>
                    <path d="M12 5v14"></path>
                </svg>
                <svg class="hs-accordion-active:block hidden size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"></path>
                </svg>
                <div class="flex w-full justify-between">
                    <div>
                        <p>Megrendelés száma: #{{ $order->id }}</p>
                        <p class="mt-2 text-sm text-gray-500">{{ $order->created_at }}</p>
                    </div>
                    <div>
                        @if($order->status == 'new')
                        <p class="text-sky-500">
                            Feldolgozás alatt
                        </p>
                        @endif
                        @if($order->status == 'shipped')
                        <p class="text-green-500">
                            Kiszállítva
                        </p>
                        @endif
                        <p>
                        {{  Number::currency(($order->grand_total + $order->shipping_fee + $order->payment_fee) , in: 'HUF', locale: 'hu') }}
                        </p>
                    </div>
                </div>
            </button>
            <div id="hs-basic-collapse-two" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" role="region" aria-labelledby="hs-basic-heading-two">
                @foreach($order->orderItems as $item)
                    <div class="flex w-full justify-between">
                        <p>{{ $item->name }}</p>
                        <p>Mennyiség: {{ $item->quantity }} db</p>
                        <p>{{ Number::currency(($item->total_amount + $item->tax_amount) , in: 'HUF', locale: 'hu') }}</p>
                    </div>
                @endforeach
            </div>
        </div>
        @endforeach

    </div>
</div>
