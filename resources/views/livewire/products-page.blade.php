<div>
    <div class="py-4 px-5 grid grid-cols-4 bg-white border border-transparent rounded-xl">
        @foreach($filter_groups as $group)
            <!--Start Col -->
            <fieldset wire:key="{{ $group->id }}">
                <legend>{{ $group->name }}</legend>
                @foreach($group->options as $option)
                    <div class="flex" wire:key="{{ $option->id }}">
                        <input type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500  dark:focus:ring-offset-gray-800" value="{{ $option->id }}" id="{{ $option->value }}" wire:model.live="selected_filters">
                        <label for="{{ $option->value }}" class="text-sm text-gray-500 ms-3 dark:text-neutral-400">{{ $option->name }}</label>
                    </div>
                @endforeach
            </fieldset>
            <!--End Col -->
        @endforeach
        <!--Start Col -->
        <fieldset>
            <legend>Készlet</legend>
            <div class="flex flex-col gap-y-3">
                <div class="flex">
                    <input type="radio" name="stock_info" class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="all" checked value="" wire:model.live="stock_info">
                    <label for="all" class="text-sm text-gray-500 ms-2 dark:text-neutral-400">Minden</label>
                </div>
    
                <div class="flex">
                    <input type="radio" name="stock_info" class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="in_stock" value="in_stock" wire:model.live="stock_info">
                    <label for="in_stock" class="text-sm text-gray-500 ms-2 dark:text-neutral-400">Készleten</label>
                </div>
    
                <div class="flex">
                    <input type="radio" name="stock_info" class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="preorder" value="preorder" wire:model.live="stock_info">
                    <label for="preorder" class="text-sm text-gray-500 ms-2 dark:text-neutral-400">Rendelhető</label>
                </div>
            </div>
        </fieldset>
        <!--End Col -->
        <div>
            <label for="price_range">Ár</label>
            <span class="w-10 text-lg font-bold text-neutral-900 dark:text-white">{{ Number::currency($price_range, 'HUF', 'hu') }}</span>
            <input type="range" name="" id="price_range" wire:model.live="price_range" class="w-full h-1 mb-4 bg-blue-100 rounded" max="500000" value="{{ $price_range }}" step="1000">
            <div class="flex justify-between">
                <span>{{ Number::currency(0, 'HUF', 'hu') }}</span>
                <span>{{ Number::currency(500000, 'HUF', 'hu') }}</span>
            </div>
        </div>
    </div>

    @if(count($products) > 0)
    <div>
        <select wire:model.live="sort" class="py-3 px-4 pe-9 mt-6 block max-w-52 border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
            <option value="price_asc" selected>Ár növekvő</option>
            <option value="price_desc">Ár csökkenő</option>
        </select>
        <!-- Start Grid -->
        <section class="grid grid-cols-4 gap-4 mt-6">
            @foreach($products as $product)
            <!--Start Col -->
            <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70" wire:key="{{ $product->id }}">
                <div class="relative">
                    @if($product->images)
                        <img class="w-full h-96 object-cover rounded-t-xl" src="{{ url('storage', $product->images[0]) }}" alt="{{ $product->name }}">
                    @else
                        <img class="w-full h-96 object-cover rounded-t-xl" src="https://images.unsplash.com/photo-1680868543815-b8666dba60f7?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1200&h=630&q=80" alt="{{ $product->name }}">
                    @endif
                    @if($product->is_new == 1)
                    <span class="absolute top-0 end-0 inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-yellow-500 text-white">Új</span>
                    @endif
                </div>
                <div class="p-4 md:p-5">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                        {{ $product->name }}
                    </h3>
                    <p class="mt-1 text-gray-500 dark:text-neutral-400">
                        Bruttó ár: {{ Number::currency(($product->price * (1 + $product->tax)) , in: 'HUF', locale: 'hu') }}
                    </p>
                    <div class="flex mt-2 justify-between items-center">
                        <a class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="{{ route('product', ['slug' => $product->slug]) }}">
                            Megnézem a terméket
                        </a>
                        <a wire:click.prevent="addToCart({{ $product->id }})" href="#" class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-none focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                            <span wire:loading.remove wire:target="addToCart({{ $product->id }})">Kosárba</span>
                            <span wire:loading wire:target="addToCart({{ $product->id }})">Töltés...</span>
                        </a>
                    </div>
                </div>
            </div>
            <!--End Col -->
            @endforeach
        </section>
        <!-- End Grid -->
        <!-- Start pagination -->
        <section class="mt-6">
            {{ $products->links() }}
        </section>
        <!-- End pagination -->
     </div>
     @else
        <div class="text-center my-16">
            <p class="text-2xl font-semibold mb-6">Úgytűnik a kategória űres vagy nincs a szűrési feltételnek megfelelő termék!</p>
            <img src="{{ url('storage', 'state/empty-category.png') }}" alt="nincs termék" class="w-52 h-auto block mx-auto">
        </div>
     @endif
</div>
