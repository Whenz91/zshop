<div class="grid grid-cols-2 gap-4">
    @foreach($categories as $category)
    <!--Start Col -->
    <a href="{{ route('products', ['slug' => $category->slug]) }}" class="transition hover:-translate-y-3" wire:key="{{ $category->id }}">
        <article class="flex justify-between items-center px-4 py-6 bg-white border border-slate-300 rounded-md shadow">
            @if($category->image)
                <img src="{{ url('storage', $category->image) }}" alt="{{ $category->title }}" class="w-96 h-auto object-cover rounded-md">
            @else
                <img src="https://plus.unsplash.com/premium_photo-1663962158789-0ab624c4f17d?q=80&w=1200&h=630&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" class="w-96 h-auto object-cover rounded-md">
            @endif
            <h3 class="flex items-center text-xl font-bold text-gray-800 sm:text-2xl lg:text-3xl lg:leading-tight dark:text-white text-center">
                {{ $category->title }}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </h3>
            
        </article>
    </a>
    <!--End Col -->
    @endforeach
</div>
