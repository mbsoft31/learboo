@php
    $color = $color ?? 'green';
    $colors = [
        'green' => 'bg-green-50 text-green-700 ring-green-600/20',
        'red' => 'bg-red-50 text-red-700 ring-red-600/20',
        'yellow' => 'bg-yellow-50 text-yellow-700 ring-yellow-600/20',
        'blue' => 'bg-blue-50 text-blue-700 ring-blue-600/20',
        'indigo' => 'bg-indigo-50 text-indigo-700 ring-indigo-600/20',
        'purple' => 'bg-purple-50 text-purple-700 ring-purple-600/20',
        'pink' => 'bg-pink-50 text-pink-700 ring-pink-600/20',
        'gray' => 'bg-gray-50 text-gray-700 ring-gray-600/20',
    ];
    $class = $class ?? 'inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset ' . $colors[$color];
@endphp
<span
    class="{{ $class }}"
>
    {!! $value !!}
</span>
