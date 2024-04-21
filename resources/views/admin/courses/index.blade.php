@php
    /** @var \Core\LmsLite\View\CourseTable $table*/
@endphp
<x-app-layout title="Courses">
    {{--Banner--}}
    <x-banner></x-banner>
    {{--End Banner--}}
    {!! $table->render() !!}
</x-app-layout>

<script>
    document.addEventListener('alpine:init', () => {

    });
</script>

