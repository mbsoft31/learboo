<x-main-layout>

    <section class="bg-white">
        <div class="relative h-96">
            <img src="{{ $course->imageUrl }}" alt="" class="absolute inset-0 h-full w-full bg-gray-50 object-cover">
            <div class="absolute inset-0 bg-slate-800/20">
                <div class="mx-auto max-w-7xl flex items-end w-full h-full px-8 py-10">
                    <div>
                        <div class="flex items-center gap-x-4">
                            <time datetime="{{ $course->date->format('Y-m-d') }}" class="text-xs text-gray-700">
                                {{ $course->date->format('d M Y') }}
                            </time>
                            <a href="#" class="text-xs text-gray-700">
                                {{ $course->category->name }}
                            </a>
                        </div>
                        <div class="mt-4 pt-4 flex border-t border-gray-900/5">
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
                </div>
            </div>
        </div>
        <div class="mx-auto max-w-7xl">
           @if($course)
                <div x-data="{selected: 0, tabs: ['Course informations', 'Teacher(s)', 'Course details', 'Groups']}" class="py-10 md:py-12 lg:py-14 px-4 gap-8">
                    <div>
                        <div class="sm:hidden">
                            <label for="tabs" class="sr-only">Select a tab</label>
                            <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
                            <select x-bind:value="selected" x-on:change="(e) => selected = e.target.value" id="tabs" name="tabs" class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                <template x-for="(tab, index) of tabs">
                                    <option x-bind:value="index" x-text="tab" />
                                </template>
                            </select>
                        </div>
                        <div class="hidden sm:block">
                            <div class="border-b border-gray-200">
                                <nav class="-mb-px flex" aria-label="Tabs">
                                    <template x-for="(tab, index) of tabs">
                                        <button
                                            type="button"
                                            x-bind:value="index"
                                            x-text="tab"
                                            x-on:click="() => selected = index"
                                            x-bind:class="{
                                                'border-indigo-500 text-indigo-600': index == selected,
                                                'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700': index !== selected
                                            }"
                                            class="w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium"
                                        />
                                    </template>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="py-12 md:py-20 lg:py-24 px-4 gap-8">
                        <article x-show="selected == 0" class="prose md:prose-lg lg:prose-xl prose-slate prose-p:text-slate-600 prose-ul:text-slate-600 prose-headings:text-slate-700">
                            <h1>
                                {{ $course->title }}
                            </h1>
                            {{--<p>
                                {{ $course->description }}
                            </p>
                            <h2>
                                {{ __("Content") }}
                            </h2>--}}
                            <p>
                                {!! $course->content !!}
                            </p>
                        </article>
                        <div x-show="selected == 2">
                            <dl class="divide-y divide-gray-100">
                                @foreach(collect($course->meta)->except(["groups", "fees"]) as $key => $value)
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-lg font-medium leading-6 text-gray-900">
                                            {{ $key }}
                                        </dt>
                                        <dd class="mt-1 text-base font-semibold leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                            @if(is_array($value))
                                                <ul role="list" class="divide-y divide-gray-200">
                                                    @foreach($value as $v)
                                                        <li class="py-4">
                                                            @if(is_array($v))
                                                                <ul role="list" class="divide-y divide-gray-200">
                                                                    @foreach($v as $vv)
                                                                        <li class="py-4">
                                                                            {{ $vv }}
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @else
                                                                {{ $v }}
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                {{ $value }}
                                            @endif
                                        </dd>
                                    </div>
                                @endforeach
                            </dl>
                        </div>
                        <div x-show="selected == 3" class="grid grid-cols-1 md:grid-cols-2">
                            @foreach($course->meta["groups"] as $name => $group)
                                <div class="text-slate-800">
                                    <div>{{ $name }}</div>
                                    <div class="flex gap-2">
                                        <ul role="list" class="divide-y divide-gray-200">
                                            @foreach($group as $day => $content)
                                                <li class="py-4">
                                                    <div>{{ $day }}</div>
                                                    <div>{{ $content }}</div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>


</x-main-layout>
