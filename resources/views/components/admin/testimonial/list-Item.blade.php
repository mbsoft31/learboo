@props([
    'testimonial'
])
@php
    /** @var \Core\Admin\DataObjects\TestimonialData $testimonial*/
@endphp
<li x-data="accordion({open: false})" class="group">
    <div class="relative flex justify-between gap-x-6 px-4 py-5 group-hover:bg-gray-50 sm:px-6">
        <div class="flex min-w-0 gap-x-4">
            <img class="h-12 w-12 flex-none rounded-full bg-gray-50" src="{{ $testimonial->imageUrl }}"
                 alt="{{ $testimonial->name }}">
            <div class="min-w-0 flex-auto">
                <p class="text-sm font-semibold leading-6 text-gray-900">
                    <button @click="toggleAccordion()">
                        <span class="absolute inset-x-0 -top-px bottom-0"></span>
                        {{ $testimonial->name }}
                    </button>
                </p>
                <p class="mt-1 flex text-xs leading-5 text-gray-500">
                    <a href="mailto:leslie.alexander@example.com" class="relative truncate hover:underline">
                        {{ $testimonial->company }}
                    </a>
                </p>
            </div>
        </div>
        <div class="flex shrink-0 items-center gap-x-4">
            <div class="hidden sm:flex sm:flex-col sm:items-end">
                <p class="text-sm leading-6 text-gray-900">
                    {{ $testimonial->position }}
                </p>
                <p class="mt-1 text-xs leading-5 text-gray-500">
                    Updated on
                    <time datetime="2023-01-23T13:23Z">3h ago</time>
                </p>
            </div>
            <svg class="h-5 w-5 flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                      d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                      clip-rule="evenodd"/>
            </svg>
        </div>
    </div>
    <div x-show="open" style="display: none"
         class="flex-col justify-between gap-x-6 px-4 py-5 group-hover:bg-gray-50 sm:px-6">
        <p>{{ $testimonial->testimonial }}</p>
        <div class="flex justify-end items-center gap-x-4">
            <x-admin.testimonial.slide-form :model="$testimonial">
                <x-slot name="action">
                    <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z"/>
                    </svg>
                    <span class="text-center">Edit</span>
                </x-slot>
            </x-admin.testimonial.slide-form>
            <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-900">Delete</button>
            </form>
        </div>
    </div>
</li>
