@props([
    'color' => 'gray',
])
@php
    $colors = [
        'gray' => 'text-gray-700 hover:bg-gray-100',
        'red' => 'text-red-700 hover:bg-red-100',
        'yellow' => 'text-yellow-700 hover:bg-yellow-100',
        'green' => 'text-green-700 hover:bg-green-100',
        'blue' => 'text-blue-700 hover:bg-blue-100',
        'indigo' => 'text-indigo-700 hover:bg-indigo-100',
        'purple' => 'text-purple-700 hover:bg-purple-100',
        'pink' => 'text-pink-700 hover:bg-pink-100',
        'teal' => 'text-teal-700 hover:bg-teal-100',
    ];
    $classes = $colors[$color];
@endphp

<div class="w-full border-t border-gray-200"></div>
