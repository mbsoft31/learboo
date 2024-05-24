@props([
    'active' => false,
    'index' => 0,
])

@php
    $classes = "";
    if ($active) {
        $classes .= "text-white bg-indigo-600";
    }else{
        $classes .= "text-gray-900";
    }

    $checkmarkClasses = "";
    if ($active) {
        $checkmarkClasses .= "text-white";
    }else{
        $checkmarkClasses .= "bg-indigo-600";
    }

@endphp

<li @click="open = false;selected = {{$index}}" class="relative cursor-default select-none py-2 pl-8 pr-4 {{$active ? 'text-white bg-indigo-600' : 'text-gray-900'}}" id="option-{{$index}}" role="option" tabindex="-1">
    <!-- Selected: "font-semibold" -->
    <span class="block truncate {{ $active ? 'font-semibold' : '' }}">{{ $slot }}</span>

    @if($active)
        <span class="absolute inset-y-0 left-0 flex items-center pl-1.5 {{$active ? 'text-white' : 'bg-indigo-600'}}">
          <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
          </svg>
        </span>
    @endif
</li>
