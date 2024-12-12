<div class="grid grid-cols-3 gap-4">
    <div class="w-full p-6 bg-white rounded-lg">
        <form class="mb-16" wire:submit.prevent="updateUser">
            <h3 class="text-xl mb-4 font-bold">Profil adatok</h3>
            <div class="w-full mb-4">
                <label for="name" class="block text-sm font-medium mb-2 dark:text-white">Név</label>
                <input type="text" id="name" wire:model="name" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                @error('name')
                    <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full mb-4">
                <label for="email" class="block text-sm font-medium mb-2 dark:text-white">Email</label>
                <input type="email" id="email" wire:model="email" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                @error('email')
                    <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>
    
            <button type="submit" class="w-full mt-6 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                <span wire:loading.remove wire:target="updateUser">Mentés</span>
                <span wire:loading wire:target="updateUser">Folyamatban...</span>
            </button>
        </form>

        <form wire:submit.prevent="updatePassword">
            <h3 class="text-xl mb-4 font-bold">Jelszó kezelés</h3>
            <div class="w-full mb-4">
                <label for="password" class="block text-sm font-medium mb-2 dark:text-white">Régi jelszó</label>
                <input type="password" id="password" wire:model="password" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                @error('password')
                    <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full mb-4">
                <label for="new_password" class="block text-sm font-medium mb-2 dark:text-white">Új jelszó</label>
                <input type="password" id="new_password" wire:model="new_password" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                @error('new_password')
                    <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full mb-4">
                <label for="new_password_confirmation" class="block text-sm font-medium mb-2 dark:text-white">Új jelszó ismét</label>
                <input type="password" id="new_password_confirmation" wire:model="new_password_confirmation" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
            </div>

            <button type="submit" class="w-full mt-6 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                <span wire:loading.remove wire:target="updatePassword">Új jelszó mentése</span>
                <span wire:loading wire:target="updatePassword">Folyamatban...</span>
            </button>
        </form>
    </div>

    <div class="w-full p-6 bg-white rounded-lg col-span-2">
        <div class="flex justify-between">
            <h3 class="text-xl mb-4 font-bold">Címek</h3>
            <a href="{{ route('address', ['id' => 0]) }}" class="text-teal-600 underline">Új hozzáadása</a>
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
                    <a href="{{ route('address', ['id' => $billing_address->id]) }}" title="Szerkesztés">
                        <svg viewBox="0 0 24 24" width="24" height="24" class="hover:scale-105 focus:scale-105" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z" stroke="#009688" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13" stroke="#009688" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                    </a>
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
                        <a href="{{ route('address', ['id' => $address->id]) }}" class="inline-flex items-center gap-x-2 text-sm font-medium" title="Szerkesztés">
                            <svg viewBox="0 0 24 24" width="24" height="24" class="hover:scale-105 focus:scale-105" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z" stroke="#009688" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13" stroke="#009688" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                        </a>
                        <button class="inline-flex items-center gap-x-2 text-sm font-medium" wire:click="deleteAddress({{ $address->id }})" wire:confirm="Biztosan törlöd ezt a címet?" title="Törlés">
                            <span wire:loading.remove wire:target="deleteAddress({{ $address->id }})">
                                <svg viewBox="0 0 24 24" width="24" height="24" class="hover:scale-105 focus:scale-105" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3 6.98996C8.81444 4.87965 15.1856 4.87965 21 6.98996" stroke="#c62828" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M8.00977 5.71997C8.00977 4.6591 8.43119 3.64175 9.18134 2.8916C9.93148 2.14146 10.9489 1.71997 12.0098 1.71997C13.0706 1.71997 14.0881 2.14146 14.8382 2.8916C15.5883 3.64175 16.0098 4.6591 16.0098 5.71997" stroke="#c62828" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M12 13V18" stroke="#c62828" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M19 9.98999L18.33 17.99C18.2225 19.071 17.7225 20.0751 16.9246 20.8123C16.1266 21.5494 15.0861 21.9684 14 21.99H10C8.91389 21.9684 7.87336 21.5494 7.07541 20.8123C6.27745 20.0751 5.77745 19.071 5.67001 17.99L5 9.98999" stroke="#c62828" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                            </span>
                            <span wire:loading wire:target="deleteAddress({{ $address->id }})">Folyamatban...</span>
                        </button>
                    </div>
                </div>
                @endforeach
            @else
                <p>{{ $billing_address->country }}</p>
                <p>{{ $billing_address->zipcode }} {{ $billing_address->city }} {{ $billing_address->street }}</p>
            @endif
        </div>
    </div>

   
</div>
