<div>
    <!-- Start Accordion -->
    <div class="hs-accordion-group">
        <!-- Start Accordion Item -->
        <div class="hs-accordion hs-accordion-active:border-gray-200 bg-white border border-transparent rounded-xl dark:hs-accordion-active:border-neutral-700 dark:bg-neutral-800 dark:border-transparent" id="hs-active-bordered-heading-one">
            <button class="hs-accordion-toggle hs-accordion-active:text-blue-600 inline-flex justify-between items-center gap-x-3 w-full font-semibold text-start text-gray-800 py-4 px-5 hover:text-gray-500 disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-none dark:focus:text-neutral-400" aria-expanded="false" aria-controls="hs-basic-active-bordered-collapse-one">
                Szűrők
                <svg class="hs-accordion-active:hidden block size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"></path>
                    <path d="M12 5v14"></path>
                </svg>
                <svg class="hs-accordion-active:block hidden size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"></path>
                </svg>
            </button>
            <div id="hs-basic-active-bordered-collapse-one" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" role="region" aria-labelledby="hs-active-bordered-heading-one">
                <!--Start Accordion Item Content -->
                
                <!--End Accordion Item Content -->
            </div>
        </div>
        <!-- End Accordion Item -->
    </div>
    <!-- End Accordion -->

    <div class="pb-4 px-5 grid grid-cols-2">
        @foreach($filter_groups as $group)
            <!--Start Col -->
            <fieldset wire:key="$group->id">
                <legend>{{ $group->name }}</legend>
                @foreach($group->options as $option)
                    <div class="flex" wire:key="{{ $option->id }}">
                        <input type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500  dark:focus:ring-offset-gray-800" value="{{ $option->id }}" id="{{ $option->value }}" wire:model.live="selected_size">
                        <label for="{{ $option->value }}" class="text-sm text-gray-500 ms-3 dark:text-neutral-400">{{ $option->name }}</label>
                    </div>
                @endforeach
            </fieldset>
            <!--End Col -->
        @endforeach
    </div>

    <div class="pb-4 px-5 grid grid-cols-2">
        <!--Start Col -->
        <fieldset>
            <legend>Kategóriák</legend>
            @foreach($categories as $category)
                <div class="flex" wire:key="{{ $category->id }}">
                    <input type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500  dark:focus:ring-offset-gray-800" value="{{ $category->id }}" id="{{ $category->slug }}" wire:model.live="selected_prices">
                    <label for="{{ $category->slug }}" class="text-sm text-gray-500 ms-3 dark:text-neutral-400">{{ $category->title }}</label>
                </div>
            @endforeach
        </fieldset>
        <!--End Col -->
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
    </div>

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
                    Ár: {{ Number::currency($product->price , in: 'HUF', locale: 'hu') }}
                </p>
                <a class="mt-2 py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="{{ route('product', ['slug' => $product->slug]) }}">
                    Megnézem a terméket
                </a>
            </div>
        </div>
        <!--End Col -->
        @endforeach
    </section>
    <section class="mt-6">
     {{ $products->links() }}
    </section>
    <!-- End Grid -->
</div>
