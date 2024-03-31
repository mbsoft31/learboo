@php
    $classes = 'group flex items-center px-4 py-1 rounded-lg text-sm font-semibold leading-6';
    $classes .= $active ? ' bg-base-content text-white' : ' text-base-content hover:bg-base-content hover:text-white';
@endphp
{{--<a href="#" class="px-6 py-1 rounded-lg text-sm font-semibold leading-6 text-base-content hover:bg-base-content hover:text-white">Product</a>--}}

<a href="{{ $navigationLink->route }}" class="{{ $classes }}">
    {{ $navigationLink->label }}
</a>
