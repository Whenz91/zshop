<div>
    <form class="w-full md:w-3/6 md:mx-auto p-6 bg-white rounded-lg">
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

    <form class="w-full md:w-3/6 md:mx-auto mt-6 p-6 bg-white rounded-lg">
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
