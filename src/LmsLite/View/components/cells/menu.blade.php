<div
    x-data="{
        open:false,
        openMenu() {
            this.open = true
        },
        close() {
            this.open = false
        },
        toggle() {
            this.open = !this.open
        }
    }"
    class="flex items-center justify-center text-left"
>
    <button x-on:click="openMenu()"
            type="button"
            class="relative rounded-full bg-gray-100 text-gray-400 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100"
            id="menu-button"
            aria-expanded="true"
            aria-haspopup="true"
    >
        <span class="sr-only">{{ $button }}</span>
        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z" />
        </svg>
    </button>
    <div
        x-show="open"
        x-on:click.away="close()"
        x-on:keydown.escape="close()"
        x-on:keydown.tab="close()"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute end-0 z-50 mt-2 w-56 ltr:origin-top-right rtl:origin-top-left rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
        role="menu"
        aria-orientation="vertical"
        aria-labelledby="menu-button"
        tabindex="-1"
    >
        <div class="py-1 z-50" role="none">
            @forelse($items as $item)
                {!! $item !!}
            @empty
                <div class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1">
                    No items
                </div>
            @endforelse
        </div>
    </div>
</div>
