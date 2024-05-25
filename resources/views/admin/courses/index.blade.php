@php
    /** @var \Core\LmsLite\View\CourseTableTest $table*/
@endphp
<x-app-layout title="Courses">
    {{--Banner--}}
    <x-banner></x-banner>
    {{--End Banner--}}
    {!! $table !!}
</x-app-layout>

<script>
    document.addEventListener('alpine:init', () => {

    });
</script>

