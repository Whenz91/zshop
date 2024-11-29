<div>
    <h1 class="text-4xl dark:text-white mb-6">Pénztár</h1>

    <section class="grid grid-cols-3 gap-4">
        <form class="col-span-2 bg-white p-6 rounded-lg" wire:submit.prevent="placeOrder">
            <fieldset class="grid md:grid-cols-2 md:gap-4 mb-6">
                <legend class="md:col-span-2 text-lg font-medium mb-2">Megrendelő adatai</legend>
                <hr class="md:col-span-2 mb-6">
                <div class="mb-3">
                    <label for="input-label" class="block text-sm font-medium mb-2 dark:text-white">Teljes név</label>
                    <input type="text" id="input-label" wire:model="customer_name" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Minta Zsófia">
                    @error('customer_name')
                        <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="input-label" class="block text-sm font-medium mb-2 dark:text-white">Eamil</label>
                    <input type="email" id="input-label" wire:model="customer_email" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="minta.zsofia@gmail.com">
                    @error('customer_email')
                        <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="input-label" class="block text-sm font-medium mb-2 dark:text-white">Telefonszám</label>
                    <input type="text" id="input-label" wire:model="customer_phone" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="06-70-123-4545">
                    @error('customer_phone')
                        <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </fieldset>

            <fieldset class="grid grid-cols-2 gap-4 mb-6">
                <legend class="col-span-2 text-lg font-medium mb-2">Számlázási adatok</legend>
                <hr class="col-span-2 mb-6">
                <div>
                    <label for="input-label" class="block text-sm font-medium mb-2 dark:text-white">Ország</label>
                    <select class="py-3 px-4 pe-9 block w-full border bg-gray-100 border-transparent rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:focus:ring-neutral-600" wire:model="billing_country">
                        <option value="Magyarország">Magyarország</option>
                    </select>
                    @error('billing_country')
                        <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="input-label" class="block text-sm font-medium mb-2 dark:text-white">Megye</label>
                    <select class="py-3 px-4 pe-9 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" wire:model="billing_state">
                        <option value="please_select">Válassz megyét</option>
                        <option value="Békés">Békés</option>
                        <option value="Csongrád-Csanád">Csongrád-Csanád</option>
                        <option value="Budapest">Budapest</option>
                    </select>
                    @error('billing_state')
                        <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="input-label" class="block text-sm font-medium mb-2 dark:text-white">Irányítószám</label>
                    <input type="number" id="input-label" wire:model="billing_zipcode" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="5630">
                    @error('billing_zipcode')
                        <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="input-label" class="block text-sm font-medium mb-2 dark:text-white">Város</label>
                    <input type="text" id="input-label" wire:model="billing_city" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Békés">
                    @error('billing_city')
                        <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-span-2">
                    <label for="input-label" class="block text-sm font-medium mb-2 dark:text-white">Cím</label>
                    <input type="text" id="input-label" wire:model="billing_street" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Minta u. 2.">
                    @error('billing_street')
                        <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </fieldset>

            <div class="grid md:grid-cols-2 md:gap-4">
                <fieldset class="mb-6">
                    <legend class="text-lg font-medium mb-2">Szállítási mód</legend>
                    <hr class="mb-6">
    
                    <div class="grid space-y-3">
                        <div class="relative flex items-start border border-gray-200 rounded-lg py-3 px-2">
                            <div class="flex items-center h-5 mt-1">
                                <input id="delivery_to_home" wire:model="shipping_method" type="radio" class="border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" aria-describedby="delivery_to_home-description" checked value="house">
                            </div>
                            <label for="delivery_to_home" class="ms-3">
                                <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-300">GLS házhoz szállítás 1900 Ft</span>
                                <span id="delivery_to_home-description" class="block text-sm text-gray-600 dark:text-neutral-500">Szállítási 1-2 munkanapon belül.</span>
                            </label>
                        </div>
    
                        <div class="relative flex items-start border border-gray-200 rounded-lg py-3 px-2">
                            <div class="flex items-center h-5 mt-1">
                                <input id="delivery_to_point" wire:model="shipping_method" type="radio" class="border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" aria-describedby="delivery_to_point-description" value="point">
                            </div>
                            <label for="delivery_to_point" class="ms-3">
                                <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-300">GLS csomagpont 900 Ft</span>
                                <span id="delivery_to_point-description" class="block text-sm text-gray-600 dark:text-neutral-500">Szállítás 1-2 munkanapon belül.</span>
                            </label>
                        </div>
                    </div>
                </fieldset>
    
                <fieldset class="mb-6">
                    <legend class="text-lg font-medium mb-2">Fizetési mód</legend>
                    <hr class="mb-6">
    
                    <div class="grid space-y-3">
                        <div class="relative flex items-start border border-gray-200 rounded-lg py-3 px-2">
                            <div class="flex items-center h-5 mt-1">
                                <input id="cod" wire:model="payment_method" type="radio" class="border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" aria-describedby="cod-description" checked value="cod">
                            </div>
                            <label for="cod" class="ms-3">
                                <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-300">Utánvét 450 Ft</span>
                                <span id="cod-description" class="block text-sm text-gray-600 dark:text-neutral-500">Fizetés készpénzben vagy kártyával a futárnál.</span>
                            </label>
                        </div>
    
                        <div class="relative flex items-start border border-gray-200 rounded-lg py-3 px-2">
                            <div class="flex items-center h-5 mt-1">
                                <input id="stripe" wire:model="payment_method" type="radio" class="border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" aria-describedby="stripe-description" value="stripe">
                            </div>
                            <label for="stripe" class="ms-3">
                                <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-300">Online kártyás</span>
                                <span id="stripe-description" class="block text-sm text-gray-600 dark:text-neutral-500">Fizetés online kártyával a Stripe fizetési szolgáltató oldalán.</span>
                            </label>
                        </div>
                    </div>
                </fieldset>
            </div>

            <fieldset x-data="{ open: false }">
                <legend class="text-lg font-medium mb-2">Szállítási cím</legend>
                <hr class="mb-6">

                <div class="flex mb-4">
                    <input type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="hs-default-checkbox" x-on:click="open = ! open">
                    <label for="hs-default-checkbox" class="text-sm text-gray-500 ms-3 dark:text-neutral-400">Szállítás eltérő címre</label>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4" x-show="open">
                    <div>
                        <label for="input-label" class="block text-sm font-medium mb-2 dark:text-white">Ország</label>
                        <select class="py-3 px-4 pe-9 block w-full border bg-gray-100 border-transparent rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:focus:ring-neutral-600" wire:model="shipping_country">
                            <option value="Magyarország" selected>Magyarország</option>
                        </select>
                    </div>
                    <div>
                        <label for="input-label" class="block text-sm font-medium mb-2 dark:text-white">Megye</label>
                        <select class="py-3 px-4 pe-9 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" wire:model="shipping_state">
                            <option selected>Válassz megyét</option>
                            <option value="Békés">Békés</option>
                            <option value="Csongrád-Csanád">Csongrád-Csanád</option>
                            <option value="Budapest">Budapest</option>
                        </select>
                    </div>
                    <div>
                        <label for="input-label" class="block text-sm font-medium mb-2 dark:text-white">Irányítószám</label>
                        <input type="number" id="input-label" wire:model="shipping_zipcode" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="5630">
                    </div>
                    <div>
                        <label for="input-label" class="block text-sm font-medium mb-2 dark:text-white">Város</label>
                        <input type="text" id="input-label" wire:model="shipping_city" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Békés">
                    </div>
                    <div class="col-span-2">
                        <label for="input-label" class="block text-sm font-medium mb-2 dark:text-white">Cím</label>
                        <input type="text" id="input-label" wire:model="shipping_street" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Minta u. 2.">
                    </div>
                </div>
            </fieldset>

            <button type="submit" class="w-full bg-green-500 text-white hover:bg-green-700 py-4 px-2 mt-10 rounded-xl">Rendelés elküldése</button>
        </form>

        <div class="bg-white p-6 rounded-lg">
            <table class="min-w-full border border-gray-200 mt-6 mb-4 divide-y divide-gray-200 dark:divide-neutral-700">
                <thead>
                    <tr>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Termék</th>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Mennyiség</th>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Ár</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart_items as $item)
                    <tr class="odd:bg-white even:bg-gray-100 dark:odd:bg-neutral-900 dark:even:bg-neutral-800" wire:key="{{ $item['product_id'] }}">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">{{ $item['name'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{ $item['quantity'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{  Number::currency($item['total_amount'] , in: 'HUF', locale: 'hu') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="grid">
                <p class="min-w-96 flex justify-between">Szállítási költség: <span>1900 Ft</span></p>
                <p class="min-w-96 flex justify-between">Utánvét díja: <span>450 Ft</span</p>
                <p class="min-w-96 flex justify-between">Nettó összesen: <span>{{  Number::currency($total_summary['net_total'] , in: 'HUF', locale: 'hu') }}</span</p>
                <p class="min-w-96 flex justify-between">Áfa (27%): <span>{{  Number::currency($total_summary['tax'] , in: 'HUF', locale: 'hu') }}</span</p>
                <p class="min-w-96 flex justify-between">Bruttó összesen: <span>{{  Number::currency($total_summary['grand_total'] , in: 'HUF', locale: 'hu') }}</span</p>
            </div>
        </div>
    </section>
</div>
