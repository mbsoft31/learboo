@props([
    'course' => null
])

@if($course)
    <article class="relative isolate py-4 px-4 flex flex-col gap-8 lg:flex-row border rounded-2xl border-white hover:scale-105 hover:bg-gray-50 hover:shadow-2xl hover:border-gray-200 transition-all duration-300">
        <div class="relative aspect-[16/9] sm:aspect-[2/1] lg:aspect-square lg:w-64 lg:shrink-0">
            <img src="{{ $course->imageUrl }}" alt="" class="absolute inset-0 h-full w-full rounded-2xl bg-gray-50 object-cover">
            <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
        </div>
        <div>
            <div class="flex items-center gap-x-4 text-xs">
                <time datetime="{{ $course->date->format('Y-m-d') }}" class="text-gray-500">
                    {{ $course->date->format('d M Y') }}
                </time>
                <a href="#" class="relative z-10 rounded-full text-lg bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">
                    {{ $course->category->name }}
                </a>
            </div>
            <div class="group relative max-w-xl">
                <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                    <a href="#">
                        <span class="absolute inset-0"></span>
                        {{ $course->title }}
                    </a>
                </h3>
                <p class="mt-5 text-sm leading-6 text-gray-600">
                    {{ $course->description }}
                </p>
            </div>
            <div class="mt-6 flex border-t border-gray-900/5 pt-6">
                <div class="relative flex items-center gap-x-4">
                    <img src="{{ $course->teacher->imageUrl }}" alt="" class="h-10 w-10 rounded-full bg-gray-50 object-cover">
                    <div class="text-sm leading-6">
                        <p class="font-semibold text-gray-900">
                            <a href="#">
                                <span class="absolute inset-0"></span>
                                {{ $course->teacher->fullName }}
                            </a>
                        </p>
                        <p class="text-gray-600 capitalize">{{ join(', ', $course->teacher->role) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </article>
@endif
