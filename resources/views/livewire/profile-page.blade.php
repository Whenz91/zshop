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

    <div class="w-full md:w-3/4 md:mx-auto mt-6 p-6 bg-white rounded-lg">
        <div class="flex justify-between">
            <h3 class="text-xl mb-4 font-bold">Címek</h3>
            <a href="{{ route('address', ['id' => 0]) }}">Új hozzáadása</a>
        </div>

        <div>
            <h4 class="col-span-2 text-lg font-medium mb-2">Számlázási cím</h4>
            <hr class="col-span-2 mb-4">
            <div class="flex justify-between">
                <div>
                    <p>{{ $billing_address->country }}</p>
                    <p>{{ $billing_address->zipcode }} {{ $billing_address->city }} {{ $billing_address->street }}</p>
                </div>
                <div>
                    <a href="{{ route('address', ['id' => $billing_address->id]) }}" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-teal-600 text-white hover:bg-teal-700 focus:outline-none focus:bg-teal-700 disabled:opacity-50 disabled:pointer-events-none">Szerkeszt</a>
                    <button class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-none focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">Törlés</button>
                </div>
            </div>
        </div>

        <div class="mt-16">
            <h4 class="col-span-2 text-lg font-medium mb-2">Szállítási cím</h4>
            <hr class="col-span-2 mb-4">
            @if(!empty($shipping_addresses))
                @foreach($shipping_addresses as $address)
                <div class="flex justify-between mb-4" wire:key="{{ $address->id }}">
                    <div>
                        <p>{{ $address->country }}</p>
                        <p>{{ $address->zipcode }} {{ $address->city }} {{ $address->street }}</p>
                    </div>
                    <div>
                        <a href="{{ route('address', ['id' => $address->id]) }}" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-teal-600 text-white hover:bg-teal-700 focus:outline-none focus:bg-teal-700 disabled:opacity-50 disabled:pointer-events-none">Szerkeszt</a>
                        <button class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-none focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">Törlés</button>
                    </div>
                </div>
                @endforeach
            @else
                <p>{{ $billing_address->country }}</p>
                <p>{{ $billing_address->zipcode }} {{ $billing_address->city }} {{ $billing_address->street }}</p>
            @endif
        </div>
    </div>

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
