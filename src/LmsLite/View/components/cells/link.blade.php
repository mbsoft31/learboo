@php
    $color = $color ?? 'green';
    $colors = [
        'indigo' => 'text-indigo-600 hover:text-indigo-900',
        'green' => 'text-green-600 hover:text-green-900',
        'teal' => 'text-teal-600 hover:text-teal-900',
        'red' => 'text-red-600 hover:text-red-900',
        'yellow' => 'text-yellow-600 hover:text-yellow-900',
        'blue' => 'text-blue-600 hover:text-blue-900',
        'purple' => 'text-purple-600 hover:text-purple-900',
        'pink' => 'text-pink-600 hover:text-pink-900',
        'gray' => 'text-gray-600 hover:text-gray-900',
    ];
    $class = $class ?? ' ' . $colors[$color];
@endphp
<a
    href="{{ $href }}"
    class="{{ $class }}">
    {!! $value !!}
</a>
