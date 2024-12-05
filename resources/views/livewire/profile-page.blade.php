<div>
    <form class="w-full md:w-2/4 md:mx-auto p-6 bg-white rounded-lg" wire:submit.prevent="updateUser">
        <h3 class="text-xl mb-4 font-bold">Profil adatok</h3>
        <div class="w-full mb-4">
            <label for="name" class="block text-sm font-medium mb-2 dark:text-white">Név</label>
            <input type="text" id="name" wire:model="name" class="py-3 px-4 block w-full border-gray-200 bg-gray-100 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
        </div>
        <div class="w-full mb-4">
            <label for="email" class="block text-sm font-medium mb-2 dark:text-white">Email</label>
            <input type="email" id="email" wire:model="email" class="py-3 px-4 block w-full border-gray-200 bg-gray-100 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
        </div>

        <button type="submit" class="w-full mt-6 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Mentés</button>
    </form>

    <form class="w-full md:w-3/4 md:mx-auto mt-6 p-6 bg-white rounded-lg" wire:submit.prevent="updateAddress">
        <h3 class="text-xl mb-4 font-bold">Címek</h3>
        <fieldset class="grid grid-cols-2 gap-4 mb-6">
                <legend class="col-span-2 text-lg font-medium mb-2">Számlázási cím</legend>
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
                    <livewire:form-components.state-select name="billing_state" :selectedValue="$billing_state" />
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

            <fieldset x-data="{ open: false }">
                <legend class="text-lg font-medium mb-2">Szállítási cím</legend>
                <hr class="mb-6">

                <div class="flex mb-4">
                    <input type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="hs-default-checkbox" x-on:click="open = ! open" wire:model="difShipping" value="dif">
                    <label for="hs-default-checkbox" class="text-sm text-gray-500 ms-3 dark:text-neutral-400">Szállítási cím hozzáadása</label>
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
                        <livewire:form-components.state-select name="billing_state" :selectedValue="$shipping_state" />
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

        <button type="submit" class="w-full mt-6 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Mentés</button>
    </form>

    <form class="w-full md:w-2/4 md:mx-auto mt-6 p-6 bg-white rounded-lg">
        <h3 class="text-xl mb-4 font-bold">Jelszó kezelés</h3>
        <div class="w-full mb-4">
            <label for="password" class="block text-sm font-medium mb-2 dark:text-white">Régi jelszó</label>
            <input type="password" id="password" wire:model="password" class="py-3 px-4 block w-full border-gray-200 bg-gray-100 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
        </div>
        <div class="w-full mb-4">
            <label for="new_password" class="block text-sm font-medium mb-2 dark:text-white">Új jelszó</label>
            <input type="password" id="new_password" wire:model="new_password" class="py-3 px-4 block w-full border-gray-200 bg-gray-100 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
        </div>
        <div class="w-full mb-4">
            <label for="password_confirmation" class="block text-sm font-medium mb-2 dark:text-white">Új jelszó ismét</label>
            <input type="password" id="password_confirmation" wire:model="password_confirmation" class="py-3 px-4 block w-full border-gray-200 bg-gray-100 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
        </div>

        <button type="submit" class="w-full mt-6 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Új jelszó mentése</button>
    </form>
</div>
