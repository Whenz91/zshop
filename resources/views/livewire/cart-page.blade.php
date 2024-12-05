<div>
    <h1 class="text-4xl dark:text-white mb-2">Kosár</h1>

    @if(!empty($cart_items))
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-white rounded py-3 col-span-2 flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                    <thead>
                        <tr>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Termék</th>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Mennyiség</th>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Egység ár</th>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">ÁFA</th>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Ár összesen</th>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart_items as $item)
                        <tr class="odd:bg-white even:bg-gray-100 dark:odd:bg-neutral-900 dark:even:bg-neutral-800" wire:key="{{ $item['product_id'] }}">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                <div class="flex gap-4 items-center">
                                    <img class="w-56 h-auto" src="{{ url('storage', $item['image']) }}" alt="{{ $item['name'] }}">
                                    <h3 class="text-2xl dark:text-white">{{ $item['name'] }}</h3>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                <!-- Input Number -->
                                <div class="py-2 px-3 inline-block bg-white border border-gray-200 rounded-lg dark:bg-neutral-900 dark:border-neutral-700" data-hs-input-number="">
                                    <div class="flex items-center gap-x-1.5">
                                        <button wire:click="decreaseQty({{ $item['product_id'] }})" type="button" class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" tabindex="-1" aria-label="Decrease">
                                            <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5 12h14"></path>
                                        </svg>
                                        </button>
                                        <input class="p-0 w-6 bg-transparent border-0 text-gray-800 text-center focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none dark:text-white" style="-moz-appearance: textfield;" type="number" aria-roledescription="Number field" value="{{ $item['quantity'] }}">
                                        <button wire:click="increaseQty({{ $item['product_id'] }})" type="button" class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" tabindex="-1" aria-label="Increase">
                                            <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5 12h14"></path>
                                            <path d="M12 5v14"></path>
                                        </svg>
                                        </button>
                                    </div>
                                </div>
                                <!-- End Input Number -->
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{ Number::currency(($item['price'] * (1 + $item['tax'])) , in: 'HUF', locale: 'hu') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{ Number::currency($item['tax_amount'] , in: 'HUF', locale: 'hu') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{ Number::currency(($item['total_amount'] + $item['tax_amount']) , in: 'HUF', locale: 'hu') }}</td>
                            <td class="pe-3">
                                <button wire:click="removeItem({{ $item['product_id'] }})" type="button" class="py-3 px-4 flex justify-center items-center size-[46px] text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-none focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="size-6 stroke-white">
                                        <path d="M10 12V17"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M14 12V17"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M4 7H20"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M6 10V18C6 19.6569 7.34315 21 9 21H15C16.6569 21 18 19.6569 18 18V10"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>

        <div class="bg-white py-3 px-5 rounded">
            <div>
                <label for="hs-trailing-button-add-on">Kupon</label>
                <div class="flex rounded-lg shadow-sm mt-2 mb-6">
                    <input type="text" id="hs-trailing-button-add-on" name="hs-trailing-button-add-on" placeholder="XXX123" class="py-3 px-4 block w-full border-gray-200 shadow-sm rounded-s-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                    <button type="button" class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-e-md border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        Bevált
                    </button>
                </div>
            </div>
            <p class="dark:text-white mb-2">Nettó összesen: <span>{{ Number::currency($total_amounts['grand_net_total'] , in: 'HUF', locale: 'hu') }}</span></p>
            <p class="dark:text-white mb-2">ÁFA (27%): <span>{{ Number::currency($total_amounts['tax_total'] , in: 'HUF', locale: 'hu') }}</span></p>
            <p class="text-3xl dark:text-white mb-10">Bruttó összesen: <span>{{ Number::currency($total_amounts['grand_gross_total'] , in: 'HUF', locale: 'hu') }}</span></p>

            <a href="{{ route('checkout') }}" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-green-500 text-white hover:bg-green-700 focus:outline-none focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                Tovább a fizetéshez
            </a>
        </div>
    </div>
    @else
        <div class="text-center my-16">
            <p class="text-2xl font-semibold mb-6">Úgytűnik a kosarad üres!</p>
            <img src="{{ url('storage', 'state/empty-cart.png') }}" alt="nincs termék" class="w-52 h-auto block mx-auto">
            <a href="{{ route('categories') }}" class="text-lg text-blue-500 underline">Válogass kedvedre termékeink között</a>
        </div>
    @endif
</div>
