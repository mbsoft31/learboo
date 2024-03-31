@props([
    'navigation' => null
])
<header x-data="{open: false}" class="relative">
    <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
        <a href="#" class="-m-1.5 p-1.5">
            <span class="sr-only">LearnBoo</span>
            <img class="h-8 w-28 rounded-full object-cover" src="{{ asset("/images/logo.png") }}" alt="">
        </a>
        <div class="flex lg:hidden">
            <button @click="open = true" type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                <span class="sr-only">Open main menu</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
            </button>
        </div>
        <div class="hidden lg:flex lg:gap-x-2">
            @foreach($navigation->links as $link)
                <x-navigation-link :active="false" :navigation-link="$link" />
            @endforeach
            <a href="{{ route('login') }}" class="px-6 py-1 rounded-lg text-sm font-semibold leading-6 text-base-content hover:bg-base-content hover:text-white">Log in <span aria-hidden="true">&rarr;</span></a>
        </div>
    </nav>
    <!-- Mobile menu, show/hide based on menu open state. -->
    <div x-show="open" style="display: none" class="lg:hidden bg-transparent" role="dialog" aria-modal="true">
        <!-- Background backdrop, show/hide based on slide-over state. -->
        <div class="fixed inset-0 z-10"></div>
        <div @click.outside="open = false" class="bg-base-100 fixed inset-y-0 start-0 z-20 max-w-sm w-full overflow-y-auto px-6 py-6 sm:ring-1 sm:ring-gray-900/10">
            <div class="flex items-center justify-between">
                <a href="#" class="-m-1.5 p-1.5">
                    <span class="sr-only">LearnBoo</span>
                    <img class="h-8 w-28 rounded-full object-cover" src="{{ asset('/images/logo.png') }}" alt="">
                </a>
                <button @click="open = false" type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                    <span class="sr-only">Close menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="mt-6 flow-root">
                <div class="-my-6 divide-y divide-gray-500/10">
                    <div class="space-y-2 py-6">
                        <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-base-content hover:bg-base-content hover:text-white">Product</a>
                        <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-base-content hover:bg-base-content hover:text-white">Features</a>
                        <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-base-content hover:bg-base-content hover:text-white">Marketplace</a>
                        <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-base-content hover:bg-base-content hover:text-white">Company</a>
                    </div>
                    <div class="py-6">
                        <a href="#" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-base-content hover:bg-base-content hover:text-white">Log in</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
