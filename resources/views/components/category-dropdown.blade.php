<x-dropdown>

    <x-slot name="trigger">
        <button 
            class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-32 text-left flex lg:inline-flex">
                {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Categories' }}
        
            <x-icon name="down-arrow" class="absolute pointer-events-none" style="right: 12px;" />
        </button>
    </x-slot>


    {{-- <x-dropdown-item href="/" :active="request()->routeIs('home')">All</x-dropdown-item> --}}
    <x-dropdown-item href="/" :active='(request()->category == null )'>All</x-dropdown-item>
    {{-- @dd(request()->category) --}}
    @foreach ($categories as $category)
    {{-- {{  ? 'bg-blue-500 text-white' : '' }}" --}}

        <x-dropdown-item
            href="/?category={{ $category->slug }}"
            {{-- href="/categories/{{ $category->slug }}" --}}

            {{-- First way --}}
            {{-- :active="isset($currentCategory) && $currentCategory->is($category)" --}}
            {{-- Second way --}}
            {{-- :active='request()->is("?category={$category->slug}")' --}}
            :active='(request()->category == $category->slug)'
            
        >{{ ucwords($category->name) }}
        </x-dropdown-item>
    @endforeach
</x-dropdown>