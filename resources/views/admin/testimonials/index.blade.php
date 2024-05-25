@php
    /** @var array|Array<\Core\Admin\DataObjects\TestimonialData> $testimonials*/
@endphp
<x-app-layout title="Testimonials">
    {{--Banner--}}
    <x-banner></x-banner>
    {{--End Banner--}}
    <div class="bg-white shadow-sm sm:rounded-xl">
        <div class="px-4 py-5 sm:px-6 flex flex-col sm:flex-row sm:items-center gap-4">
            <h3 class="flex-grow text-lg font-semibold leading-6 text-gray-900">Testimonials</h3>
            @if(count($testimonials) > 0)
                <x-admin.testimonial.slide-form>
                    <x-slot name="action">
                        <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                        </svg>
                        <span class="text-center">New Testimonial</span>
                    </x-slot>
                </x-admin.testimonial.slide-form>
            @endif
        </div>
    </div>
    <ul role="list" class="mt-12 divide-y divide-gray-100 overflow-hidden bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
        @forelse($testimonials as $testimonial)
            <x-admin.testimonial.list-Item :testimonial="$testimonial" />
        @empty
            <div class="px-4 py-5 sm:px-6">
                <div class="text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-semibold text-gray-900">No testimonials</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by creating a new testimonial.</p>
                </div>
                <div class="mt-6 flex items-center justify-center">
                    <x-admin.testimonial.slide-form>
                        <x-slot name="action">
                            <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                            </svg>
                            <span class="text-center">New Testimonial</span>
                        </x-slot>
                    </x-admin.testimonial.slide-form>
                </div>
            </div>
        @endforelse
    </ul>
</x-app-layout>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('accordion', () => ({
            open: false,
            init() {},
            toggleAccordion() {
                this.open = !this.open;
            },
            closeAccordion() {
                this.open = false;
            },
            openAccordion() {
                this.open = true;
            },
        }));
    });
</script>

