@props(['testimonial'])
@php
    /** @var \Core\Frontend\DTO\TestimonialData $testimonial*/
@endphp
<div class="flex flex-col pb-10 sm:pb-16 lg:pb-0 lg:pr-8 xl:pr-20">
    <img class="h-12 self-start" src="https://tailwindui.com/img/logos/tuple-logo-white.svg" alt="">
    <figure class="mt-10 flex flex-auto flex-col justify-between">
        <blockquote class="text-lg leading-8 text-white">
            <p>“{{ $testimonial->testimonial }}”</p>
        </blockquote>
        <figcaption class="mt-10 flex items-center gap-x-6">
            <img class="h-14 w-14 rounded-full bg-gray-800" src="{{$testimonial->imageUrl}}" alt="">
            <div class="text-base">
                <div class="font-semibold text-white">{{$testimonial->name}}</div>
                <div class="mt-1 text-gray-400">{{$testimonial->position}}</div>
            </div>
        </figcaption>
    </figure>
</div>
