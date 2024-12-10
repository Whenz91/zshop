<form class="w-full md:w-3/4 md:mx-auto mt-6 p-6 bg-white rounded-lg" wire:submit.prevent="save">
    <fieldset class="grid grid-cols-2 gap-4 mb-6">
        <div class="col-span-2">
            <select class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" wire:model="address_type">
                <option value="billing">Számlázási</option>
                <option value="shipping">Szállítási</option>
            </select>
        </div>
        <div>
            <label for="input-label" class="block text-sm font-medium mb-2 dark:text-white">Ország</label>
            <select class="py-3 px-4 pe-9 block w-full border bg-gray-100 border-transparent rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:focus:ring-neutral-600" wire:model="country">
                <option value="Magyarország">Magyarország</option>
            </select>
            @error('country')
                <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="input-label" class="block text-sm font-medium mb-2 dark:text-white">Megye</label>
            <livewire:form-components.state-select name="state" :selectedValue="$state" />
            @error('state')
                <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="input-label" class="block text-sm font-medium mb-2 dark:text-white">Irányítószám</label>
            <input type="number" id="input-label" wire:model="zipcode" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="5630">
            @error('zipcode')
                <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="input-label" class="block text-sm font-medium mb-2 dark:text-white">Város</label>
            <input type="text" id="input-label" wire:model="city" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Békés">
            @error('city')
                <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>
        <div class="col-span-2">
            <label for="input-label" class="block text-sm font-medium mb-2 dark:text-white">Cím</label>
            <input type="text" id="input-label" wire:model="street" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Minta u. 2.">
            @error('street')
                <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>
    </fieldset>

    <button type="submit" class="w-full mt-6 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Mentés</button>
</form>
